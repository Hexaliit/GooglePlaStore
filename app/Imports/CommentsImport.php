<?php

namespace App\Imports;

use App\Models\Comment;
use Maatwebsite\Excel\Concerns\ToModel;

class CommentsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Comment([
            'app'   => $row[0],
            'review'   => $row[1],
            'sentiment'   => $row[2],
            'sentiment_polarity'   => $row[3],
            'sentiment_subjectivity'   => $row[4]
        ]);
    }
}
