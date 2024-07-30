<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $data['url_form'] = route('role.show', ['id' => 0]);
        $data['url_delete'] = route('role.destroy', ['id' => 0]);
        $data['url_action'] = route('role.store');
        $data['url_data'] = route('role.index');

        $data['data'] = $this->data($request);

        return view('role.display', $data);
    }

    private function data($request)
    {
        $query = Role::query();

        $name = $request->input('name');

        if ($name)
            $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($name) . '%']);

        return $query->paginate(5)->appends($request->all());
    }

    public function store(Request $request)
    {
        try {
            $id = $request->input('id');

            if ($id) {
                $data = $request->validate([
                    'name' => ['required'],
                ], [
                    'name.required' => 'Menu Wajib Diisi.',
                ]);

                Role::where('id', $id)->update($data);
            } else {
                $data = $request->validate([
                    'name' => ['required', 'unique:menus,name'],
                ], [
                    'name.required' => 'Menu Wajib Diisi.',
                ]);

                Role::create($data);
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
        $data['data'] = Role::where('id', $id)->first();

        return view('role.form', $data);
    }

    public function destroy(string $id)
    {
        try {
            Role::where('id', $id)->delete();

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
