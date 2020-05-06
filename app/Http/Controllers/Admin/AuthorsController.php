<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class AuthorsController extends Controller
{
    public function create(Request $request, Author $authors)
    {
        if ($request->method() !== 'POST') {
            $books = Book::all();
            return view('admin.authors.create', ['books' => $books]);
        }
        try {
            $this->validate($request, [
                'first_name' => ['required', 'max:50', 'min:3'],
                'last_name' => ['required', 'max:50', 'min:3'],
                'books' => Rule::exists('books', 'id'),
            ]);
            /** TODO in normal project here should be normal error handling */
        } catch (ValidationException $exception) {
            return $exception->getResponse()->getContent();
        }
        $authors->first_name = $request->post('first_name');
        $authors->last_name = $request->post('last_name');
        $authors->save();
        if (!empty($request->post('books'))) {
            $authors->books()->sync($request->post('books'));
        }
        return redirect(route('admin.index'));
    }

    public function delete(int $id)
    {
        Author::destroy($id);
        return redirect(route('admin.index'));
    }

    public function update(int $id, Request $request)
    {
        /** @var Author $author */
        $author = Author::find($id);
        if (!$author) {
            return 'Author with ID ' . $id . ' not exists';
        }
        if ($request->method() !== 'POST') {
            $books = Book::all();
            return view('admin.authors.edit', ['author' => $author, 'books' => $books]);
        }
        try {
            $this->validate($request, [
                'first_name' => ['required', 'max:50', 'min:3'],
                'last_name' => ['required', 'max:50', 'min:3'],
                'books' => Rule::exists('books', 'id'),
            ]);
            /** TODO in normal project here should be normal error handling */
        } catch (ValidationException $exception) {
            return $exception->getResponse()->getContent();
        }
        $author->update($request->only('first_name', 'last_name'));
        if (!empty($request->post('books'))) {
            $author->books()->sync($request->post('books'));
        }
        return redirect(route('admin.index'));
    }
}
