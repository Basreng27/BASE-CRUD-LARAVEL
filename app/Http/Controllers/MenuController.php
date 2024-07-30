<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $data['url_form'] = route('menu.show', ['id' => 0]);
        $data['url_delete'] = route('menu.destroy', ['id' => 0]);
        $data['url_action'] = route('menu.store');

        $data['data'] = Menu::paginate(5);

        return view('menu.display', $data);
    }

    public function store(Request $request)
    {
        try {
            $id = $request->input('id');

            if ($id) {
                $data = $request->validate([
                    'name' => ['required'],
                    'url' => ['required'],
                    'sequence' => ['required', 'integer']
                ]);

                Menu::where('id', $id)->update($data);
            } else {
                $data = $request->validate([
                    'name' => ['required', 'unique:menus,name'],
                    'url' => ['required', 'unique:menus,url'],
                    'sequence' => ['required', 'integer', 'unique:menus,sequence']
                ], [
                    'name.required' => 'Menu Wajib Diisi.',
                    'name.unique' => 'Menu Yang Masukan Telah Digunakan.',
                    'url.required' => 'URL Wajib Diisi.',
                    'sequence.required' => 'Urutan Wajib Diisi.',
                    'sequence.integer' => 'Urutan Harus Angka.'
                ]);

                Menu::create($data);
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
        $data['data'] = Menu::where('id', $id)->first();

        return view('menu.form', $data);
    }

    public function destroy(string $id)
    {
        try {
            Menu::where('id', $id)->delete();

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
