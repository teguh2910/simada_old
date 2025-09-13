<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CustomersImport;
use App\Imports\ProductsImport;
use App\Imports\SuppliersImport;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ImportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the import form
     */
    public function index()
    {
        return view('imports.index');
    }

    /**
     * Import customers from Excel
     */
    public function importCustomers(Request $request)
    {
        // More flexible validation for CSV files
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|max:2048',
        ]);

        if ($validator->fails()) {
            Session::flash('error', 'Validation failed: ' . implode(', ', $validator->errors()->all()));
            return redirect()->back();
        }

        // Check file extension manually for more flexibility
        $file = $request->file('file');
        $extension = strtolower($file->getClientOriginalExtension());

        if (!in_array($extension, ['xlsx', 'xls', 'csv'])) {
            Session::flash('error', 'Validation failed: The file must be a file of type: xlsx, xls, csv.');
            return redirect()->back();
        }

        try {
            $import = new CustomersImport();

            Excel::load($request->file('file'), function($reader) use ($import) {
                $rows = $reader->get();
                $import->handle($rows);
            });

            Session::flash('success', 'Customers imported successfully!');
            return redirect()->back();
        } catch (\Exception $e) {
            Session::flash('error', 'Import failed: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Import products from Excel
     */
    public function importProducts(Request $request)
    {
        // More flexible validation for CSV files
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|max:2048',
        ]);

        if ($validator->fails()) {
            Session::flash('error', 'Validation failed: ' . implode(', ', $validator->errors()->all()));
            return redirect()->back();
        }

        // Check file extension manually for more flexibility
        $file = $request->file('file');
        $extension = strtolower($file->getClientOriginalExtension());

        if (!in_array($extension, ['xlsx', 'xls', 'csv'])) {
            Session::flash('error', 'Validation failed: The file must be a file of type: xlsx, xls, csv.');
            return redirect()->back();
        }

        try {
            $import = new ProductsImport();

            Excel::load($request->file('file'), function($reader) use ($import) {
                $rows = $reader->get();
                $import->handle($rows);
            });

            Session::flash('success', 'Products imported successfully!');
            return redirect()->back();
        } catch (\Exception $e) {
            Session::flash('error', 'Import failed: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Import suppliers from Excel
     */
    public function importSuppliers(Request $request)
    {
        // More flexible validation for CSV files
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|max:2048',
        ]);

        if ($validator->fails()) {
            Session::flash('error', 'Validation failed: ' . implode(', ', $validator->errors()->all()));
            return redirect()->back();
        }

        // Check file extension manually for more flexibility
        $file = $request->file('file');
        $extension = strtolower($file->getClientOriginalExtension());

        if (!in_array($extension, ['xlsx', 'xls', 'csv'])) {
            Session::flash('error', 'Validation failed: The file must be a file of type: xlsx, xls, csv.');
            return redirect()->back();
        }

        try {
            $import = new SuppliersImport();

            Excel::load($request->file('file'), function($reader) use ($import) {
                $rows = $reader->get();
                $import->handle($rows);
            });

            Session::flash('success', 'Suppliers imported successfully!');
            return redirect()->back();
        } catch (\Exception $e) {
            Session::flash('error', 'Import failed: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}