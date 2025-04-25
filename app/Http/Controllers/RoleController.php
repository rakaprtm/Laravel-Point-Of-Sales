<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class RoleController extends Controller
{

    public function index()
    {
        $title = "Data Roles";
        $datas = Role::all();

        return view('Role.index', compact('title', 'datas'));
    }


    public function create()
    {
        return view('Role.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:Roles,email',
            'password' => 'required|min:6',
        ]);

        Role::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('Roles.index')->with('success', 'Role added successfully');
    }

    public function edit($id)
    {
        $Role = Role::findOrFail($id);
        return view('Role.edit', compact('Role'));
    }

    public function update(Request $request, $id)
    {
        $Role = Role::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:Roles,email,' . $id,
        ]);

        $Role->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ?? $Role->password,
        ]);

        return redirect()->route('Roles.index')->with('success', 'Role updated successfully');
    }

    public function destroy($id)
    {
        $Role = Role::findOrFail($id);
        $Role->delete();

        return redirect()->route('Roles.index')->with('success', 'Role deleted successfully');
    }
}
