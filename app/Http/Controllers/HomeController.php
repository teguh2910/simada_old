<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\transaction;
use App\komentar;
use App\LeaveRequest;
use Auth;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create()
    {        
        return view('create');
    }        
    public function create_store(Request $request)
    {
        if($request->kind_doc=='SPTT-1'){
        for ($x = 1; $x <= 7; $x++) {
        $trans=new transaction;
        $trans->project = $request->project;
        $trans->due_date = $request->due_date;
        $trans->supplier = $request->supplier;
        $trans->part_number = $request->part_number;
        $trans->status = 0;                
        $trans->id_document = $x;           
        $trans->revise = 0;
        $trans->pic = Auth::user()->name;
        $trans->npk = Auth::user()->npk;
        $trans->save();
        }
        for ($x = 31; $x <= 32; $x++) {
        $trans=new transaction;
        $trans->project = $request->project;
        $trans->due_date = $request->due_date;
        $trans->supplier = $request->supplier;
        $trans->part_number = $request->part_number;
        $trans->status = 0;                
        $trans->id_document = $x;           
        $trans->revise = 0;
        $trans->pic = Auth::user()->name;
        $trans->npk = Auth::user()->npk;
        $trans->save();
        }
        }elseif($request->kind_doc=='SPTT-2'){
        for ($x = 8; $x <= 27; $x++) {
        $trans=new transaction;
        $trans->project = $request->project;
        $trans->due_date = $request->due_date;
        $trans->supplier = $request->supplier;
        $trans->part_number = $request->part_number;
        $trans->status = 0;                
        $trans->id_document = $x;           
        $trans->revise = 0;
        $trans->pic = Auth::user()->name;
        $trans->npk = Auth::user()->npk;
        $trans->save();
        }
        }else{
        for ($x = 28; $x <= 30; $x++) {
        $trans=new transaction;
        $trans->project = $request->project;
        $trans->due_date = $request->due_date;
        $trans->supplier = $request->supplier;
        $trans->part_number = $request->part_number;
        $trans->status = 0;                
        $trans->id_document = $x;           
        $trans->revise = 0;
        $trans->pic = Auth::user()->name;
        $trans->npk = Auth::user()->npk;
        $trans->save();
        }
        }        
        return redirect('/')->with(['success' => 'Sukses Simpan']);
    }
    public function index()
    {
        $data=transaction::join('documents','documents.id','=','transactions.id_document')
        ->whereNull('file')
        ->where('is_need',1)
        ->get();
        return view('home',compact('data'));
    }
    public function upload($id)
    {
        $doc=transaction::join('documents','documents.id','=','transactions.id_document')
        ->where('transactions.id_transaction',$id)
        ->get();
        return view('upload',compact(['doc','id']));
    }
    public function upload_store($id, Request $request)
    {      
        $this->validate($request, [
            'file' => 'required',
        ]);
        DB::table('transactions')
            ->where('id_transaction', $id)
            ->update(['file' => $request->file('file')->storeAs('uploads/'.$id, $request->doc_file.'.'.$request->file('file')->extension(), 'public')]);
        return redirect('/')->with(['success' => 'Sukses Simpan']);
    }
    public function draft()
    {
        $data=transaction::join('documents','documents.id','=','transactions.id_document')
        ->whereNotNull('file')
        ->where('status',0)
        ->get();
        return view('draft',compact('data'));
    }
    public function revise($id)
    {
        $doc=transaction::join('documents','documents.id','=','transactions.id_document')
        ->where('transactions.id_transaction',$id)
        ->get();
        return view('revise',compact(['doc','id']));
    }
    public function revise_store($id, Request $request)
    {      
        $this->validate($request, [
            'file' => 'required',
        ]);        
            $trans=new transaction;
            $trans->project = $request->project;
            $trans->due_date = $request->due_date;
            $trans->supplier = $request->supplier;
            $trans->part_number = $request->part_number;
            $trans->status = 0;                
            $trans->id_document = $request->id_document;           
            $trans->revise = $request->revise;
            $trans->file = $request->file('file')->storeAs('uploads/'.$id, $request->doc_file.".pdf", 'public');
            $trans->pic = Auth::user()->name;
            $trans->npk = Auth::user()->npk;
            $trans->save();                    
            return redirect('/draft')->with(['success' => 'Sukses Simpan']);        
    }
    public function feedback($id)
    {
        $doc=transaction::where('id_transaction',$id)->get();
        return view('komentar',compact(['doc','id']));
    }
    public function feedback_store($id, Request $request)
    {         
        DB::table('komentars')
            ->insert([
                'id_transactions' => $id,
                'pic_k' => Auth::user()->name,
                'npk_k' => Auth::user()->npk,
                'dep_k' => Auth::user()->dept,
                'komentar' => $request->komentar,
            ]);
        return redirect('/draft')->with(['success' => 'Sukses Simpan']);
    }
    public function viewfeedback($id)
    {
        $data=transaction::join('documents','documents.id','=','transactions.id_document')
        ->leftjoin('komentars','komentars.id_transactions','transactions.id_transaction')
        ->where('komentars.id_transactions',$id)
        ->get();
        return view('view_komentar',compact(['data','id']));
    }
    public function final($id, Request $request)
    {         
        DB::table('transactions')
            ->where('id_transaction', $id)
            ->update([
                'status' => 1,                
            ]);
        return redirect('/draft')->with(['success' => 'Sukses Simpan']);
    }
    public function final_view()
    {
        $data=transaction::join('documents','documents.id','=','transactions.id_document')
        ->leftjoin('komentars','komentars.id_transactions','transactions.id_transaction')
        ->whereNotNull('file')
        ->where('status',1)
        ->get();  
        return view('final',compact('data'));
    }
    public function overdue()
    {        
        $data=transaction::join('documents','documents.id','=','transactions.id_document')
        ->leftjoin('komentars','komentars.id_transactions','transactions.id_transaction')
        ->whereNull('file')
        ->where('is_need',1)
        ->whereDate('due_date', '<=', Carbon::today())
        ->get();     
        return view('overdue',compact('data'));
    }
    public function del($id)
    {
        transaction::where('id_transaction',$id)->delete();
        return redirect('/draft');
    }   
    public function noneed($id)
    {         
        DB::table('transactions')
            ->where('id_transaction', $id)
            ->update([
                'is_need' => 0,                
            ]);
        return redirect('/')->with(['success' => 'Sukses']);
    }
    public function dashboard()
    {
        $outs=transaction::join('documents','documents.id','=','transactions.id_document')
        ->whereNull('file')
        ->where('is_need',1)
        ->count();
        $draft=transaction::join('documents','documents.id','=','transactions.id_document')
        ->whereNotNull('file')
        ->where('status',0)
        ->count();
        $final=transaction::join('documents','documents.id','=','transactions.id_document')
        ->leftjoin('komentars','komentars.id_transactions','transactions.id_transaction')
        ->whereNotNull('file')
        ->where('status',1)
        ->count(); 
        $overd=transaction::join('documents','documents.id','=','transactions.id_document')
        ->leftjoin('komentars','komentars.id_transactions','transactions.id_transaction')
        ->whereNull('file')
        ->where('is_need',1)
        ->whereDate('due_date', '<=', Carbon::today())
        ->count();

        // PCR Statistics
        $url = 'https://n8n.servercikarang.cloud/webhook/list-pcr';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);

        $pcrData = json_decode($response, true);

        // Initialize PCR counts
        $pcrTotal = 0;
        $pcrFinish = 0;
        $pcrCancel = 0;
        $pcrOnHold = 0;
        $pcrStage0 = 0;
        $pcrStage1 = 0;
        $pcrStage2 = 0;
        $pcrStage3 = 0;

        if (is_array($pcrData)) {
            $pcrTotal = count($pcrData);

            foreach ($pcrData as $item) {
                $status = $item['Status'] ?? '';

                switch ($status) {
                    case 'Finish':
                    case 'Completed':
                    case 'Done':
                        $pcrFinish++;
                        break;
                    case 'Cancel':
                    case 'Cancelled':
                    case 'Canceled':
                        $pcrCancel++;
                        break;
                    case 'On Hold':
                        $pcrOnHold++;
                        break;
                    case 'Stage 0 Progress':
                        $pcrStage0++;
                        break;
                    case 'Stage 1 Progress':
                        $pcrStage1++;
                        break;
                    case 'Stage 2 Progress':
                        $pcrStage2++;
                        break;
                    case 'Stage 3 Progress':
                        $pcrStage3++;
                        break;
                }
            }
        }

        // Leave Statistics
        $todayLeavesCount = LeaveRequest::whereIn('status', ['approved', 'pending'])
            ->whereDate('leave_date', Carbon::today())
            ->count();
        $pendingLeavesCount = LeaveRequest::where('status', 'pending')->count();
        $approvedLeavesCount = LeaveRequest::where('status', 'approved')
            ->whereMonth('approved_at', Carbon::now()->month)
            ->whereYear('approved_at', Carbon::now()->year)
            ->count();
        $totalLeavesCount = LeaveRequest::count();

        // Today's leave details (show both pending and approved)
        $todayLeaves = LeaveRequest::with('user', 'approver')
            ->whereIn('status', ['approved', 'pending'])
            ->whereDate('leave_date', Carbon::today())
            ->orderBy('status', 'desc') // Show approved first, then pending
            ->orderBy('created_at', 'desc')
            ->get();

        // User Statistics
        $totalUsersCount = \App\User::count();
        $activeUsersCount = \App\User::count(); // In Laravel 5, count all users as active since no email verification
        $mimUsersCount = \App\User::where('dept', 'MIM')->count();
        $nplUsersCount = \App\User::where('dept', 'NPL')->count();

        return view('dashboard', compact([
            'outs','draft','final','overd',
            'pcrTotal','pcrFinish','pcrCancel','pcrOnHold','pcrStage0','pcrStage1','pcrStage2','pcrStage3',
            'todayLeavesCount','pendingLeavesCount','approvedLeavesCount','totalLeavesCount','todayLeaves',
            'totalUsersCount','activeUsersCount','mimUsersCount','nplUsersCount'
        ]));
    }

    public function listPcr()
    {
        
        
        // Uncomment below when webhook is active
        
        $url = 'https://n8n.servercikarang.cloud/webhook/list-pcr';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        
        $data = json_decode($response, true);
        
        
        return view('list_pcr', compact('data'));
    }

    public function listPendingPcr()
    {
    
        // Uncomment below when webhook is active
        $url = 'https://n8n.servercikarang.cloud/webhook/list-pcr';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);
        $pendingStatuses = ['On Hold', 'Stage 0 Progress', 'Stage 1 Progress', 'Stage 2 Progress', 'Stage 3 Progress'];
        $filteredData = array_filter($data, function($item) use ($pendingStatuses) {
            return in_array($item['Status'] ?? '', $pendingStatuses);
        });
        

        return view('list_pending_pcr', compact('filteredData'));
    }

    public function createPcr()
    {
        return view('create_pcr');
    }

    public function storePcr(Request $request)
    {
        // Validate the request
        $request->validate([
            'pur_pic' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'reg_numb' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'coy' => 'required|string|max:255',
            'supplier' => 'required|string|max:255',
            'classification' => 'required|string|max:255',
            'problem' => 'required|string|max:255',
            'type_of_activity' => 'required|string|max:255',
            'activity_description' => 'required|string',
            'part_name' => 'required|string|max:255',
            'part_no' => 'required|string|max:255',
            'product' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'plan_svp' => 'required|string|max:255',
            'act_svp' => 'required|string|max:255',
        ]);

        // Prepare data for webhook
        $pcrData = [
            'Pur PIC' => $request->pur_pic,
            'Department' => $request->department,
            'Reg Numb' => $request->reg_numb,
            'Status' => $request->status,
            'Coy' => $request->coy,
            'Supplier' => $request->supplier,
            'Classification' => $request->classification,
            'Problem' => $request->problem,
            'Type of activity' => $request->type_of_activity,
            'Activity Description' => $request->activity_description,
            'Part Name' => $request->part_name,
            'Part No' => $request->part_no,
            'Product' => $request->product,
            'Model' => $request->model,
            'Plan SVP' => $request->plan_svp,
            'Act SVP' => $request->act_svp,
        ];

        // Send data to webhook
        $url = 'https://n8n.servercikarang.cloud/webhook/create-pcr';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($pcrData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
        ]);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode == 200) {
            return redirect()->route('pcr.index')->with('success', 'PCR created successfully!');
        } else {
            return back()->withInput()->with('error', 'Failed to create PCR. Please try again.');
        }
    }

    public function listRfq()
    {
        // Dummy data for demonstration
        $rfqData = [
            [
                'rfq_number' => 'RFQ-2025-001',
                'rfq_date' => '2025-01-15',
                'project' => 'Engine Assembly',
                'department' => 'Purchasing',
                'part_name' => 'Piston Ring',
                'part_number' => 'PR-001',
                'quantity' => 1000,
                'unit' => 'pcs',
                'description' => 'High quality piston rings for automotive engine',
                'suppliers' => ['PT. AISIN INDONESIA', 'PT. AISIN AUTOMOTIVE INDONESIA'],
                'status' => 'Open'
            ],
            [
                'rfq_number' => 'RFQ-2025-002',
                'rfq_date' => '2025-01-20',
                'project' => 'Transmission System',
                'department' => 'Purchasing',
                'part_name' => 'Gear Box',
                'part_number' => 'GB-002',
                'quantity' => 50,
                'unit' => 'set',
                'description' => 'Automatic transmission gear box assembly',
                'suppliers' => ['PT. AISIN WORLD CORP', 'PT. AISIN SEIKI INDONESIA'],
                'status' => 'Closed'
            ]
        ];

        return view('list_rfq', compact('rfqData'));
    }

    public function createRfq()
    {
        return view('create_rfq');
    }

    public function storeRfq(Request $request)
    {
        // Validate the request
        $request->validate([
            'rfq_number' => 'required|string|max:255',
            'rfq_date' => 'required|date',
            'project' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'part_name' => 'required|string|max:255',
            'part_number' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'unit' => 'required|string|max:50',
            'description' => 'required|string',
            'suppliers' => 'sometimes|array',
            'custom_suppliers' => 'sometimes|string',
        ]);

        // Custom validation: ensure at least one supplier is selected
        $selectedSuppliers = $request->suppliers ?? [];
        $customSuppliersText = $request->custom_suppliers ?? '';

        if (empty($selectedSuppliers) && empty($customSuppliersText)) {
            return back()->withInput()->withErrors(['suppliers' => 'Please select at least one supplier or add custom suppliers.']);
        }

        // Process suppliers
        $suppliers = $selectedSuppliers;

        // Add custom suppliers if provided
        if (!empty($customSuppliersText)) {
            $customSuppliers = array_filter(array_map('trim', explode("\n", $customSuppliersText)));
            $suppliers = array_merge($suppliers, $customSuppliers);
        }

        // Remove duplicates
        $suppliers = array_unique($suppliers);

        // Prepare RFQ data
        $rfqData = [
            'rfq_number' => $request->rfq_number,
            'rfq_date' => $request->rfq_date,
            'project' => $request->project,
            'department' => $request->department,
            'part_name' => $request->part_name,
            'part_number' => $request->part_number,
            'quantity' => $request->quantity,
            'unit' => $request->unit,
            'description' => $request->description,
            'suppliers' => $suppliers,
            'created_by' => Auth::user()->name,
            'created_at' => Carbon::now(),
        ];

        // Here you would typically save to database or send to webhook
        // For now, we'll just redirect with success message

        return redirect()->route('rfq.index')->with('success', 'RFQ created successfully! Suppliers: ' . implode(', ', $suppliers));
    }

    public function listPriceControlled()
    {
        // Dummy data for demonstration
        $priceControlledData = [
            [
                'supplier' => 'PT. AISIN INDONESIA',
                'periode' => '2025-09',
                'status' => 'Approve',
                'created_date' => '2025-01-15',
                'notes' => 'Price approved for Q3 2025'
            ],
            [
                'supplier' => 'PT. AISIN AUTOMOTIVE INDONESIA',
                'periode' => '2025-10',
                'status' => 'Process Approval',
                'created_date' => '2025-01-18',
                'notes' => 'Waiting for final approval'
            ],
            [
                'supplier' => 'PT. AISIN WORLD CORP',
                'periode' => '2025-08',
                'status' => 'Wait Quotation',
                'created_date' => '2025-01-10',
                'notes' => 'Waiting for supplier quotation'
            ],
            [
                'supplier' => 'PT. AISIN SEIKI INDONESIA',
                'periode' => '2025-11',
                'status' => 'Approve',
                'created_date' => '2025-01-20',
                'notes' => 'Price control established'
            ],
            [
                'supplier' => 'PT. AISIN CHEMICAL INDONESIA',
                'periode' => '2025-09',
                'status' => 'Process Approval',
                'created_date' => '2025-01-12',
                'notes' => 'Under review by management'
            ]
        ];

        return view('list_price_controlled', compact('priceControlledData'));
    }

    public function createPriceControlled()
    {
        return view('create_price_controlled');
    }

    public function storePriceControlled(Request $request)
    {
        // Validate the request
        $request->validate([
            'supplier' => 'required|string|max:255',
            'periode' => 'required|string|max:7',
            'status' => 'required|in:Approve,Wait Quotation,Process Approval',
            'notes' => 'nullable|string|max:1000',
        ]);

        // Prepare price controlled data
        $priceControlledData = [
            'supplier' => $request->supplier,
            'periode' => $request->periode,
            'status' => $request->status,
            'notes' => $request->notes,
            'created_by' => Auth::user()->name,
            'created_date' => Carbon::now()->format('Y-m-d'),
            'created_at' => Carbon::now(),
        ];

        // Here you would typically save to database
        // For now, we'll just redirect with success message

        return redirect()->route('price-controlled.index')->with('success', 'Price Controlled record created successfully for ' . $request->supplier . ' (' . $request->periode . ')');
    }

    public function listSurveySupplier()
    {
        // Dummy data for demonstration
        $surveyData = [
            [
                'supplier' => 'PT. AISIN INDONESIA',
                'type_survey' => 'Supplier Performance',
                'due_date' => '2025-10-15',
                'status' => 'Completed',
                'created_date' => '2025-01-15',
                'notes' => 'Excellent performance in Q3 2025'
            ],
            [
                'supplier' => 'PT. AISIN AUTOMOTIVE INDONESIA',
                'type_survey' => 'Quality Assessment',
                'due_date' => '2025-11-20',
                'status' => 'In Progress',
                'created_date' => '2025-01-18',
                'notes' => 'Quality assessment survey in progress'
            ],
            [
                'supplier' => 'PT. AISIN WORLD CORP',
                'type_survey' => 'Delivery Performance',
                'due_date' => '2025-09-30',
                'status' => 'Overdue',
                'created_date' => '2025-01-10',
                'notes' => 'Delivery performance survey overdue'
            ],
            [
                'supplier' => 'PT. AISIN SEIKI INDONESIA',
                'type_survey' => 'Technical Capability',
                'due_date' => '2025-12-01',
                'status' => 'Pending',
                'created_date' => '2025-01-20',
                'notes' => 'Technical capability assessment pending'
            ],
            [
                'supplier' => 'PT. AISIN CHEMICAL INDONESIA',
                'type_survey' => 'Environmental Compliance',
                'due_date' => '2025-10-25',
                'status' => 'Completed',
                'created_date' => '2025-01-12',
                'notes' => 'Environmental compliance survey completed'
            ]
        ];

        return view('list_survey_supplier', compact('surveyData'));
    }

    public function createSurveySupplier()
    {
        return view('create_survey_supplier');
    }

    public function storeSurveySupplier(Request $request)
    {
        // Validate the request
        $request->validate([
            'supplier' => 'required|string|max:255',
            'type_survey' => 'required|string|max:255',
            'due_date' => 'required|date',
            'status' => 'required|in:Pending,In Progress,Completed,Overdue',
            'notes' => 'nullable|string|max:1000',
        ]);

        // Prepare survey data
        $surveyData = [
            'supplier' => $request->supplier,
            'type_survey' => $request->type_survey,
            'due_date' => $request->due_date,
            'status' => $request->status,
            'notes' => $request->notes,
            'created_by' => Auth::user()->name,
            'created_date' => Carbon::now()->format('Y-m-d'),
            'created_at' => Carbon::now(),
        ];

        // Here you would typically save to database
        // For now, we'll just redirect with success message

        return redirect()->route('survey-supplier.index')->with('success', 'Survey to Supplier created successfully for ' . $request->supplier . ' (' . $request->type_survey . ')');
    }

    public function listFs()
    {
        // Dummy data for demonstration
        $fsData = [
            [
                'project_title' => 'New Engine Assembly Line',
                'description' => 'Feasibility study for implementing a new automated engine assembly line to improve production efficiency and reduce costs.',
                'estimated_cost' => 2500000,
                'timeline_months' => 12,
                'risk_level' => 'Medium',
                'status' => 'In Progress',
                'assigned_to' => 'John Doe',
                'due_date' => '2025-12-15',
                'project_type' => 'Process Improvement',
                'notes' => 'High potential ROI expected'
            ],
            [
                'project_title' => 'Supplier Quality Management System',
                'description' => 'Implementation of automated quality management system for supplier evaluation and monitoring.',
                'estimated_cost' => 850000,
                'timeline_months' => 8,
                'risk_level' => 'Low',
                'status' => 'Completed',
                'assigned_to' => 'Jane Smith',
                'due_date' => '2025-09-30',
                'project_type' => 'Quality Enhancement',
                'notes' => 'Successfully implemented and operational'
            ],
            [
                'project_title' => 'Cost Reduction Initiative',
                'description' => 'Comprehensive cost reduction study focusing on material costs and operational efficiencies.',
                'estimated_cost' => 150000,
                'timeline_months' => 6,
                'risk_level' => 'High',
                'status' => 'Pending',
                'assigned_to' => 'Bob Johnson',
                'due_date' => '2025-11-20',
                'project_type' => 'Cost Reduction',
                'notes' => 'Requires careful analysis of supply chain'
            ],
            [
                'project_title' => 'Digital Transformation Project',
                'description' => 'Study for digital transformation of manufacturing processes including IoT integration and data analytics.',
                'estimated_cost' => 1800000,
                'timeline_months' => 18,
                'risk_level' => 'High',
                'status' => 'In Progress',
                'assigned_to' => 'Alice Brown',
                'due_date' => '2026-03-15',
                'project_type' => 'Technology Upgrade',
                'notes' => 'Strategic importance for future competitiveness'
            ],
            [
                'project_title' => 'Market Expansion Study',
                'description' => 'Feasibility analysis for expanding into new markets in Southeast Asia.',
                'estimated_cost' => 300000,
                'timeline_months' => 9,
                'risk_level' => 'Medium',
                'status' => 'Cancelled',
                'assigned_to' => 'Charlie Wilson',
                'due_date' => '2025-10-30',
                'project_type' => 'Market Expansion',
                'notes' => 'Cancelled due to market conditions'
            ]
        ];

        return view('list_fs', compact('fsData'));
    }

    public function createFs()
    {
        return view('create_fs');
    }

    public function storeFs(Request $request)
    {
        // Validate the request
        $request->validate([
            'project_title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'estimated_cost' => 'required|numeric|min:0',
            'timeline_months' => 'required|integer|min:1',
            'risk_level' => 'required|in:Low,Medium,High',
            'status' => 'required|in:Pending,In Progress,Completed,Cancelled',
            'assigned_to' => 'required|string|max:255',
            'due_date' => 'required|date|after:today',
            'project_type' => 'required|string|max:255',
            'notes' => 'nullable|string|max:1000',
        ]);

        // Prepare feasibility study data
        $fsData = [
            'project_title' => $request->project_title,
            'description' => $request->description,
            'estimated_cost' => $request->estimated_cost,
            'timeline_months' => $request->timeline_months,
            'risk_level' => $request->risk_level,
            'status' => $request->status,
            'assigned_to' => $request->assigned_to,
            'due_date' => $request->due_date,
            'project_type' => $request->project_type,
            'notes' => $request->notes,
            'created_by' => Auth::user()->name,
            'created_date' => Carbon::now()->format('Y-m-d'),
            'created_at' => Carbon::now(),
        ];

        // Here you would typically save to database
        // For now, we'll just redirect with success message

        return redirect()->route('fs.index')->with('success', 'Feasibility Study created successfully: ' . $request->project_title);
    }

    public function listQuotation()
    {
        // Dummy data for demonstration
        $quotationData = [
            [
                'quotation_number' => 'QT-2025-001',
                'supplier' => 'PT. ABC Manufacturing',
                'part_number' => 'PN-12345',
                'part_name' => 'Engine Cylinder Head',
                'quantity' => 500,
                'unit_price' => 250000,
                'total_price' => 125000000,
                'currency' => 'IDR',
                'valid_until' => '2025-12-31',
                'status' => 'Pending',
                'quotation_date' => '2025-09-01',
                'contact_person' => 'John Smith',
                'terms' => '30 days payment terms',
                'notes' => 'Standard quality requirements apply'
            ],
            [
                'quotation_number' => 'QT-2025-002',
                'supplier' => 'CV. XYZ Components',
                'part_number' => 'PN-67890',
                'part_name' => 'Transmission Gear Set',
                'quantity' => 200,
                'unit_price' => 450000,
                'total_price' => 90000000,
                'currency' => 'IDR',
                'valid_until' => '2025-11-15',
                'status' => 'Approved',
                'quotation_date' => '2025-08-15',
                'contact_person' => 'Jane Doe',
                'terms' => '45 days payment terms',
                'notes' => 'Requires ISO certification'
            ],
            [
                'quotation_number' => 'QT-2025-003',
                'supplier' => 'PT. Global Parts Ltd',
                'part_number' => 'PN-54321',
                'part_name' => 'Brake System Assembly',
                'quantity' => 300,
                'unit_price' => 180000,
                'total_price' => 54000000,
                'currency' => 'IDR',
                'valid_until' => '2025-10-30',
                'status' => 'Rejected',
                'quotation_date' => '2025-08-20',
                'contact_person' => 'Bob Johnson',
                'terms' => '60 days payment terms',
                'notes' => 'Price too high, negotiating for better rate'
            ],
            [
                'quotation_number' => 'QT-2025-004',
                'supplier' => 'PT. Precision Engineering',
                'part_number' => 'PN-98765',
                'part_name' => 'Fuel Injection System',
                'quantity' => 150,
                'unit_price' => 750000,
                'total_price' => 112500000,
                'currency' => 'IDR',
                'valid_until' => '2026-01-15',
                'status' => 'Under Review',
                'quotation_date' => '2025-09-05',
                'contact_person' => 'Alice Brown',
                'terms' => '30 days payment terms',
                'notes' => 'Technical specifications need verification'
            ],
            [
                'quotation_number' => 'QT-2025-005',
                'supplier' => 'CV. Metal Works Indonesia',
                'part_number' => 'PN-13579',
                'part_name' => 'Exhaust Manifold',
                'quantity' => 400,
                'unit_price' => 320000,
                'total_price' => 128000000,
                'currency' => 'IDR',
                'valid_until' => '2025-12-20',
                'status' => 'Approved',
                'quotation_date' => '2025-08-28',
                'contact_person' => 'Charlie Wilson',
                'terms' => '45 days payment terms',
                'notes' => 'Bulk discount applied for large quantity'
            ]
        ];

        return view('list_quotation', compact('quotationData'));
    }

    public function createQuotation()
    {
        return view('create_quotation');
    }

    public function storeQuotation(Request $request)
    {
        // Validate the request
        $request->validate([
            'supplier' => 'required|string|max:255',
            'part_number' => 'required|string|max:100',
            'part_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
            'currency' => 'required|in:IDR,USD,EUR',
            'valid_until' => 'required|date|after:today',
            'quotation_date' => 'required|date',
            'contact_person' => 'required|string|max:255',
            'terms' => 'required|string|max:500',
            'notes' => 'nullable|string|max:1000',
        ]);

        // Calculate total price
        $totalPrice = $request->quantity * $request->unit_price;

        // Generate quotation number
        $quotationNumber = 'QT-' . date('Y') . '-' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);

        // Prepare quotation data
        $quotationData = [
            'quotation_number' => $quotationNumber,
            'supplier' => $request->supplier,
            'part_number' => $request->part_number,
            'part_name' => $request->part_name,
            'quantity' => $request->quantity,
            'unit_price' => $request->unit_price,
            'total_price' => $totalPrice,
            'currency' => $request->currency,
            'valid_until' => $request->valid_until,
            'status' => 'Pending',
            'quotation_date' => $request->quotation_date,
            'contact_person' => $request->contact_person,
            'terms' => $request->terms,
            'notes' => $request->notes,
            'created_by' => Auth::user()->name,
            'created_date' => Carbon::now()->format('Y-m-d'),
            'created_at' => Carbon::now(),
        ];

        // Here you would typically save to database
        // For now, we'll just redirect with success message

        return redirect()->route('quotation.index')->with('success', 'Quotation created successfully: ' . $quotationNumber . ' for ' . $request->supplier);
    }
}
