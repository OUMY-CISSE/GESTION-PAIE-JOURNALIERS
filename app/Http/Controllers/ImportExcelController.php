<?php

namespace App\Http\Controllers;
use App\Imports\ExcelsImport;
use App\Models\Atelier;
use App\Models\Excels;
use App\Models\Tarif_Horaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

class ImportExcelController extends Controller
{
    public function index() 
    {
       
     $excels = Excels::get();
     return view('excel.excel', compact('excels'));
    
    }

    public function import(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xlsx'
        ]);

        Excel::import(new ExcelsImport, $request->file('excel_file'));

        return redirect()->back()->with('success', 'File imported successfully');

    }


    public function destroy() 
    {

        Excels::truncate();

        return redirect()->route('excels')->with('success', 'Imported Files deleted successfully');
    }

    public function filtertableau(Request $request)
    {
        $request->validate([
            'start_dates' => 'required|date',
            'end_dates' => 'required|date|after_or_equal:start_date',
            
        ]);
    
        $start_dates = $request->start_dates;
        $end_dates = $request->end_dates;
       
    
        $excels = Excels::whereBetween('date', [$start_dates, $end_dates])
                                        
                                        ->orderBy('date')
                                        ->get();
    
        return view('excel.excel', compact('excels', 'start_dates', 'end_dates'));
    }
    

}

