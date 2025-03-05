<?php

namespace App\Imports;

use App\Models\Ticket;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;

class TicketExcelImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row){
            Log::error($row[0]);
            Ticket::create([
               'title' => $row[0],
                'count' => $row[1],
                'current_count' => $row[2],
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            // Your code here to perform any necessary operations with the imported data.
          }
    }
}
