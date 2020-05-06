<?php


namespace App\Http\Controllers;

use App\Models\Author;

class HomeController extends Controller
{
    public function index()
    {
        $authors = Author::all();
        return view('index', ['authors' => $authors]);
    }
}
