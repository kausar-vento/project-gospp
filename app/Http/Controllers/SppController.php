<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Spp;

class SppController extends Controller
{
    public function index()
    {
        $spps = Spp::orderBy('tahun_ajaran')->get();
        return view('admin.spp.index', compact('spps'));
    }

    public function create()
    {
        return view('admin.spp.create');
    }

    public function store(Request $request)
    {
        request()->validate([
            'tahun_ajaran' => 'required',
        ]);
        $post = new Spp;
        $post->tahun_ajaran = $request->tahun_ajaran;
        $post->save();
        session()->flash('successMessage', 'Data saved');
        return redirect()->back();
    }

    public function edit ($id)
    {
        $spps = Spp::find($id);
        return view('admin.spp.edit', compact('spps'));
    }

    public function update (Request $request)
    {
        request()->validate([
            'tahun_ajaran' => 'required',
        ]);
    $put = Spp::find($request->id);
    $put->tahun_ajaran = $request->tahun_ajaran;
    $put->save();
    session()->flash('successMessage', 'Data Berhasil diubah');
    return redirect()->back();
    }

    public function delete($id)
     {
         $del = Spp::find($id);
         $del->delete();
         return back();
     }
}
