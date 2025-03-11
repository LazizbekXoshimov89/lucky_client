<?php

namespace App\Http\Controllers;

use App\Http\Requests\GiftSecondRequest;
use App\Models\Gift;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function winBakal()
    {
        $count = 3;
        $giftId = Gift::where('title', 'bakal')->value('id');
        for ($i = 0; $i < $count; $i++) {
            $win = Ticket::where('is_winner', false)->inRandomOrder()->take(1)->pluck('client_id');

            Ticket::where('client_id', $win)->update(
                [
                    'is_winner' => 1,
                    'gift_id' => $giftId,
                    'updated_at' => date('Y-m-d'),
                ]
            );
        }

        return  Ticket::where('is_winner', true)
            ->orderBy('client_fio')
            ->get()
            ->unique('client_fio')
            ->values();
    }








    /**
     * Store a newly created resource in storage.
     */
    public function secondUsul(GiftSecondRequest $request)
    {   DB::beginTransaction();
        try{
        //$giftCount = gift::where('id', $request->id)->first();
        $gift = gift::find($request->id);

        if ($gift->current_count <= 0) {
            return "bu id li sovg'a uchun allaqachon g'oliblar aniqlangan";
        }
        for ($i = 0; $i < $gift->current_count; $i++) {
            $win = Ticket::where('active', false)->inRandomOrder()->first();

            Ticket::where('client_id', $win->client_id)->update(
                [
                    'active' => true,
                    'updated_at' => date('Y-m-d'),
                ]
            );
            $win->update([
                'is_winner' => true,
                'gift_id' => $request->id
            ]);
        }
        $gift->update([
            'current_count' => 0,
        ]);

    DB::commit();
        return  Ticket::where('is_winner', true)
            ->orderBy('client_fio')
            ->get()
            ->unique('client_fio')
            ->values();

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

// <?php
// function distributeGifts($participants, $gifts) {
//     // Ishtirokchilarni aralashtiramiz
//     shuffle($participants);

//     $winners = []; // G'oliblarni saqlash uchun array

//     foreach ($gifts as $gift => $quantity) {
//         for ($i = 0; $i < $quantity; $i++) {
//             if (empty($participants)) break; // Ishtirokchilar tugasa, to'xtash

//             // Ishtirokchini tanlab, ro'yxatdan olib tashlaymiz
//             $winner = array_pop($participants);
//             $winners[$winner] = $gift;
//         }
//     }

//     return $winners;
// }

// // 200 nafar ishtirokchi yaratamiz
// $participants = range(1, 200);

// // Sovg'alar ro'yxati
// $gifts = [
//     "bakal" => 10,
//     "qalam" => 5,
//     "daftar" => 8,
//     "sumka" => 3,
//     "mashina" => 2
// ];

// $winners = distributeGifts($participants, $gifts);

// // Natijani chiqaramiz
// foreach ($winners as $participant => $gift) {
//     echo "Ishtirokchi #$participant => $gift\n";
// }
