<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;

class IndexController extends Controller
{
    public function index()
    {
        $authors = Author::all();
        $books = Book::whereHas('authors', function ($query) use ($authors) {
            $query->whereIn('id', $authors->pluck('id')->toArray());
        })->get();
        return view('admin.index', ['books' => $books, 'authors' => $authors]);
    }
}
