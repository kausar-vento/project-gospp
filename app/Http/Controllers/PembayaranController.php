<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Pembayaran;
use App\Kelas;
use App\Spp;


class PembayaranController extends Controller
{
    public function index()
    {   
        $user = Auth::user();
        $kelas = Kelas::all();
        $spp = Spp::all();
        $pembayaran = Pembayaran::all();
        return view('admin.payments.index')->withUser($user)->withKelas($kelas)->withSpp($spp)
        ->withPembayaran($pembayaran);
    }

    public function view()
    {   
        $user = Auth::user();
        $kelas = Kelas::all();
        $spp = Spp::all();
        $pembayaran = Pembayaran::all();
        return view('petugas.viewpembayaran')->withUser($user)->withKelas($kelas)->withSpp($spp)
        ->withPembayaran($pembayaran);
    }

    public function create()
    {
        $student = User::all();
        $class = Kelas::all();
        $spepeh = Spp::all();
        return view('admin.payments.create')->withStudent($student)->withClass($class)
        ->withSpepeh($spepeh);
    }

    public function tambah()
    {
        $student = User::all();
        $class = Kelas::all();
        $spepeh = Spp::all();
        return view('petugas.create')->withStudent($student)->withClass($class)
        ->withSpepeh($spepeh);
    }

    public function store(Request $request)
    {
        $post = new Pembayaran;
        $post->user_id = $request->user;
        $post->kelas_id = $request->kelas;
        $post->spp_id = $request->spp;
        $post->amount = $request->amount;
        $post->tgl_bayar = $request->tgl_bayar;
        $post->month = $request->month;
        $post->save();
        session()->flash('successMessage', 'Pembayaran Berhasil');
        return redirect()->back();
    }
}
