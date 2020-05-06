<form action="" method="POST"/>
<label> Name: </label>
<input type="text" name="name" value="{{$book->name}}"/>
<label>Select author: </label>
<select name="authors[]" multiple="multiple">
    @foreach($authors as $author)
        <option
            {{in_array($author->id, $book->authors->pluck('id')->toArray())? 'selected' : ''}} value="{{$author->id}}">
            {{$author->first_name}} {{$author->last_name}}
        </option>
    @endforeach
</select>
<input type="submit">
</form>
