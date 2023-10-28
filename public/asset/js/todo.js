function delete_task(id){
    new Swal({
        title: 'Are you sure?',
        text: 'This record and it`s details will be permanantly deleted!',
        icon: 'warning',
        buttons: ["Cancel", "Yes!"],
    }).then(function(value) {
        if(value){
            $.get('/delete/'+id,function(data){
                if(data=="OK"){
                    var target = $("#"+id);
        
                    target.hide('slow',function(){
                        target.remove();
        
                    })
                }
            });
        }
       
    });
    
}

$("body").on("click", ".custom_check", function(e) {
    let status = $(this).prop('checked') === true ? 1 : 0;
    let taskId = e.target.id;
    console.log(status,taskId);
    var url = '/changeStatus';
    var target = $("#"+taskId);
    // console.log(target);
    target.hide('slow',function(){
        target.remove();

    })

    $.ajax({
        type: "GET",
        dataType: "json",
        url: url,
        data: { 'status': status, 'task_id': taskId },
        success: function(data) {
            console.log(data.message);
        }
    });
});

function show_form(form_id){
    $('form').hide();
    $('#'+form_id).show('slow');
}

function edit_task(id,title){
    $('#edit_task_id').val(id);
    $('#edit_task_title').val(title);
    show_form('edit_task');
}

$('#add_task').submit(function(event){
    event.preventDefault();
    var title = $('#task_title').val();
    if(title){
        $.post('/add',{title:title}).done(function(data){
            $('#add_task').hide('slow');
            $('#task_list').append(data);
            $('#task_title').val('');
        });
    }else{
        alert('Please give title to task');
    }
})

$('#edit_task').submit(function(event){
    event.preventDefault();
    var  task_id = $('#edit_task_id').val();
    var title = $('#edit_task_title').val();
    var current_title = $('#span_'+task_id).text();

    var new_title = current_title.replace(current_title,title);
    if(title){
        $.post('/update/'+task_id,{title:title}).done(function(data){
            $('#edit_task').hide('slow');
            $('#span_'+task_id).text(new_title);

        });
    }else{
        alert('Please give title to the task');
    }
});

function show_all_task(){
    url='/';
    $.ajax({
        type: "GET",
        dataType: "json",
        url: url,
        data: { 'status': status,'show':'allTask' },
        success: function(data) {
            console.log(data);
            let todos = data.todo;
            $('.todo-list').html(''); 
            let html = '';
                    todos.forEach(todo => {
                        console.log(todo)
                        if(todo.status == 1){
                            html += `<li id="${todo.id}" class="done">
                            <a href="#" class="toggle"></a>
                                <input type="checkbox" class="custom-control-input custom_check"
                                    id="${todo.id }" name="status"
                                    ${todo.status == 1 ? 'checked' : '' }>
                                <label class="custom-control-label"
                                    for="${todo.id}"></label>
                            <span id="span_${todo.id}">${todo.title}</span>
                            <a href="#" onclick="edit_task('${todo.id}','${todo.title}')" class="btn btn-primary btn-sm">Edit</a>
                            <a href="#" onclick="delete_task('${todo.id}')" class="btn btn-danger btn-sm">Delete</a>
                        </li>`
                        }
                        else{
                            html +=  `<li id="${todo.id}">
                                <a href="#" class="toggle"></a>
                                        <input type="checkbox" class="custom-control-input custom_check"
                                            id="${todo.id}" name="status" ${todo.status == 1 ? 'checked' : '' }>
                                        <label class="custom-control-label"
                                            for="${todo.id}"></label>
                                <span id="span_${todo.id}">${todo.title}</span>
                                <a href="#" onclick="edit_task('${todo.id}','${todo.title}')" class="btn btn-primary btn-sm">Edit</a>
                                <a href="#" onclick="delete_task('${todo.id}')" class="btn btn-danger btn-sm">Delete</a>
                            </li>`
                        }
                    });
                    $('.todo-list').append(html);    
                
        }
    });
}


