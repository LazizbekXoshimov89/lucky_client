<?php

namespace App\Imports;

use App\Models\Gift;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;

class GiftExcelImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        $rows->shift();
        $data = [];
        foreach ($rows as $row) {
            if ($row[0]) {
                $data[] = [
                    'title' => $row[0],
                    'count' => $row[1],
                    'current_count' => $row[2],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
            }
        }
        Gift::insert($data);
    }
}
