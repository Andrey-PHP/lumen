<form action="" method="POST"/>
<label> First name: </label>
<input type="text" name="first_name"/>
<label> Last name: </label>
<input type="text" name="last_name"/>
<label>Select book</label>
<select name="books[]" multiple="multiple">
    @foreach($books as $book)
        <option value="{{$book->id}}">{{$book->name}}</option>
    @endforeach
</select>
<input type="submit">
</form>
<br>
<br>
<p>If book not found in a dropdown please add a new one</p>
<a href="{{route('admin.books.add')}}"><button>Add new book</button></a>
