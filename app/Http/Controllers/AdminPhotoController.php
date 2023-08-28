<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Datatables;

class AdminPhotoController extends Controller
{
    public function index()
    {
        return view('admin.photo.index');
    }

    public function anyData()
    {
        $photos = Photo::with('user')->select(['id', 'user_id', 'names', 'created_at'])->get();
        return Datatables::of($photos)
            ->addIndexColumn()
            ->addColumn('farm', function ($photos) {
                return '<a href="'.route('admin.farms.show', $photos->user->farm_id).'">'.$photos->user->farm->name.'</a>';
            })
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
            ->rawColumns(['farm', 'names'])
            ->make(true);
    }
}
