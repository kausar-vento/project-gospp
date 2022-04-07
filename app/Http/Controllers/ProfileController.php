<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Kelas;
use App\Exports\UserExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Image;

class ProfileController extends Controller
{   
    public function index()
    {
        $user = User::where('id_kelas', '!=', null)->get();

        $id_kelas = [];
        for ($i=0; $i < $user->count(); $i++) { 
            $id_kelas[] = $user[$i]->id_kelas;
        }
        
        $dataClass = [];
        for ($i=0; $i < $user->count(); $i++) { 
            $dataClass[] = Kelas::where('id', $id_kelas[$i])->get();
        }

        return view('admin.siswa.index', compact('user', 'dataClass'));
    }

    public function export()
    {
        return Excel::download(new UserExport, 'murid.xlsx');
    }

    public function create()
    {
        $ksl = Kelas::all();
        return view('admin.siswa.create')->withKsl($ksl);
    }

    public function store(Request $request)
    {
            request()->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8',
        ]);
        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'id_kelas' =>request('kelas'),
            'password' => bcrypt(request('password')),

        ]);
        session()->flash('successMessage', 'Data Siswa berhasil ditambahkan');
        return redirect()->back();
    }
    public function edit()
    {
        $kls = Kelas::all();
        if (Auth::user()) {
            $user = User::find(Auth::user()->id);
           
            if ($user){
            return view('siswa.edit_murid')->withUser($user)->withKls($kls);
            } else {
                return redirect()->back(); 
            }
        }else {
            return redirect()->back(); 
        }
    }
    public function update(Request $request)
    {
        $user = User::find(Auth::user()->id);

        if ($user) {
            $validate = null;
            if (Auth::user()->email === $request['email']){
                $validate = $request->validate([
                    'name' => 'required|min:2',
                    'email' => 'required|email'
                ]);
            } else {
                $validate = $request->validate([
                    'name' => 'required|min:2',
                    'email' => 'required|email|unique:users',
                    'tampat_lahir' => 'required|min:2',
                    'alamat' => 'required|min2',
                    'kelamin' => 'required',
                    'murid' => 'mimes:jpeg,jpg,png,gif|required|max:10000'
                ]);
            }
            
            if ($validate) {
            $user->name = $request['name'];
            $user->kelamin = $request['kelamin'];
            $user->email = $request['email'];
            $user->tampat_lahir = $request['tampat_lahir'];
            $user->alamat = $request['alamat'];
            
            if($request->hasFile('murid')){
                $murid = $request->file('murid');
                $filename = time() . '.' . $murid->getClientOriginalExtension();
                Image::make($murid)->resize(300, 300)->save( public_path('images/'. $filename) );

                $user = Auth::user();
                $user->murid = $filename;
                $user->save();
            }

            $user->save();
            $request->session()->flash('success', 'OKEHHHHH');
            return redirect()->back();
            }else{
                return redirect()->back();
            }
        }else {
            return redirect()->back();
        }
    }
    public function destroy($id)
    {
        $del = User::findOrFail($id);
        $del->delete();
        return redirect()->back();
    }
}
