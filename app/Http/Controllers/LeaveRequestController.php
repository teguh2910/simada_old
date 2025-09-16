<?php

namespace App\Http\Controllers;

use App\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class LeaveRequestController extends Controller
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
        $leaveRequests = LeaveRequest::with(['user', 'approver'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('leave_requests.index', compact('leaveRequests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('leave_requests.create');
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
            'leave_date' => 'required|date|after_or_equal:today',
            'reason' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        LeaveRequest::create([
            'user_id' => Auth::id(),
            'leave_date' => $request->leave_date,
            'reason' => $request->reason,
            'status' => 'pending',
        ]);

        return redirect()->route('leave_requests.index')
            ->with('success', 'Leave request submitted successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $leaveRequest = LeaveRequest::with(['user', 'approver'])->findOrFail($id);
        return view('leave_requests.show', compact('leaveRequest'));
    }

    /**
     * Approve a leave request
     */
    public function approve($id)
    {
        // Check if user has manager jabatan
        if (Auth::user()->jabatan !== 'manager') {
            return redirect()->back()
                ->with('error', 'Only managers can approve leave requests.');
        }

        $leaveRequest = LeaveRequest::findOrFail($id);

        $leaveRequest->update([
            'status' => 'approved',
            'approved_by' => Auth::id(),
            'approved_at' => Carbon::now(),
        ]);

        return redirect()->back()
            ->with('success', 'Leave request approved successfully.');
    }

    /**
     * Reject a leave request
     */
    public function reject(Request $request, $id)
    {
        // Check if user has manager jabatan
        if (Auth::user()->jabatan !== 'manager') {
            return redirect()->back()
                ->with('error', 'Only managers can reject leave requests.');
        }

        $validator = Validator::make($request->all(), [
            'approval_notes' => 'required|string|max:500',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $leaveRequest = LeaveRequest::findOrFail($id);

        $leaveRequest->update([
            'status' => 'rejected',
            'approved_by' => Auth::id(),
            'approved_at' => Carbon::now(),
            'approval_notes' => $request->approval_notes,
        ]);

        return redirect()->back()
            ->with('success', 'Leave request rejected.');
    }

    /**
     * Get today's leave requests for dashboard
     */
    public function today()
    {
        $todayLeaves = LeaveRequest::with(['user', 'approver'])
            ->whereIn('status', ['approved', 'pending'])
            ->whereDate('leave_date', Carbon::today())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('leave_requests.today', compact('todayLeaves'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Only managers can delete leave requests
        if (Auth::user()->jabatan !== 'manager') {
            return redirect()->back()->with('error', 'Access denied. Only managers can delete leave requests.');
        }

        $leaveRequest = LeaveRequest::findOrFail($id);

        $leaveRequest->delete();

        return redirect()->route('leave_requests.index')
            ->with('success', 'Leave request deleted successfully.');
    }
}
