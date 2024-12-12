<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Announce;

class AdminAnnounceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $announce = Announce::all();
        return view('admin.announce.index', compact('announce'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.announce.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         // Validasi inputan
         $request->validate([
            'title'    => 'required',
        ]);

        // Simpan data skill ke database
        Announce::create($request->all());

        session()->flash('success', 'Data berhasil ditambahkan!');

        return redirect()->route('announce.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Announce $announce)
    {
        return view('admin.announce.show', compact('announce'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Announce $announce)
    {
        return view('admin.announce.edit', compact('announce'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Announce $announce)
    {
        // Validasi inputan
        $request->validate([
            'title'      => 'required',
        ]);

        // Simpan data skill ke database
        $announce->update($request->all());

        session()->flash('success', 'Data berhasil diubah!');
    
        return redirect()->route('announce.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Announce $announce)
    {
        $announce->delete();

        session()->flash('success', 'Data berhasil dihapus!');
        return redirect()->route('announce.index');
    }
}
