<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use App\Providers\RouteServiceProvider;
use DB;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Throwable;

class RegistrasiController extends Controller {

    public function index() {
        return view('auth.register');
    }


    public function store(Request $request) {
        DB::beginTransaction();
        try {
            $check = UserModel::whereRaw("email = '$request->email'")->first();
            if (!empty($check)) {
                return back()->withErrors([
                    'email' => 'Email Yg Kamu Masukkan Sudah Terdaftar, Gunakan Email Lain Atau Lanjutkan Login',
                    'overlay' => true,
                ])->onlyInput('email');
            }

            UserModel::create($request->all());

            DB::commit();

            Flash::success('Registrasi Berhasil, Silahkan Lanjutkan Login');
            
            return redirect('login');
        } catch (Throwable $e) {
            DB::rollBack();

            return back()->withErrors([
                'email' => 'Gagal Registrasi, Error >>> ' . $e->getMessage(),
                'overlay' => true,
            ])->onlyInput('email');
        }
    }
}
