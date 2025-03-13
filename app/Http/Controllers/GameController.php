<?php

namespace App\Http\Controllers;

use App\Http\Requests\GiftSecondRequest;
use App\Http\Requests\GiftThirdRequest;
use App\Models\Gift;
use App\Models\OrganizationGifts;
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
    {
        DB::beginTransaction();
        try {
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
    public function thirdUsul(GiftThirdRequest $request)
    {
        $gift = gift::find($request->id);

        if ($gift->current_count <= 0) {
            return "bu id li sovg'a uchun allaqachon g'oliblar aniqlangan";
        }
        for ($i = 0; $i < $gift->current_count; $i++) {
            $orgs_id = OrganizationGifts::where('gift_id', $request->id)->pluck('organization_id');
            $win = Ticket::where('active', false)
                ->whereNotIn('filial_id', $orgs_id)
                ->inRandomOrder()
                ->first();

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
            OrganizationGifts::create([
                'organization_id' => $win->filial_id,
                'gift_id' => $request->id
            ]);
        }
        $gift->update([
            'current_count' => 0,
        ]);


    }

    public function thirdUsulD(GiftThirdRequest $request)
    {
        $gift = gift::find($request->id);

        if ($gift->current_count <= 0) {
            return "bu id li sovg'a uchun allaqachon g'oliblar aniqlangan";
        }
        $orgs_id = [];
        $orgGifts = [];
        for ($i = 0; $i < $gift->current_count; $i++) {
            // $orgs_id = OrganizationGifts::where('gift_id', $request->id)
            // ->pluck('organization_id')
            // ->toArray();
            $win = Ticket::where('active', false)
                ->whereNotIn('filial_id', $orgs_id)
                ->inRandomOrder()
                ->first();

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
            $orgs_id[] = $win->organization_id;
            $orgGifts[] = [
                'organization_id' => $win->filial_id,
                'gift_id' => $request->id
            ]; // [ [organization_id => 4, gift_id => 4], [organization_id => 4, gift_id => 4] ]
            // OrganizationGifts::create([
                // 'organization_id' => $win->filial_id,
                // 'gift_id' => $request->id
            // ]);
        }

        OrganizationGifts::insert($orgGifts);
        $gift->update([
            'current_count' => 0,
            
        ]);


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


