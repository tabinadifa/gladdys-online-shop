<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class AdminContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contact = Contact::all();
        return view('admin.contact.index', compact('contact'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.contact.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'email' => 'required',
            'instagram' => 'required',
            'tiktok' => 'required',
            'twitter' => 'required',
            'youtube' => 'required',
        ]);

        Contact::create($request->all());

        session()->flash('success', 'Data berhasil ditambahkan');
        
        return redirect()->route('contact.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        return view('admin.contact.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        return view('admin.contact.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'phone' => 'required',
            'email' => 'required',
            'instagram' => 'required',
            'tiktok' => 'required',
            'twitter' => 'required',
            'youtube' => 'required',
        ]);

        $contact->update($request->all());

        session()->flash('success', 'Data berhasil diubah');
        
        return redirect()->route('contact.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        session()->flash('success', 'Data berhasil dihapus');

        return redirect()->route('contact.index');
    }
}
