<form action="{{route('create')}}" method="POST">
    @csrf
    <input type="text" name="todo">
    <button type="submit">등록</button>
</form>