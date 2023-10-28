@foreach($todos as $todo)
    <li id="{{$todo->id}}">
        <a href="#" class="toggle"></a>
            <input type="checkbox" class="custom-control-input custom_check"
                id="{{ $todo->id }}" name="status"
                {{ $todo->status == 1 ? 'checked' : '' }}>
            <label class="custom-control-label"
                for="{{ $todo->id }}"></label>
        <span id="span_{{$todo->id}}">{{$todo->title}}</span>
        <a href="#" onclick="edit_task('{{$todo->id}}','{{$todo->title}}')" class="btn btn-primary btn-sm">Edit</a>
        <a href="#" onclick="delete_task('{{$todo->id}}')" class="btn btn-danger btn-sm">Delete</a>
    </li>
@endforeach
