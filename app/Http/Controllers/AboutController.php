<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;
use App\Models\Contact;

class AboutController extends Controller
{
    public function index() 
    {
        $about = About::all();
        $contact = Contact::all();
        return view('about', compact('about', 'contact'));
    }
}
