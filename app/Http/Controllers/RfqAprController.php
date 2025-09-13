<?php

namespace App\Http\Controllers;

use App\RfqApr;
use App\Pic;
use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RfqAprController extends Controller
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
        $rfqAprs = RfqApr::latest()->paginate(10);
        return view('rfq_apr.index', compact('rfqAprs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Get data from database models
        $suppliers = Supplier::where('is_active', 1)->orderBy('name')->pluck('name')->toArray();
        $pics = Pic::where('is_active', 1)->orderBy('name')->get();

        // Periode options
        $currentYear = date('Y');
        $periodes = [];
        for ($year = $currentYear - 1; $year <= $currentYear + 2; $year++) {
            $periodes["Q1 {$year}"] = "Q1 {$year}";
            $periodes["Q2 {$year}"] = "Q2 {$year}";
            $periodes["Q3 {$year}"] = "Q3 {$year}";
            $periodes["Q4 {$year}"] = "Q4 {$year}";
        }

        return view('rfq_apr.create', compact('suppliers', 'pics', 'periodes'));
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
            'spec_rm' => 'required|string|max:255',
            'periode' => 'required|string|max:255',
            'due_date' => 'required|date',
            'id_supplier' => 'required|array|min:1',
            'id_supplier.*' => 'string|max:255',
            'note' => 'nullable|string',
            'pic' => 'required|integer|exists:pics,id'
        ]);

        $rfqApr = new RfqApr();
        $rfqApr->spec_rm = $request->spec_rm;
        $rfqApr->periode = $request->periode;
        $rfqApr->due_date = $request->due_date;
        $rfqApr->note = $request->note;
        $rfqApr->pic_id = $request->pic;
        $rfqApr->id_supplier = json_encode($request->id_supplier);

        $rfqApr->save();

        Session::flash('success', 'RFQ APR created successfully!');
        return redirect()->route('rfq-apr.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rfqApr = RfqApr::findOrFail($id);
        return view('rfq_apr.show', compact('rfqApr'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rfqApr = RfqApr::findOrFail($id);

        // Get data from database models
        $suppliers = Supplier::where('is_active', 1)->orderBy('name')->pluck('name')->toArray();
        $pics = Pic::where('is_active', 1)->orderBy('name')->get();

        // Periode options
        $currentYear = date('Y');
        $periodes = [];
        for ($year = $currentYear - 1; $year <= $currentYear + 2; $year++) {
            $periodes["Q1 {$year}"] = "Q1 {$year}";
            $periodes["Q2 {$year}"] = "Q2 {$year}";
            $periodes["Q3 {$year}"] = "Q3 {$year}";
            $periodes["Q4 {$year}"] = "Q4 {$year}";
        }

        return view('rfq_apr.edit', compact('rfqApr', 'suppliers', 'pics', 'periodes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'spec_rm' => 'required|string|max:255',
            'periode' => 'required|string|max:255',
            'due_date' => 'required|date',
            'id_supplier' => 'required|array|min:1',
            'id_supplier.*' => 'string|max:255',
            'note' => 'nullable|string',
            'pic' => 'required|integer|exists:pics,id'
        ]);

        $rfqApr = RfqApr::findOrFail($id);
        $rfqApr->spec_rm = $request->spec_rm;
        $rfqApr->periode = $request->periode;
        $rfqApr->due_date = $request->due_date;
        $rfqApr->note = $request->note;
        $rfqApr->pic_id = $request->pic;
        $rfqApr->id_supplier = json_encode($request->id_supplier);

        $rfqApr->save();

        Session::flash('success', 'RFQ APR updated successfully!');
        return redirect()->route('rfq-apr.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rfqApr = RfqApr::findOrFail($id);
        $rfqApr->delete();

        Session::flash('success', 'RFQ APR deleted successfully!');
        return redirect()->route('rfq-apr.index');
    }
}
