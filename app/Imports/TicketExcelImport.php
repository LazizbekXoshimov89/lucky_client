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
                'client_id' => $row[3],
                'active' => $row[4],
                'workplace' => $row[5],
                'phone_number' => $row[6],
                'filial' => $row[7],
                'filial_id' => $row[8],
                'gift_id' => $row[9],
                'is_winner' => $row[10],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                ];
            }

        }
        Ticket::insert($data);

    }


}
/*
 Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket')->unique();
            $table->Integer('contract_number');
            $table->string('client_fio');
            $table->integer('client_id');
            $table->boolean('active')->default(false);
            $table->string('workplace');
            $table->string('filial');
            $table->string('phone_number');
            $table->foreignId('gift_id')->constrained('gifts');
            $table->boolean('is_winner')->nullable();
            $table->timestamps();
            */
