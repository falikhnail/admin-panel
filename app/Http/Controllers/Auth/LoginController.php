<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SessionKeyModel;
use App\Models\UserModel;
use App\Providers\RouteServiceProvider;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller {

    public function index() {
        $noPonselAdmin = "6282220002224";
        $formatRegist = urlencode(<<<EOD
Dear Partner,
Mohon untuk melengkapi data-data berikut.
📝 Master Music Client Data

[ Nama label ]

>> Lengkapi Data
Nama Lengkap :
Nama Alias :
Email :
No WA :
Nama Bank :
Rekening Atas Nama :
Nomor Rekening :
Cabang Kota Bank :

🌐 https://www.mastermusic.co.id
EOD);

        $urlWa = "https://api.whatsapp.com/send/?phone=$noPonselAdmin&text=$formatRegist";

        return view('auth.login', compact(
            'urlWa'
        ));
    }


    public function store(Request $request) {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $email = $request->email;
        $password = $request->password;

        $userModel = UserModel::where('email', $email)->where('password', $password)->first();
        if (!empty($userModel)) {
            Session::put(SessionKeyModel::USER_LOGIN, $userModel);
            Session::put('test', 'aku');

            return redirect('/control');
        }

        return back()->withErrors([
            'email' => 'Pastikan Email dan Password mu Benar',
        ])->onlyInput('email');
    }

    public function destroy(Request $request) {
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        Flash::success("<i class='fas fa-check'></i> Berhasil Logout")->important();

        return redirect('/');
    }
}
