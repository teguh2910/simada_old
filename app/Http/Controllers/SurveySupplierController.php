<?php

namespace App\Http\Controllers;

use App\SurveySupplier;
use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SurveySupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $surveySuppliers = SurveySupplier::with('supplier')->get();
        return view('survey-supplier.index', compact('surveySuppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = Supplier::all();
        return view('survey-supplier.create', compact('suppliers'));
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
            'link_form' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx',
            'id_supplier' => 'nullable|exists:suppliers,id',
            'due_date' => 'required|date',
            'all_suppliers' => 'nullable|boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // If all suppliers is checked, set id_supplier to null
        if ($request->has('all_suppliers') && $request->all_suppliers == '1') {
            $data = $request->except(['id_supplier', 'all_suppliers']);
            $data['id_supplier'] = null;
        } else {
            $additionalValidator = Validator::make($request->all(), [
                'id_supplier' => 'required|exists:suppliers,id'
            ]);

            if ($additionalValidator->fails()) {
                return redirect()->back()
                    ->withErrors($additionalValidator)
                    ->withInput();
            }
            $data = $request->except(['all_suppliers']);
        }

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('survey_files');
        }

        SurveySupplier::create($data);

        return redirect()->route('survey-supplier.index')->with('success', 'Survey Supplier created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $surveySupplier = SurveySupplier::with('supplier')->findOrFail($id);
        return view('survey-supplier.show', compact('surveySupplier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $surveySupplier = SurveySupplier::findOrFail($id);
        $suppliers = Supplier::all();
        return view('survey-supplier.edit', compact('surveySupplier', 'suppliers'));
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
            'link_form' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx',
            'id_supplier' => 'nullable|exists:suppliers,id',
            'due_date' => 'required|date',
            'all_suppliers' => 'nullable|boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $surveySupplier = SurveySupplier::findOrFail($id);

        // If all suppliers is checked, set id_supplier to null
        if ($request->has('all_suppliers') && $request->all_suppliers == '1') {
            $data = $request->except(['id_supplier', 'all_suppliers']);
            $data['id_supplier'] = null;
        } else {
            $additionalValidator = Validator::make($request->all(), [
                'id_supplier' => 'required|exists:suppliers,id'
            ]);

            if ($additionalValidator->fails()) {
                return redirect()->back()
                    ->withErrors($additionalValidator)
                    ->withInput();
            }
            $data = $request->except(['all_suppliers']);
        }

        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($surveySupplier->file) {
                Storage::delete($surveySupplier->file);
            }
            $data['file'] = $request->file('file')->store('survey_files');
        }

        $surveySupplier->update($data);

        return redirect()->route('survey-supplier.index')->with('success', 'Survey Supplier updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $surveySupplier = SurveySupplier::findOrFail($id);

        // Delete file if exists
        if ($surveySupplier->file) {
            Storage::delete($surveySupplier->file);
        }

        $surveySupplier->delete();

        return redirect()->route('survey-supplier.index')->with('success', 'Survey Supplier deleted successfully.');
    }
}
