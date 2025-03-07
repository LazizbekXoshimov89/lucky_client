<?php

namespace App\Http\Controllers;

use App\Imports\TicketExcelImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function importFromExcel(Request $request)
     {
         $request->validate([
             'file' => 'required|mimes:xlsx,xls',
         ]);
         $file = $request->file('file');

         Excel::import(new TicketExcelImport, $file);
         return response()->json(['message'=>'Excel file import qilindi!']);
     }
     
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
