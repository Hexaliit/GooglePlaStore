<?php

namespace App\Imports;

use App\Models\App;
use Maatwebsite\Excel\Concerns\ToModel;

class AppsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new App([
            'name' =>$row[0],
            'category' =>$row[1],
            'rating' =>$row[2],
            'reviews' =>$row[3],
            'size' =>$row[4],
            'installs' =>$row[5],
            'type' =>$row[6],
            'price' =>$row[7],
            'content_range' =>$row[8],
            'genres' =>$row[9],
            'last_update' =>$row[10],
            'current_version' =>$row[11],
            'android_version' =>$row[12]
        ]);
    }
}
