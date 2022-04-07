<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Kelas;
use App\Pembayaran;
use App\Spp;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $user = Auth::user();
        $kelas = Kelas::all();
        $spp = Spp::all();
        $pembayaran = Pembayaran::where('user_id', Auth::user()->id)
        ->orderBy('id', 'DESC')->get();
        return view('home')->withUser($user)->withKelas($kelas)->withSpp($spp)
        ->withPembayaran($pembayaran);
    }  
}
