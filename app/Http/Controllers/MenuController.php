<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $data['url_form'] = route('menu.show', ['id' => 0]);
        $data['url_delete'] = route('menu.destroy', ['id' => 0]);
        $data['url_action'] = route('menu.store');
        $data['url_data'] = route('menu.index');

        $data['data'] = $this->data($request);

        return view('menu.display', $data);
    }

    private function data($request)
    {
        $query = Menu::query();

        $menu = $request->input('menu');
        $url = $request->input('url');

        if ($menu)
            $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($menu) . '%']);

        if ($url)
            $query->orWhereRaw('LOWER(url) LIKE ?', ['%' . strtolower($url) . '%']);

        return $query->paginate(5)->appends($request->all());
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
