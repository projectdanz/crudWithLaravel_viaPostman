<?php

namespace App\Http\Controllers;

use App\Models\buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApibukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=buku::orderBy('judul', 'asc')->get();
        return response()->json([
            'status' => true,
            'message' => 'data ditemukan',
            'data' => $data,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataBuku = new buku;

        $rules = [
            'judul' => 'required',
            'pengarang' => 'required',
            'tanggal_publikasi' => 'required|date',
        ];

        $validator = Validator::make($request->all, $rules);
        if($validator->fails())
        {
            return response()->json([
                'status' => false,
                'message' => 'gagal membuka data',
                'data' => $validator->errors()
            ]);
        }

        $dataBuku->judul = $request->judul;
        $dataBuku->pengarang = $request->pengarang;
        $dataBuku->tanggal_publikasi = $request->tanggal_publikasi;

        $post = $dataBuku->save();

        return response()->json([
            'status' => true,
            'message' => 'data berhasil ditambahkan'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = buku::find($id);
        if ($data)
        {
            return response()->json([
                'status' => true,
                'message' => 'data ditemukan',
                'data' => $data
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'data tidak ditemukan'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dataBuku = buku::find($id);
        if(empty($dataBuku))
        {
            return response()->json([
                'status' => false,
                'message' => 'data tidak ditemukan'
            ], 404);
        }

        $rules = [
            'judul' => 'required',
            'pengarang' => 'required',
            'tanggal_publikasi' => 'required|date',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
        {
            return response()->json([
                'status' => false,
                'message' => 'gagal update data',
                'data' => $validator->errors()
            ]);
        }

        $dataBuku->judul = $request->judul;
        $dataBuku->pengarang = $request->pengarang;
        $dataBuku->tanggal_publikasi = $request->tanggal_publikasi;

        $post = $dataBuku->save();

        return response()->json([
            'status' => true,
            'message' => 'data berhasil diupdate'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dataBuku = buku::find($id);
        if(empty($dataBuku))
        {
            return response()->json([
                'status' => false,
                'message' => 'data tidak ditemukan'
            ], 404);
        }

        $post = $dataBuku->delete();

        return response()->json([
            'status' => true,
            'message' => 'data berhasil dihapus'
        ]);
    }
}
