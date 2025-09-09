<?php

namespace App\Http\Controllers;
use App\stock, Excel, App\fc, App\gr, App\incoming_supplier;

use Illuminate\Http\Request;

class stockController extends Controller
{
    public function index()
    {
        // Assuming $data is the variable you want to pass to the view
        $data = \DB::table('stocks')
        ->join(\DB::raw('(SELECT * FROM fcs ORDER BY created_at DESC) as latest_fcs'), function ($join) {
            $join->on('stocks.pn_after', '=', 'latest_fcs.pn_after');
        })
        ->join(\DB::raw('(SELECT * FROM gr_aisins ORDER BY created_at DESC) as latest_gr_aisins'), function ($join) {
            $join->on('stocks.pn_after', '=', 'latest_gr_aisins.pn_after');
        })
        ->join(\DB::raw('(SELECT * FROM incoming_suppliers ORDER BY created_at DESC) as latest_incoming_suppliers'), function ($join) {
            $join->on('stocks.pn_after', '=', 'latest_incoming_suppliers.pn_after');
        })
        ->select('stocks.*', 'latest_fcs.*', 'latest_gr_aisins.*', 'latest_incoming_suppliers.*')
        ->groupBy('stocks.pn_after', 'stocks.id_stock','stocks.supplier','stocks.pn_before','stocks.part_name','stocks.activity','stocks.stock','stocks.created_at','stocks.updated_at')
        ->get();
    

        //dd($data);
        return view('dash_stock', compact('data'));
    }
    public function view_stock($id)
    {
        // Assuming $data is the variable you want to pass to the view
        $data = \DB::table('stocks')
        ->join('fcs', 'stocks.pn_after', '=', 'fcs.pn_after')
        ->join('gr_aisins', 'stocks.pn_after', '=', 'gr_aisins.pn_after')
        ->join('incoming_suppliers', 'stocks.pn_after', '=', 'incoming_suppliers.pn_after')
        ->where('stocks.id_stock', '=', $id)
        ->select('stocks.*', 'fcs.*', 'gr_aisins.*', 'incoming_suppliers.*')
        ->first();
        //dd($data);
        return view('stock', compact('data'));
    }
    public function upload_stock() {
        return view('upload_stock');
    }
    public function store_upload_stock(Request $request) {
        // Check if a file was uploaded
        if ($request->hasFile('stock')) {
            // Get the uploaded file
            $file = $request->file('stock');
            // Process the Excel file
            Excel::load($file, function($reader) use($request) {
    
                // Getting all results
                $results = $reader->get();
                //dd($results);
                foreach($results as $result){
                    if($result->pn_after == null){
                        break;
                    }
                    $stock = new stock;
                    $stock->supplier = $result->supplier;
                    $stock->pn_before = $result->pn_before;
                    $stock->pn_after = $result->pn_after;
                    $stock->part_name = $result->part_name;
                    $stock->activity = $result->activity;
                    $stock->stock = $result->stock;
                    $stock->save();
                }
                });                
            }
            if ($request->hasFile('data_fc')) {
                // Get the uploaded file
                $file = $request->file('data_fc');
                // Process the Excel file
                Excel::load($file, function($reader) use($request) {
        
                    // Getting all results
                    $results = $reader->get();
                
                    foreach($results as $result){
                        if($result->pn_after == null){
                            break;
                        }
                        $fc = new fc;
                        $fc->pn_after = $result->pn_after;
                        $fc->fc_4 = $result->fc_4;
                        $fc->fc_5 = $result->fc_5;
                        $fc->fc_6 = $result->fc_6;
                        $fc->fc_7 = $result->fc_7;
                        $fc->fc_8 = $result->fc_8;
                        $fc->fc_9 = $result->fc_9;
                        $fc->fc_10 = $result->fc_10;
                        $fc->fc_11 = $result->fc_11;
                        $fc->fc_12 = $result->fc_12;
                        $fc->fc_1 = $result->fc_1;
                        $fc->fc_2 = $result->fc_2;
                        $fc->fc_3 = $result->fc_3;
                        $fc->tahun = $result->tahun;
                        $fc->save();
                    }
                    });                
                }
                if ($request->hasFile('gr_aisin')) {
                    // Get the uploaded file
                    $file = $request->file('gr_aisin');
                    // Process the Excel file
                    Excel::load($file, function($reader) use($request) {
            
                        // Getting all results
                        $results = $reader->get();
                    
                        foreach($results as $result){
                            if($result->pn_after == null){
                                break;
                            }
                            $gr_aisin = new gr;
                            $gr_aisin->pn_after = $result->pn_after;
                            $gr_aisin->gr_aisin_4 = $result->gr_aisin_4;
                            $gr_aisin->gr_aisin_5 = $result->gr_aisin_5;
                            $gr_aisin->gr_aisin_6 = $result->gr_aisin_6;
                            $gr_aisin->gr_aisin_7 = $result->gr_aisin_7;
                            $gr_aisin->gr_aisin_8 = $result->gr_aisin_8;
                            $gr_aisin->gr_aisin_9 = $result->gr_aisin_9;
                            $gr_aisin->gr_aisin_10 = $result->gr_aisin_10;
                            $gr_aisin->gr_aisin_11 = $result->gr_aisin_11;
                            $gr_aisin->gr_aisin_12 = $result->gr_aisin_12;
                            $gr_aisin->gr_aisin_1 = $result->gr_aisin_1;
                            $gr_aisin->gr_aisin_2 = $result->gr_aisin_2;
                            $gr_aisin->gr_aisin_3 = $result->gr_aisin_3;
                            $gr_aisin->tahun = $result->tahun;
                            $gr_aisin->save();
                        }
                        });                
                    }
                    if ($request->hasFile('incoming_supplier')) {
                        // Get the uploaded file
                        $file = $request->file('incoming_supplier');
                        // Process the Excel file
                        Excel::load($file, function($reader) use($request) {
                
                            // Getting all results
                            $results = $reader->get();
                        
                            foreach($results as $result){
                                if($result->pn_after == null){
                                    break;
                                }
                                $incoming_supplier = new incoming_supplier;
                                $incoming_supplier->pn_after = $result->pn_after;
                                $incoming_supplier->incoming_supplier_4 = $result->incoming_supplier_4;
                                $incoming_supplier->incoming_supplier_5 = $result->incoming_supplier_5;
                                $incoming_supplier->incoming_supplier_6 = $result->incoming_supplier_6;
                                $incoming_supplier->incoming_supplier_7 = $result->incoming_supplier_7;
                                $incoming_supplier->incoming_supplier_8 = $result->incoming_supplier_8;
                                $incoming_supplier->incoming_supplier_9 = $result->incoming_supplier_9;
                                $incoming_supplier->incoming_supplier_10 = $result->incoming_supplier_10;
                                $incoming_supplier->incoming_supplier_11 = $result->incoming_supplier_11;
                                $incoming_supplier->incoming_supplier_12 = $result->incoming_supplier_12;
                                $incoming_supplier->incoming_supplier_1 = $result->incoming_supplier_1;
                                $incoming_supplier->incoming_supplier_2 = $result->incoming_supplier_2;
                                $incoming_supplier->incoming_supplier_3 = $result->incoming_supplier_3;
                                $incoming_supplier->tahun = $result->tahun;
                                $incoming_supplier->save();
                            }
                            });                
                        }
            return redirect('stock');
        }            
}
