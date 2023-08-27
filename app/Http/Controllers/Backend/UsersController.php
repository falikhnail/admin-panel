<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BankAccountModel;
use App\Models\SessionKeyModel;
use App\Models\UserModel;
use Carbon\Carbon;
use DB;
use Flash;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Log;
use Str;
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

    public function create() {
        return view('backend.add_user');
    }

    public function profileUser($id) {
        $userData = UserModel::lastBalanceByUserId($id);

        return view('backend.user_profile', compact('userData'));
    }

    public function saveProfile(Request $request) {
        DB::beginTransaction();
        try {

            UserModel::byId($request->post('userId'))->update([
                'nama' => $request->post('nama'),
                'email' => $request->post('email'),
                'password' => $request->post('password'),
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

    public function storeChangePassword(Request $request) {
        DB::beginTransaction();
        try {
            $userSession = session()->get(SessionKeyModel::USER_LOGIN);
            UserModel::byId($userSession->id)->update([
                'password' => $request->password
            ]);

            DB::commit();

            Flash::success('Password Has Been Changed');
        } catch (Throwable $e) {
            DB::rollBack();

            Flash::error('Error Change Password, Error >>> ' . $e->getMessage());
        }

        return redirect()->back();
    }

    public function storeUser(Request $request) {
        DB::beginTransaction();
        try {
            try{
                UserModel::query()->insert([
                    'nama' => $request->name,
                    'email' => $request->email,
                    'password' => $request->password_user,
                    'tipe_user' => $request->user_type
                ]);
            }catch(QueryException $e){
                if($e->errorInfo[1] == 1062){
                    throw new \Exception('User Already Exists');
                }
            }


            DB::commit();

            Flash::success('User Has Been Added');

            return redirect('control/users');
        } catch (Throwable $e) {
            $message = $e->getMessage();

            DB::rollBack();

            Flash::error('Error Add User, Error >>> ' . $message);

            return redirect()->back();
        }
    }
}
