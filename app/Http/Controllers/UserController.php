<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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
        // Only managers can view all users
        if (Auth::user()->jabatan !== 'manager') {
            return redirect()->route('users.profile')->with('error', 'Access denied. Only managers can view user list.');
        }

        $users = User::orderBy('name')->get();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Only managers can create new users
        if (Auth::user()->jabatan !== 'manager') {
            return redirect()->route('users.profile')->with('error', 'Access denied. Only managers can create new users.');
        }

        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Only managers can create new users
        if (Auth::user()->jabatan !== 'manager') {
            return redirect()->route('users.profile')->with('error', 'Access denied. Only managers can create new users.');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'dept' => 'nullable|string|max:255',
            'npk' => 'nullable|string|max:255|unique:users',
            'jabatan' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'dept' => $request->dept,
            'npk' => $request->npk,
            'jabatan' => $request->jabatan,
        ]);

        return redirect()->route('users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        // Only managers can view other users, or users can view their own profile
        if (Auth::user()->jabatan !== 'manager' && Auth::id() !== $user->id) {
            return redirect()->route('users.profile')->with('error', 'Access denied. You can only view your own profile.');
        }

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        // Only managers can edit other users, or users can edit their own profile
        if (Auth::user()->jabatan !== 'manager' && Auth::id() !== $user->id) {
            return redirect()->route('users.profile')->with('error', 'Access denied. You can only edit your own profile.');
        }

        return view('users.edit', compact('user'));
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
        $user = User::findOrFail($id);

        // Only managers can update other users, or users can update their own profile
        if (Auth::user()->jabatan !== 'manager' && Auth::id() !== $user->id) {
            return redirect()->route('users.profile')->with('error', 'Access denied. You can only update your own profile.');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6|confirmed',
            'dept' => 'nullable|string|max:255',
            'npk' => 'nullable|string|max:255|unique:users,npk,' . $id,
            'jabatan' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'dept' => $request->dept,
            'npk' => $request->npk,
            'jabatan' => $request->jabatan,
        ];

        // Only update password if provided
        if ($request->has('password') && !empty($request->password)) {
            $updateData['password'] = Hash::make($request->password);
        }

        $user->update($updateData);

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Only managers can delete users
        if (Auth::user()->jabatan !== 'manager') {
            return redirect()->route('users.profile')->with('error', 'Access denied. Only managers can delete users.');
        }

        $user = User::findOrFail($id);

        // Prevent users from deleting themselves
        if ($user->id === Auth::id()) {
            return redirect()->route('users.index')
                ->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully.');
    }

    /**
     * Show the current user's profile
     */
    public function profile()
    {
        $user = Auth::user();
        return view('users.profile', compact('user'));
    }

    /**
     * Update the current user's profile
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'dept' => 'nullable|string|max:255',
            'npk' => 'nullable|string|max:255|unique:users,npk,' . $user->id,
            'jabatan' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'dept' => $request->dept,
            'npk' => $request->npk,
            'jabatan' => $request->jabatan,
        ];

        // Only update password if provided
        if ($request->has('password') && !empty($request->password)) {
            $updateData['password'] = Hash::make($request->password);
        }

        $user->update($updateData);

        return redirect()->route('users.profile')
            ->with('success', 'Profile updated successfully.');
    }
}
