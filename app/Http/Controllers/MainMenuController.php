<?php

namespace App\Http\Controllers;

use App\mainmenus;
use Illuminate\Http\Request;

class MainMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mainmenu = mainmenus::get();
        if (! $mainmenu) {
            # code...
            return response()->json([
                'status' => 'Error',
                'Message' => 'Data Gagal Di Tampilkan',
                'data' => NULL, 402,
            ]);
        }
        return response()->json([
            'status' => 'Succes',
            'Message' => 'Data Berhasil Di Tampilkan',
            'data' => $mainmenu, 200,
        ]);

        // return view('home', compact('mainmenu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mainmenu = mainmenus::get();
        if (!$mainmenu) {
            # code...
            return response()->json([
                'data' => NULL, 402
            ]);
        } 
        return response()->json([
            'data' => $mainmenu, 200
        ]);

        // return view('Home', compact('mainmenu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_menu' => 'required',
            'link' => 'required',
            'aktif' => 'required',
        ]);

        try {
            $mainmenu = new mainmenus;
            $mainmenu->name_menu = $request->name_menu;
            $mainmenu->link = $request->link;
            $mainmenu->aktif = $request->aktif;
            $mainmenu->save();
            if (!$mainmenu) {
                return response([
                    'status' => 'error',
                    'message' => 'Invalid Credentials',
                    'data' => NULL, 404
                ]);
            }
        } catch (\Throwable $th) {
            $th->getMessage();
        }
        return response([
            'status' => 'succes',
            'message' => 'Berhasil Di Tambah',
            'data' => $mainmenu, 200
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\mainmenus  $mainmenus
     * @return \Illuminate\Http\Response
     */
    public function show(mainmenus $mainmenus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\mainmenus  $mainmenus
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mainmenu = mainmenus::find($id);
        if (!$mainmenu) {
            # code...
            return response()->json([
                'data' => NULL, 402
            ]);
        } 
        return response()->json([
            'data' => $mainmenu, 200
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\mainmenus  $mainmenus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name_menu' => 'required',
            'link' => 'required',
            'aktif' => 'required',
        ]);

        try {
            $mainmenu = mainmenus::find($id);
            $mainmenu->name_menu = $request->name_menu;
            $mainmenu->link = $request->link;
            $mainmenu->aktif = $request->aktif;
            $mainmenu->save();
            if (!$mainmenu) {
                return response([
                    'status' => 'error',
                    'message' => 'Invalid Credentials',
                    'data' => NULL, 404
                ]);
            }
        } catch (\Throwable $th) {
            $th->getMessage();
        }
        return response([
            'status' => 'succes',
            'message' => 'Berhasil Di update',
            'data' => $mainmenu, 200
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\mainmenus  $mainmenus
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mainmenu = mainmenus::destroy($id);
        if (! $mainmenu) {
            # code...
            return response()->json([
                'status' => 'Error',
                'Message' => 'Data Gagal Di Hapus',
                'data' => NULL, 402,
            ]);
        }
        return response()->json([
            'status' => 'Succes',
            'Message' => 'Data Berhasil Di Hapus',
            'data' => $mainmenu, 200,
        ]);
    }
}
