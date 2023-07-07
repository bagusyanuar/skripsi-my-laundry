<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->request->method() === 'POST' && $this->request->ajax()) {
            try {
                $data_request = [
                    'username' => $this->postField('username'),
                    'password' => Hash::make($this->postField('password')),
                    'role' => $this->postField('role'),
                ];
                User::create($data_request);
                return $this->jsonResponse('success', 200);
            } catch (\Exception $e) {
                return $this->jsonResponse('failed ' . $e->getMessage(), 500);
            }
        }
        if ($this->request->ajax()) {
            $data = User::with([])->where('role', '!=', 'member');
            return $this->basicDataTables($data);
        }
        return view('admin.pengguna.index');
    }

    public function patch($id)
    {
        try {
            $data = User::find($id);
            $data_request = [
                'username' => $this->postField('username'),
                'role' => $this->postField('role'),
            ];
            if ($this->postField('password') !== '') {
                $data['password'] = Hash::make($this->postField('password'));
            }
            $data->update($data_request);
            return $this->jsonResponse('success', 200);
        }catch (\Exception $e) {
            return $this->jsonResponse('failed ' . $e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            User::destroy($id);
            return $this->jsonResponse('success', 200);
        } catch (\Exception $e) {
            return $this->jsonResponse('failed', 500);
        }
    }
}
