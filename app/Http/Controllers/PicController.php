<?php

namespace App\Http\Controllers;

use App\Pic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PicController extends Controller
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
        $pics = Pic::orderBy('name')->paginate(10);
        return view('pics.index', compact('pics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pics.create');
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
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'department' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean'
        ]);

        Pic::create($request->all());

        Session::flash('success', 'PIC created successfully!');
        return redirect()->route('pics.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pic = Pic::findOrFail($id);
        return view('pics.show', compact('pic'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pic = Pic::findOrFail($id);
        return view('pics.edit', compact('pic'));
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
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'department' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean'
        ]);

        $pic = Pic::findOrFail($id);
        $pic->update($request->all());

        Session::flash('success', 'PIC updated successfully!');
        return redirect()->route('pics.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pic = Pic::findOrFail($id);

        // Check if PIC is being used in any RFQs
        if ($pic->rfqs()->count() > 0) {
            Session::flash('error', 'Cannot delete PIC because it is being used in RFQs!');
            return redirect()->route('pics.index');
        }

        $pic->delete();

        Session::flash('success', 'PIC deleted successfully!');
        return redirect()->route('pics.index');
    }
}
