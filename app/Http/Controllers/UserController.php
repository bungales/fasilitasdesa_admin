<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // SEARCH
        $search = $request->search;

        // FILTER ROLE
        $filterRole = $request->role;

        // Query dasar
        $query = User::query();

        // Jika search
        if ($search) {
            $query->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%");
        }

        // Jika filter role
        if ($filterRole) {
            $query->where('role', $filterRole);
        }

        // Pagination
        $users = $query->orderBy('id', 'DESC')->paginate(10);

        // Get all roles for filter dropdown
        $roles = User::getRoles();

        return view('pages.user.index', compact('users', 'search', 'filterRole', 'roles'));
    }

    public function create()
    {
        $roles = User::getRoles();
        return view('pages.user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'role' => 'required|in:' . implode(',', User::getRoles()),
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ];

        // Handle upload profile picture
        if ($request->hasFile('profile_picture')) {
            $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $data['profile_picture'] = $imagePath;
        }

        User::create($data);

        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan!');
    }

    // ✅ TAMBAHKAN METHOD SHOW INI
    public function show(User $user)
    {
        return view('pages.user.show', compact('user'));
    }

    public function edit(User $user)
    {
        $roles = User::getRoles();
        return view('pages.user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:' . implode(',', User::getRoles()),
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        if ($request->password) {
            $request->validate(['password' => 'confirmed|min:6']);
            $data['password'] = Hash::make($request->password);
        }

        // Handle upload profile picture
        if ($request->hasFile('profile_picture')) {
            // Hapus gambar lama jika ada
            if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $data['profile_picture'] = $imagePath;
        }

        // Jika request hapus gambar
        if ($request->has('remove_profile_picture') && $request->remove_profile_picture == '1') {
            // Hapus gambar lama jika ada
            if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            $data['profile_picture'] = null;
        }

        $user->update($data);

        return redirect()->route('user.index')->with('success', 'User berhasil diperbarui!');
    }

    public function destroy(User $user)
    {
        // Hapus profile picture jika ada
        if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        $user->delete();
        return redirect()->route('user.index')->with('success', 'User berhasil dihapus!');
    }
}
