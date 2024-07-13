<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['url_form'] = route('menu.show', ['id' => 0]);
        $data['url_delete'] = route('menu.destroy', ['id' => 0]);
        $data['url_action'] = route('menu.store');

        $data['data'] = Menu::all();

        return view('menu.display', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
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
                    'name' => ['required', 'unique:menus'],
                    'url' => ['required', 'unique:menus'],
                    'sequence' => ['required', 'integer', 'unique:menus']
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

    /**
     * Display the specified resource.
     */
    public function show($id = null)
    {
        $data['data'] = Menu::where('id', $id)->first();

        return view('menu.form', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Menu::where('id', $id)->delete();

            return response()->json([
                'status' => true,
                'message' => 'Item deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to delete item'
            ], 500);
        }
    }
}
