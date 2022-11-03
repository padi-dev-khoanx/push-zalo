<?php

namespace App\Upload;

use App\Models\Content;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class UploadFile implements ToModel, WithStartRow
{

    public function model(array $row)
    {
        return new Content([
            'phone' => $row[0],
            'message' => $row[1],
        ]);

    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }
}