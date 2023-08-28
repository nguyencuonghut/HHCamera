<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Datatables;

class UserPhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.photo.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.photo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'filenames' => 'required',
            'filenames.*' => 'required|mimes:jpg,png,jpeg|max:5000'
        ];
        $messages = [
            'filenames.required' => 'Bạn phải chọn ảnh.',
            'filenames.*.required' => 'Bạn phải chọn ảnh.',
            'filenames.*.mimes' => 'Bạn phải chọn file ảnh có định dạng .jpg, .png, .jpeg',
            'filenames.*.max' => 'File ảnh vượt quá dung lượng cho phép 5MB'
        ];
        $request->validate($rules,$messages);

        $files = [];
        if($request->hasfile('filenames')){
            $path = public_path('upload/images');
            !file_exists($path) && mkdir($path, 0777, true);

            foreach($request->file('filenames') as $file){
                $name = time().rand(1,100).'.'.$file->extension();
                $file->move(public_path('upload/images'), $name);
                $files[] = $name;
            }
        }
        $photo = new Photo();
        $photo->user_id = Auth::user()->id;
        $photo->names = implode(",",$files);
        $photo->save();

        Alert::toast('Upload ảnh thành công!', 'success', 'top-right');
        return redirect()->route('photos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);
        if(Auth::user()->id == $photo->user_id){
            //Unlink photos
            $photo_names_array = explode(',', $photo->names);
            foreach ($photo_names_array as $photo_name){
                unlink(('upload/images/') . $photo_name);
            }
            $photo->destroy($id);

            Alert::toast('Xóa ảnh thành công!', 'success', 'top-right');
            return redirect()->route('photos.index');
        }else{
            //You don't have permission to delete this photo
            Alert::toast('Bạn không có quyền xóa!', 'error', 'top-right');
            return redirect()->route('photos.index');
        }
    }


    public function anyData()
    {
        $user_id = Auth::user()->id;
        $photos = Photo::where('user_id',  $user_id)->select(['id', 'user_id', 'names', 'created_at'])->get();
        return Datatables::of($photos)
            ->addIndexColumn()
            ->editColumn('names', function ($photos) {
                $photo_names_array = explode(',', $photos->names);

                $html_photos = '';
                foreach ($photo_names_array as $photo_name) {
                    $url= asset(('upload/images/') . $photo_name);
                    $html_photos = $html_photos . '<img src="'.$url.'" border="0" width="100" height="100" class="img-rounded" align="center" />';
                }

                return $html_photos;
            })
            ->editColumn('created_at', function ($photos) {
                return $photos->created_at;
            })
            ->addColumn('action', function ($photos) {
                $action = '';
                $action = $action . '<form style="display:inline" action="'. route("photos.destroy", $photos->id) . '" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" name="submit" onclick="return confirm(\'Bạn có muốn xóa?\');" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                <input type="hidden" name="_token" value="' . csrf_token(). '"></form>';

                return $action;
            })
            ->rawColumns(['names', 'action'])
            ->make(true);
    }
}
