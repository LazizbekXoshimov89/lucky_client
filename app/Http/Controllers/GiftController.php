<?php

namespace App\Http\Controllers;

use App\Imports\GiftExcelImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class GiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function importFromExcel(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        // Get the uploaded file
        $file = $request->file('file');

        // Process the Excel file
        Excel::import(new GiftExcelImport, $file);

        //return redirect()->back()->with('success', 'Excel file imported successfully!');
        return response()->json(['message'=>'Excel file import qilindi!']);
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
