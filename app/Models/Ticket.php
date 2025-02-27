<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = [
        'ticket',
        'contract_number',
        'client_fio',
        'workplace',
        'filial',
        'phone_number',
        'gift_id',
        'is_winner',
    ];
}
