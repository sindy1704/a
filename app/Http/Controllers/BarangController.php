<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\barang;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = barang::all();

        return view('barang.index', ['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barang.form', ['item' => new Barang()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Barang::create([
            'nama' => $request->input('nama'),
            'barcode' => $request->input('barcode'),
            'satuan' => $request->input('satuan'),
        ]);

        return redirect(route('barang.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = Barang::findOrFail($id);
       
        return view('barang.show', ['item' => $item]);
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
        //
    }
}
