<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        return view('home.about');
    }

    public function privacy()
    {
        return view('home.privacy');
    }
}
