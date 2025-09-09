<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\transaction;
use App\komentar;
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
        return view('dashboard',compact(['outs','draft','final','overd']));
    }
}
