<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Charts;

class AdminController extends Controller
{
    public function home()
    {
        $user = User::where(DB::raw("(DATE_FORMAT(created_at, '%Y'))"),date('Y'))->get();
        $chart = Charts::database($user, 'bar', 'highcharts')
                                 ->title("User Register")
                                 ->elementLabel("Total User")
                                 ->dimensions(1000, 500)
                                 ->responsive(false)
                                 ->groupByMonth(date('Y'), true);
        return view('admin.home', compact('chart'));
    }
}
