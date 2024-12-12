<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;

class AdminAboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $about = About::all();

        return view('admin.about.index', compact('about'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.about.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         // Validasi inputan
         $request->validate([
            'title'    => 'required',
            'subtitle' => 'required',
            'description'  => 'required',
        ]);

        // Simpan data skill ke database
        About::create($request->all());

        session()->flash('success', 'Data berhasil ditambahkan!');

        return redirect()->route('about.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(About $about)
    {
        return view('admin.about.show', compact('about'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(About $about)
    {
        return view('admin.about.edit', compact('about'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, About $about)
    {
        // Validasi inputan
        $request->validate([
            'title'      => 'required',
            'subtitle'   => 'required',
            'description'    => 'required',
        ]);

        // Simpan data skill ke database
        $about->update($request->all());

        session()->flash('success', 'Data berhasil diubah!');
    
        return redirect()->route('about.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(About $about)
    {
        $about->delete();

        session()->flash('success', 'Data berhasil dihapus!');


        return redirect()->route('about.index');
    }
}
