<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use stdClass;

class BookController extends Controller
{
    public function show()
    {
        $books = Book::all();
        if (!$books) {
            return response()->json(['error' => 'Books not found'], 404);
        }
        return BookResource::collection($books);
    }

    public function showById(int $id)
    {
        $book = Book::find($id);
        if (!$book) {
            return response()->json(['error' => 'Book not found'], 404);
        }
        return new BookResource($book);
    }

    public function update(int $id, Request $request)
    {
        /** @var Book $book */
        $book = Book::find($id);
        if (!$book) {
            return response()->json(['error' => 'Book not found'], 404);
        }
        $this->validate($request, [
            'name'    => ['required', 'max:50', 'min:3'],
            'authors' => Rule::exists('authors', 'id'),
        ]);
        $book->update($request->only('name'));
        if ($request->get('authors')) {
            foreach ($request->get('authors') as $authorId) {
                $book->authors()->sync($authorId['id']);
            }
        }
        return new BookResource($book);
    }

    public function delete(int $id)
    {
        /** @var Book $book */
        $book = Book::find($id);
        if (!$book) {
            return response()->json(['error' => 'Book not found'], 404);
        }
        $book->delete();
        return response()->json(new stdClass());
    }
}
