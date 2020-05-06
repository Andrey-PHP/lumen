<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class BookController extends Controller
{
    public function create(Request $request, Book $book)
    {
        if ($request->method() !== 'POST') {
            $authors = Author::all();
            return view('admin.books.create', ['authors' => $authors]);
        }
        try {
            $this->validate($request, [
                'name'    => ['required', 'max:50', 'min:3'],
                'authors' => Rule::exists('authors', 'id'),
            ]);
            /** TODO in normal project here should be normal error handling */
        } catch (ValidationException $exception) {
            return $exception->getResponse()->getContent();
        }
        $book->name = $request->post('name');
        $book->save();
        if (!empty($request->post('authors'))) {
            $book->authors()->sync($request->post('authors'));
        }
        return redirect(route('admin.index'));
    }

    public function delete(int $id)
    {
        Book::destroy($id);
        return redirect(route('admin.index'));
    }

    public function update(int $id, Request $request)
    {
        /** @var Book $book */
        $book = Book::find($id);
        if (!$book) {
            return 'BookResource with ID ' . $id . ' not exists';
        }
        if ($request->method() !== 'POST') {
            $authors = Author::all();
            return view('admin.books.edit', ['book' => $book, 'authors' => $authors]);
        }
        try {
            $this->validate($request, [
                'name'    => ['required', 'max:50', 'min:3'],
                'authors' => Rule::exists('authors', 'id'),
            ]);
            /** TODO in normal project here should be normal error handling */
        } catch (ValidationException $exception) {
            return $exception->getResponse()->getContent();
        }
        $book->update($request->only('name'));
        if (!empty($request->post('authors'))) {
            $book->authors()->sync($request->post('authors'));
        }
        return redirect(route('admin.index'));
    }
}
