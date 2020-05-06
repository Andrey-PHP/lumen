<table border="border-collapse">
    <thead>
    <tr>
        <td>Author</td>
        <td>Books </td>
    </tr>
    </thead>
    <tbody>
    @foreach($authors as $author)
        <tr>
            <td>{{$author->first_name}} {{$author->last_name}}</td>
            <td>{{$author->books->pluck('name')->join(', ')}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
