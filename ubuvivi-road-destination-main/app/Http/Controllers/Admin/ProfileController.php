<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user  = auth()->user();
        $users = User::orderBy('name')->get();
        return view('admin.profile.index', compact('user', 'users'));
    }
    
    public function update(Request $request)
    {
        $user = auth()->user();
        $activeTab = $request->input('active_tab', 'profile');
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|string|min:8|confirmed',
        ]);
        
        $user->name = $request->name;
        $user->email = $request->email;
        
        // Update password if provided
        if ($request->filled('new_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()
                    ->withErrors(['current_password' => 'The current password is incorrect.'])
                    ->withInput();
            }
            $user->password = Hash::make($request->new_password);
        }
        
        $user->save();
        
        return back()
            ->with('success', 'Profile updated successfully!')
            ->with('active_tab', $activeTab);
    }
}
