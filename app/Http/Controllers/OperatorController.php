<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Petugas;

class OperatorController extends Controller
{
    public function index()
    {
        $operator = Petugas::all();
        return view('admin.petugas.index')->withOperator($operator);
    }

    public function create()
    {
        return view('admin.petugas.create');
    }

    public function store(Request $request)
    {
            request()->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8',
        ]);
        $user = Petugas::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),

        ]);
        session()->flash('successMessage', 'Data Petugas berhasil ditambahkan');
        return redirect()->back();
    }
    public function edit($id)
    {
            $userr = Petugas::find($id); 
            return view('admin.petugas.edit')->withUserr($userr);
           
    }

    public function update(Request $request)
    {
        $put = Petugas::find($request->id);
        $put->name = $request->name;
        $put->save();
        session()->flash('successMessage', 'Petugas Berhasil diubah');
        return redirect()->back();
    }
    public function delete($id)
    {
        $del = Petugas::find($id);
        $del->delete();
        return back();
    }
}
