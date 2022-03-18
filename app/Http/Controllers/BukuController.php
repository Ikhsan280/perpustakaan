<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Session;
use Alert;
use Str;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buku = Buku::all();
        return view('admin.buku.index', compact('buku'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.buku.create');
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
            // 'id' => 'required|unique:bukus',
            // 'kode_buku' => 'required',
            'judul_buku' => 'required',
            'penulis_buku' => 'required',
            'penerbit_buku' => 'required',
            'tahun_penerbit' => 'required|numeric',
            'stok' => 'required|numeric',
        ]);
        $buku = new Buku;
        $buku->kode_buku = Str::random(4,5);
        $buku->judul_buku = $request->judul_buku;
        $buku->penulis_buku = $request->penulis_buku;
        $buku->penerbit_buku = $request->penerbit_buku;
        $buku->tahun_penerbit = $request->tahun_penerbit;
        $buku->stok = $request->stok;
        Alert::success('data '.$buku->judul_buku.' Berhasil Ditambahkan');
        $buku->save();
        

        return redirect()->route('buku.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $buku = Buku::findOrFail($id);
        return view('admin.buku.show', compact('buku'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        return view('admin.buku.edit', compact('buku'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            // 'id_buku' => 'required',
            // 'kode_buku' => 'required',
            'judul_buku' => 'required',
            'penulis_buku' => 'required',
            'penerbit_buku' => 'required',
            'tahun_penerbit' => 'required|numeric',
            'stok' => 'required|numeric',
        ]);
        $buku = Buku::findOrFail($id);
        // $buku->id_buku = $request->id_buku;
        $buku->kode_buku = Str::random(100);
        $buku->judul_buku = $request->judul_buku;
        $buku->penulis_buku = $request->penulis_buku;
        $buku->penerbit_buku = $request->penerbit_buku;
        $buku->tahun_penerbit = $request->tahun_penerbit;
        $buku->stok = $request->stok;
        Alert::success('data '.$buku->judul_buku.' Berhasil Diedit');
        $buku->save();
        return redirect()->route('buku.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Buku::destroy($id)){
            return redirect()->back();
        }
        alert::success('Mantap','Data berhasil dihapus');
        return redirect()->route('buku.index');
    }
}
