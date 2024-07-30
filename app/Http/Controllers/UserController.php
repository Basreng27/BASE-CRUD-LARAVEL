<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $data['url_form'] = route('user.show', ['id' => 0]);
        $data['url_delete'] = route('user.destroy', ['id' => 0]);
        $data['url_action'] = route('user.store');

        $data['data'] = User::with('role')->paginate(5);

        return view('user.display', $data);
    }

    public function store(Request $request)
    {
        try {
            $id = $request->input('id');

            if ($id) {
                $data = $request->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'role_id' => ['required', 'int'],
                    'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
                ], [
                    'name.required' => 'Nama Wajib Diisi',
                    'role_id.required' => 'Role Wajib Diisi',
                    'email.required' => 'Email Wajib Diisi',
                ]);

                User::where('id', $id)->update($data);
            } else {
                $data = $request->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                    'role_id' => ['required', 'int'],
                    'password' => ['required'],
                ], [
                    'name.required' => 'Nama Wajib Diisi',
                    'role_id.required' => 'Role Wajib Diisi',
                    'email.required' => 'Email Wajib Diisi',
                    'email.uniquw' => 'Email Telah Terdaftar',
                    'password.required' => 'Password Wajib Diisi',
                ]);

                $data['password'] = Hash::make($request->password);

                User::create($data);
            }

            return response()->json([
                'status' => true,
                'statusText' => "Berhasil",
                'message' => "Data Berhasil Disimpan"
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'statusText' => "Gagal",
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id = null)
    {
        $data['data'] = User::where('id', $id)->first();
        $data['opt_role'] = Role::pluck('name', 'id')->toArray(); // result => [1 => "ROLE"]

        return view('user.form', $data);
    }

    public function destroy(string $id)
    {
        try {
            User::where('id', $id)->delete();

            return response()->json([
                'status' => true,
                'message' => 'Data Berhasil Dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Data Gagal Dihapus'
            ], 500);
        }
    }
}
