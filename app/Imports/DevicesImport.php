<?php

namespace App\Imports;

use App\Models\Device;
use App\Models\DeviceCategory;
use App\Models\Farm;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class DevicesImport implements ToCollection, WithStartRow
{
    private $rows = 0;
    private $duplicates = 0;
    private $device_category_not_found_row = 0;

    public function collection(Collection $rows)
    {
        $i = 0;
        foreach ($rows as $row)
        {
            $i++;
            //Skip the heading row (first row)
            if($i > 1){
                $device_category = DeviceCategory::where('name', $row[5])->first();
                if(null == $device_category){
                    $this->device_category_not_found_row = $i;
                    break;
                }

                //Check farm id existed or not
                $farm = Farm::where('name', $row[6])->first();
                if(null == $farm){
                    // Farm not existed, need to create new farm
                    $farm = Farm::create([
                        'name'          => $row[6],
                        'description'   => null,
                        'created_at'    => Carbon::now(),
                        'updated_at'    => Carbon::now(),
                    ]);

                    //Create device
                    Device::create([
                        'name'                  => $row[1],
                        'position'              => $row[2],
                        'ip'                    => $row[3],
                        'status'                => $row[4],
                        'device_category_id'    => $device_category->id,
                        'farm_id'               => $farm->id,
                        'created_at'            => Carbon::now(),
                        'updated_at'            => Carbon::now(),
                    ]);
                    ++$this->rows;
                }else{
                    // Farm existed, check if device is duplicate
                    $device = Device::where('name', $row[1])->where('farm_id', $farm->id)->first();
                    if($device){
                        ++$this->duplicates;
                    }else{
                        //Create device
                        Device::create([
                            'name'                  => $row[1],
                            'position'              => $row[2],
                            'ip'                    => $row[3],
                            'status'                => $row[4],
                            'device_category_id'    => $device_category->id,
                            'farm_id'               => $farm->id,
                            'created_at'            => Carbon::now(),
                            'updated_at'            => Carbon::now(),
                        ]);
                        ++$this->rows;
                    }
                }
            }
        }
    }

    public function startRow(): int
    {
        return 1;
    }

    public function getRowCount(): int
    {
        return $this->rows;
    }

    public function getDuplicateCount(): int
    {
        return $this->duplicates;
    }

    public function getDeviceCategoryNotFound(): string
    {
        return $this->device_category_not_found_row;
    }
}
