<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BankAccountModel;
use App\Models\UserModel;
use Carbon\Carbon;
use DB;
use Flash;
use Illuminate\Http\Request;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller {
    public function index() {
        return view('backend.user');
    }

    public function indexDataTable(Request $request) {
        $user = UserModel::query()->where('tipe_user', 'user');
        $searchName = $request->search['value'];
        if (!empty($searchName)) {
            $user->whereRaw("nama like '%$searchName%'");
        }

        $dataTable = DataTables::of($user->get())
            ->addIndexColumn()
            ->addColumn('nama', '<div class="text-center"><strong>{{$nama}}</strong></div>')
            ->addColumn('email', '<div class="text-center"><strong>{{$email}}</strong></div>')
            ->addColumn('created_at', '<div class="text-center"><strong>{{$created_at}}</strong></div>')
            ->addColumn('action', function (UserModel $user) {
                return view('backend.includes.act_user', compact('user'));
            })
            ->rawColumns([
                'nama',
                'email',
                'created_at',
                'action'
            ]);

        return $dataTable->make(true);
    }

    public function storeProfileUser($id) {
        $userData = UserModel::lastBalanceByUserId($id);

        return view('backend.user_profile', compact('userData'));
    }

    public function saveProfile(Request $request) {
        DB::beginTransaction();
        try {

            UserModel::byId($request->post('userId'))->update([
                'nama' => $request->post('nama'),
                'email' => $request->post('email'),
                'updated_at' => Carbon::now(),
            ]);

            DB::commit();

            Flash::success('Profile Berhasil di Update');
        } catch (Throwable $e) {
            DB::rollBack();

            Flash::error('Error Update Profile, Error >>> ' . $e->getMessage());
        }

        return redirect()->back();
    }
}
