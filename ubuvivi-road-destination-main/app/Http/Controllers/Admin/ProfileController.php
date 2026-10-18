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
        $canManageUsers = $user->isSuperAdmin();
        $users = $canManageUsers ? User::orderBy('name')->get() : collect();
        return view('admin.profile.index', compact('user', 'users', 'canManageUsers'));
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

    public function storeUser(Request $request)
    {
        abort_unless(auth()->user()->isSuperAdmin(), 403);

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role'     => 'required|in:super_admin,admin,staff,client',
            'phone'    => 'nullable|string|max:20',
        ]);

        User::create([
            'name'         => $request->name,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'role'         => $request->role,
            'phone_number' => $request->phone,
        ]);

        return redirect()->route('profile.index', ['tab' => 'users'])
            ->with('success', 'User created successfully.')
            ->with('active_tab', 'users');
    }

    public function destroyUser($id)
    {
        abort_unless(auth()->user()->isSuperAdmin(), 403);

        $user = User::findOrFail($id);

        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        if ($user->isSuperAdmin() && User::where('role', User::ROLE_SUPER_ADMIN)->count() <= 1) {
            return back()->with('error', 'You cannot delete the last super admin account.');
        }

        $user->delete();

        return redirect()->route('profile.index', ['tab' => 'users'])
            ->with('success', 'User deleted.')
            ->with('active_tab', 'users');
    }
}
