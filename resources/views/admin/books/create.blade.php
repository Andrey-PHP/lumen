<form action="" method="POST"/>
<label> Name: </label>
<input type="text" name="name"/>
<label>Select author</label>
<select name="authors[]" multiple="multiple">
    @foreach($authors as $author)
        <option value="{{$author->id}}">{{$author->first_name}} {{$author->last_name}}</option>
    @endforeach
</select>
<input type="submit" />
</form>
<br>
<br>
<p>If author not found in a dropdown please add a new one</p>
<a href="{{route('admin.authors.add')}}"><button>Add new author</button></a>
