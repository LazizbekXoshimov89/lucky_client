<?php

namespace App\Imports;

use App\Models\Ticket;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class TicketExcelImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        $rows->shift();
        $data =[];
        foreach ($rows as $row){
            if($row[0]){
                $data[] = [
                'ticket' => $row[0],
                'contract_number' => $row[1],
                'client_fio' => $row[2],
                'workplace' => $row[3],
                'filial' => $row[4],
                'phone_number' => $row[5],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                ];
            }

        }
        Ticket::insert($data);

    }


}
