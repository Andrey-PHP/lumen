<form action="" method="POST"/>
<label> First name: </label>
<input type="text" name="first_name" value="{{$author->first_name}}"/>
<label> Last name: </label>
<input type="text" name="last_name" value="{{$author->last_name}}"/>
<label>Select book</label>
<select name="books[]" multiple="multiple">
    @foreach($books as $book)
        <option
            {{in_array($book->id, $author->books->pluck('id')->toArray())? 'selected' : ''}} value="{{$book->id}}">{{$book->name}}</option>
    @endforeach
</select>
<input type="submit">
</form>
