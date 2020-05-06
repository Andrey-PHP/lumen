<a href="{{route('admin.authors.add')}}">
    <button style="padding: 1%">Add new author</button>
</a>
<table border="border-collapse">
    <thead>
    <tr>
        <td>Author</td>
        <td>Books amount</td>
        <td>Edit</td>
        <td>Delete</td>
    </tr>
    </thead>
    <tbody>
    @foreach($authors as $author)
        <tr>
            <td>{{$author->first_name}} {{$author->last_name}}</td>
            <td>{{count($author->books)}}</td>
            <td>
                <a href="{{route('admin.authors.update', ['id' => $author->id])}}"><button>Edit</button></a>
            </td>
            <td>
                <a href="{{route('admin.authors.delete', ['id' => $author->id])}}"><button>Delete</button></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<br>
<br>
<a href="{{route('admin.books.add')}}">
    <button style="padding: 1%">Add new book</button>
</a>
<table border="border-collapse">
    <thead>
    <tr>
        <td>Book</td>
        <td>Authors</td>
        <td>Edit</td>
        <td>Delete</td>
    </tr>
    </thead>
    <tbody>
    @foreach($books as $book)
        <tr>
            <td>{{$book->name}}</td>
            <td>
                {{$book->authors->pluck('full_name')->join(', ')}}
            </td>
            <td>
                <a href="{{route('admin.books.update', ['id' => $book->id])}}"><button>Edit</button></a>
            </td>
            <td>
                <a href="{{route('admin.books.delete', ['id' => $book->id])}}"><button>Delete</button></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
