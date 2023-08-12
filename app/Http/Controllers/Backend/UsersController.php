<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BankAccountModel;
use App\Models\UserModel;
use Carbon\Carbon;
use DB;
use Flash;
use Illuminate\Http\Request;
use Log;
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
            ->addColumn('created_at', function ($data) {
                $createdAt = date('d-m-Y H:i', strtotime($data->created_at));
                return '<div class="text-center"><strong>' . $createdAt . '</strong></div>';
            })
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

    public function storePhotoProfile(Request $request) {
        DB::beginTransaction();
        try {
            $clean = function ($name) {
                $result = str_replace(' ', '-', $name);
                $result = str_replace('/', '-', $name);
                $result = str_replace('_', '-', $name);
                return $result;
            };

            $file = $request->file('photo');
            $fileName = $clean($file->getClientOriginalName());
            $saveName = '/img/user/' . $fileName;
            $destinationPath = public_path('/img/user');

            $file->move($destinationPath, $fileName);

            UserModel::byId($request->post('userId'))->update([
                'image_path' => $saveName,
                'image_name' => $fileName,
                //'image_url' => $request->post('email'),
                'updated_at' => Carbon::now(),
            ]);

            DB::commit();

            Flash::success('Photo Profile Updated');
        } catch (Throwable $e) {
            DB::rollBack();

            Flash::error('Error Photo Profile, Error >>> ' . $e->getMessage());
        }

        return redirect()->back();
    }
}
