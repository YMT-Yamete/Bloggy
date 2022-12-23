<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function about() {
        $name = "Bloggy";
        return view('about', compact('name'));
    }
}