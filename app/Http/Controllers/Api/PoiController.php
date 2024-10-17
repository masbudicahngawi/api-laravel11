<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Poi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PoiController extends Controller
{

    public function index()
    {
        $semua_poi = Poi::all();

        return response()->json([
            'status' => true,
            'message' => 'Semua data ditemukan',
            'data' => $semua_poi
        ]);
    }


    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'nama' => 'required',
            'deskripsi' => 'required',
            'objek' => 'required'
        ]);

        if ($validasi->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validasi input gagal',
                'errors' => $validasi->errors()
            ], 422);
        }

        $poi_baru = Poi::create($request->all());

        return response()->json([
            'statue' => true,
            'message' => 'Data berhasil disimpan',
            'data' => $poi_baru
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data_yang_dicari = Poi::findOrFail($id);

        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan',
            'data' => $data_yang_dicari
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validasi = Validator::make($request->all(), [
            'nama' => 'required',
            'deskripsi' => 'required',
            'objek' => 'required'
        ]);

        if ($validasi->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validasi input gagal',
                'errors' => $validasi->errors()
            ], 422);
        }

        $data_yang_mau_diupdate = Poi::findOrFail($id);

        $data_yang_mau_diupdate->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil diubah',
            'data' => $data_yang_mau_diupdate
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data_yang_mau_dihapus = Poi::findOrFail($id);
        $data_yang_mau_dihapus->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil dihapus',
            'data' => $data_yang_mau_dihapus
        ]);
    }
}
