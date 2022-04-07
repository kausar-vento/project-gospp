<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kelas;

class KelasController extends Controller
{
    public function index()
    {
        $get = Kelas::all();
        return view('admin.kelas',compact('get'));
    }

    public function tambah()
    {
        $kls = Kelas::all();
        return view('admin.tambah_kelas')->withKls($kls);
    }

    public function simpan(Request $request)
    {
        $tbh = new Kelas;
        $tbh->kelas_siswa = $request->kelas_siswa;
        $tbh->save();
        return redirect('/kelas');
    }

    public function edit($id)
    {
        $ksl = Kelas::find($id);
        return view('admin.edit_kelas')->withKsl($ksl);
    }
    public function update(Request $request)
    {
        $edt = Kelas::find($request->id);
        $edt->kelas_siswa = $request->kelas_siswa;
        $edt->save();
        session()->flash('successMessage', 'Data Berhasil diubah');
        return redirect()->back();
    }
}
