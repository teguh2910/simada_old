<?php

namespace App\Http\Controllers;

use App\RfqGp;
use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RfqGpController extends Controller
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
        $rfqGps = RfqGp::with('supplier')->latest()->paginate(10);
        return view('rfq_gp.index', compact('rfqGps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Get data from database models
        $suppliers = Supplier::where('is_active', 1)->orderBy('name')->get();

        return view('rfq_gp.create', compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'spec' => 'nullable|string',
            'ex_rate' => 'nullable|numeric|min:0',
            'qty_month' => 'nullable|integer|min:0',
            'satuan' => 'nullable|string|max:50',
            'id_supplier' => 'nullable|array',
            'id_supplier.*' => 'exists:suppliers,id'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();
        // Convert supplier array to JSON for storage
        if (isset($data['id_supplier']) && is_array($data['id_supplier'])) {
            $data['id_supplier'] = json_encode($data['id_supplier']);
        }

        RfqGp::create($data);

        Session::flash('success', 'RFQ GP created successfully!');
        return redirect()->route('rfq-gp.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rfqGp = RfqGp::with('supplier')->findOrFail($id);
        return view('rfq_gp.show', compact('rfqGp'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rfqGp = RfqGp::findOrFail($id);
        $suppliers = Supplier::where('is_active', 1)->orderBy('name')->get();

        return view('rfq_gp.edit', compact('rfqGp', 'suppliers'));
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
        $validator = Validator::make($request->all(), [
            'spec' => 'nullable|string',
            'ex_rate' => 'nullable|numeric|min:0',
            'qty_month' => 'nullable|integer|min:0',
            'satuan' => 'nullable|string|max:50',
            'id_supplier' => 'nullable|array',
            'id_supplier.*' => 'exists:suppliers,id'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $rfqGp = RfqGp::findOrFail($id);
        $data = $request->all();

        // Convert supplier array to JSON for storage
        if (isset($data['id_supplier']) && is_array($data['id_supplier'])) {
            $data['id_supplier'] = json_encode($data['id_supplier']);
        }

        $rfqGp->update($data);

        Session::flash('success', 'RFQ GP updated successfully!');
        return redirect()->route('rfq-gp.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rfqGp = RfqGp::findOrFail($id);
        $rfqGp->delete();

        Session::flash('success', 'RFQ GP deleted successfully!');
        return redirect()->route('rfq-gp.index');
    }
}
