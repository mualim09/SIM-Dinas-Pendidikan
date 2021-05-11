<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mpdf\Mpdf;
use Illuminate\Support\Facades\Hash;
use DateTime;

class UserController extends Controller
{
    public function index()
    {
        $data = DB::table('users')->get();
        // dd($data);
        return view('user.index',['data' => $data]);
    }

    public function simpan(Request $request)
    {
        DB::table('users')->insert([
            'name'              => $request->input('nama'), 
            'email'             => $request->input('email'),
            'password'          => Hash::make($request->input['password'])
        ]);
        return redirect('pengguna');
    }

    public function update(Request $request, $id)    
    {
        $id         = $request->get('id');
        $name       = $request->get('nama');
        $email      = $request->get('email');
        $password   = $request->get('password');

        $data = DB::table('users')->where('id', $request->id)->first();
        if ($name != null | $name != 0) {

            DB::table('users')->where('id', $request->id)->update(
                array(
                    'name'     => $name,
                    'email'    => $email,
                    'password' => Hash::make($password)
                )
            );
        }
        return redirect('pengguna');
    }

    public function hapus($id)
    {
        $destroy = DB::table('users')->where('id',$id);
        $destroy->delete($id);
        // Session::flash('message', 'Delete successfully!');
        // Session::flash('alert-class', 'alert-success');
        return redirect('pengguna');
    }

}
