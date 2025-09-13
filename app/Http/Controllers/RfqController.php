<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rfq;
use App\Customer;
use App\Product;
use App\Supplier;
use App\Pic;
use Auth;
use Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\RfqEmail;

class RfqController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rfqs = Rfq::latest()->get();
        return view('rfq.index', compact('rfqs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Get data from database models
        $customers = Customer::where('is_active', 1)->orderBy('name')->pluck('name')->toArray();
        $products = Product::where('is_active', 1)->orderBy('name')->pluck('name')->toArray();
        $suppliers = Supplier::where('is_active', 1)->orderBy('name')->pluck('name')->toArray();
        $pics = Pic::where('is_active', 1)->orderBy('name')->get();

        return view('rfq.create', compact('customers', 'products', 'suppliers', 'pics'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'customer' => 'required|string|max:255',
            'produk' => 'required|string|max:255',
            'std_qty' => 'required|integer|min:1',
            'drawing_time' => 'nullable|date',
            'OTS_Target' => 'nullable|date',
            'OTOP_target' => 'nullable|date',
            'SOP' => 'nullable|date',
            'part_number' => 'required|string|max:255',
            'part_name' => 'required|string|max:255',
            'qty_month' => 'required|integer|min:1',
            'note' => 'nullable|string',
            'due_date' => 'required|date',
            'pic' => 'required|integer|exists:pics,id',
            'id_supplier' => 'required|array|min:1',
            'id_supplier.*' => 'string|max:255',
            'drawing_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png,dwg|max:10240',
            'excel_term_file' => 'nullable|file|mimes:xlsx,xls,csv|max:10240',
            'loading_capacity_file' => 'nullable|file|mimes:pdf,xlsx,xls,doc,docx|max:10240',
        ]);

        $rfq = new Rfq();
        $rfq->customer = $request->customer;
        $rfq->produk = $request->produk;
        $rfq->std_qty = $request->std_qty;
        $rfq->drawing_time = $request->drawing_time;
        $rfq->OTS_Target = $request->OTS_Target;
        $rfq->OTOP_target = $request->OTOP_target;
        $rfq->SOP = $request->SOP;
        $rfq->part_number = $request->part_number;
        $rfq->part_name = $request->part_name;
        $rfq->qty_month = $request->qty_month;
        $rfq->note = $request->note;
        $rfq->due_date = $request->due_date;
        $rfq->pic_id = $request->pic;
        $rfq->id_supplier = json_encode($request->id_supplier);

        // Handle file uploads
        if ($request->hasFile('drawing_file')) {
            $rfq->drawing_file = $request->file('drawing_file')->store('rfq/drawings', 'public');
        }
        
        if ($request->hasFile('excel_term_file')) {
            $rfq->excel_term_file = $request->file('excel_term_file')->store('rfq/excel_terms', 'public');
        }
        
        if ($request->hasFile('loading_capacity_file')) {
            $rfq->loading_capacity_file = $request->file('loading_capacity_file')->store('rfq/loading_capacity', 'public');
        }

        $rfq->save();

        return redirect()->route('rfq.index')->with('success', 'RFQ created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Rfq $rfq)
    {
        return view('rfq.show', compact('rfq'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Rfq $rfq)
    {
        // Get data from database models
        $customers = Customer::where('is_active', 1)->orderBy('name')->pluck('name')->toArray();
        $products = Product::where('is_active', 1)->orderBy('name')->pluck('name')->toArray();
        $suppliers = Supplier::where('is_active', 1)->orderBy('name')->pluck('name')->toArray();
        $pics = Pic::where('is_active', 1)->orderBy('name')->get();

        return view('rfq.edit', compact('rfq', 'customers', 'products', 'suppliers', 'pics'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rfq $rfq)
    {
        $this->validate($request, [
            'customer' => 'required|string|max:255',
            'produk' => 'required|string|max:255',
            'std_qty' => 'required|integer|min:1',
            'drawing_time' => 'nullable|date',
            'OTS_Target' => 'nullable|date',
            'OTOP_target' => 'nullable|date',
            'SOP' => 'nullable|date',
            'part_number' => 'required|string|max:255',
            'part_name' => 'required|string|max:255',
            'qty_month' => 'required|integer|min:1',
            'note' => 'nullable|string',
            'due_date' => 'required|date',
            'pic' => 'required|integer|exists:pics,id',
            'id_supplier' => 'required|array|min:1',
            'id_supplier.*' => 'string|max:255',
            'drawing_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png,dwg|max:10240',
            'excel_term_file' => 'nullable|file|mimes:xlsx,xls,csv|max:10240',
            'loading_capacity_file' => 'nullable|file|mimes:pdf,xlsx,xls,doc,docx|max:10240',
        ]);

        $rfq->customer = $request->customer;
        $rfq->produk = $request->produk;
        $rfq->std_qty = $request->std_qty;
        $rfq->drawing_time = $request->drawing_time;
        $rfq->OTS_Target = $request->OTS_Target;
        $rfq->OTOP_target = $request->OTOP_target;
        $rfq->SOP = $request->SOP;
        $rfq->part_number = $request->part_number;
        $rfq->part_name = $request->part_name;
        $rfq->qty_month = $request->qty_month;
        $rfq->note = $request->note;
        $rfq->due_date = $request->due_date;
        $rfq->pic_id = $request->pic;
        $rfq->id_supplier = json_encode($request->id_supplier);
        $rfq->customer = $request->customer;
        $rfq->produk = $request->produk;
        $rfq->std_qty = $request->std_qty;
        $rfq->drawing_time = $request->drawing_time;
        $rfq->OTS_Target = $request->OTS_Target;
        $rfq->OTOP_target = $request->OTOP_target;
        $rfq->SOP = $request->SOP;
        $rfq->part_number = $request->part_number;
        $rfq->part_name = $request->part_name;
        $rfq->qty_month = $request->qty_month;
        $rfq->note = $request->note;
        $rfq->due_date = $request->due_date;
        $rfq->pic_id = $request->pic;
        $rfq->id_supplier = json_encode($request->id_supplier);

        // Handle file uploads
        if ($request->hasFile('drawing_file')) {
            // Delete old file if exists
            if ($rfq->drawing_file && Storage::disk('public')->exists($rfq->drawing_file)) {
                Storage::disk('public')->delete($rfq->drawing_file);
            }
            $rfq->drawing_file = $request->file('drawing_file')->store('rfq/drawings', 'public');
        }
        
        if ($request->hasFile('excel_term_file')) {
            // Delete old file if exists
            if ($rfq->excel_term_file && Storage::disk('public')->exists($rfq->excel_term_file)) {
                Storage::disk('public')->delete($rfq->excel_term_file);
            }
            $rfq->excel_term_file = $request->file('excel_term_file')->store('rfq/excel_terms', 'public');
        }
        
        if ($request->hasFile('loading_capacity_file')) {
            // Delete old file if exists
            if ($rfq->loading_capacity_file && Storage::disk('public')->exists($rfq->loading_capacity_file)) {
                Storage::disk('public')->delete($rfq->loading_capacity_file);
            }
            $rfq->loading_capacity_file = $request->file('loading_capacity_file')->store('rfq/loading_capacity', 'public');
        }

        $rfq->save();

        return redirect()->route('rfq.index')->with('success', 'RFQ updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rfq $rfq)
    {
        // Delete associated files
        if ($rfq->drawing_file && Storage::disk('public')->exists($rfq->drawing_file)) {
            Storage::disk('public')->delete($rfq->drawing_file);
        }
        
        if ($rfq->excel_term_file && Storage::disk('public')->exists($rfq->excel_term_file)) {
            Storage::disk('public')->delete($rfq->excel_term_file);
        }
        
        if ($rfq->loading_capacity_file && Storage::disk('public')->exists($rfq->loading_capacity_file)) {
            Storage::disk('public')->delete($rfq->loading_capacity_file);
        }

        $rfq->delete();

        return redirect()->route('rfq.index')->with('success', 'RFQ deleted successfully.');
    }

    /**
     * Send email for the specified RFQ.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sendEmail(Rfq $rfq)
    {
        try {
            // For demo purposes, send to a dummy email
            // In production, you would send to actual supplier emails
            $dummyEmail = 'supplier@example.com';

            \Log::info('Attempting to send RFQ email', [
                'rfq_id' => $rfq->id,
                'part_name' => $rfq->part_name,
                'email' => $dummyEmail
            ]);

            Mail::to($dummyEmail)->send(new RfqEmail($rfq));

            \Log::info('RFQ email sent successfully', ['rfq_id' => $rfq->id]);

            return redirect()->route('rfq.index')->with('success', 'Email sent successfully for RFQ: ' . $rfq->part_name);

        } catch (\Exception $e) {
            \Log::error('Failed to send RFQ email', [
                'rfq_id' => $rfq->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->route('rfq.index')->with('error', 'Failed to send email: ' . $e->getMessage());
        }
    }
}
