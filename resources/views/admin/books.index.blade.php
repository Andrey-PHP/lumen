<div>
    <ul>
        @foreach($books as $book)
            <p>Book: {{$book->name}}</p>
        @endforeach
    </ul>
</div>
