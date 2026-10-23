<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kabupaten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserManagementController extends Controller
{
    public function index()
{
    $users = User::with('kabupaten')
        ->orderBy('role')
        ->orderBy('name')
        ->paginate(10)
        ->withQueryString();

    return view('users.index', compact('users'));
}

    public function create()
    {
        $kabupaten = Kabupaten::orderBy('nama_kabupaten')->get();

        return view('users.create', compact('kabupaten'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users,username',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:master,kabupaten',
            'kabupaten_id' => 'nullable|exists:kabupaten,id',
        ]);

        if ($validated['role'] === 'kabupaten') {
            $request->validate([
                'kabupaten_id' => 'required|exists:kabupaten,id',
            ]);
        } else {
            $validated['kabupaten_id'] = null;
        }

        $validated['email'] = $validated['username'] . '@ki-kalteng.local';
        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('users.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        $kabupaten = Kabupaten::orderBy('nama_kabupaten')->get();

        return view('users.edit', compact('user', 'kabupaten'));
    }

    public function update(Request $request, User $user)
    {
        if ($user->id === $request->user()->id &&
            $request->role !== 'master') {
            return back()->withErrors([
                'role' => 'Role akun yang sedang digunakan tidak dapat diubah.'
            ]);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => [
                'required',
                'string',
                'max:50',
                Rule::unique('users', 'username')->ignore($user->id),
            ],
            'role' => 'required|in:master,kabupaten',
            'kabupaten_id' => 'nullable|exists:kabupaten,id',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($validated['role'] === 'kabupaten') {
            $request->validate([
                'kabupaten_id' => 'required|exists:kabupaten,id',
            ]);
        } else {
            $validated['kabupaten_id'] = null;
        }

        $validated['email'] = $validated['username'] . '@ki-kalteng.local';

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('users.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(Request $request, User $user)
    {
        if ($user->id === $request->user()->id) {
            return back()->with('error', 'Akun yang sedang digunakan tidak dapat dihapus.');
        }

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User berhasil dihapus.');
    }
}
