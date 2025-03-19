<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // Hiển thị danh sách người dùng
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // Form tạo mới
    public function create()
    {
        return view('admin.users.create');
    }

    // Lưu dữ liệu người dùng mới
    public function store(Request $request)
{
    $validated = $request->validate([
        'name'     => 'required|max:255',
        'email'    => 'required|email|unique:users,email',
        'phone'    => 'nullable|string|max:20',
        'address'  => 'nullable|string|max:255',
        'password' => 'required|min:6',
    ]);

    $validated['password'] = bcrypt($validated['password']);
    User::create($validated);

    return redirect()->route('users.index')->with('success', 'Người dùng được tạo thành công.');
}


    // Form chỉnh sửa
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // Cập nhật dữ liệu người dùng
    public function update(Request $request, User $user)
{
    $validated = $request->validate([
        'name'     => 'required|max:255',
        'email'    => 'required|email|unique:users,email,'.$user->id,
        'phone'    => 'nullable|string|max:20',
        'address'  => 'nullable|string|max:255',
        'password' => 'nullable|min:6',
    ]);

    if ($request->filled('password')) {
        $validated['password'] = bcrypt($request->password);
    } else {
        unset($validated['password']);
    }

    $user->update($validated);

    return redirect()->route('users.index')->with('success', 'Người dùng được cập nhật thành công.');
}


    // Xóa người dùng
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Người dùng đã được xóa.');
    }
}
