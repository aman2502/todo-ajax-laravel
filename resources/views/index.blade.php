<html>
    <head>
        <title>To-do List</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="{{url('asset/css/style.css')}}">
        <meta name="csrf-token" content="{{csrf_token()}}">
    </head>
    <body>
        <section class="content">
            <div class="container-fluid pt-3">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                    <span><img src="{{asset('asset/add.png')}}" width="25px" onclick="show_form('add_task')" title="click on plus icon"/>Add Task</span>
                                    <a href="#" onclick="show_all_task()" class="btn btn-primary btn-sm">Show All Task</a>
                                
                            </div>
                            <div class="card-body">
                                @if (session()->has('success'))
                            <h5 class="alert alert-success message">{{ session('success') }}</h5>
                        @elseif(session()->has('error'))
                        <h5 class="alert alert-danger message">{{ session('error') }}</h5>
                        @endif
                        <ul id="task_list" class="todo-list">
        
                        </ul>
                        <section id="form_section" >
                            <form id="add_task" class="todo" style="display: none;">
                                <input id="task_title" type="text" name="title" placeholder="Enter a task name" value="" />
                                <button name="submit">Add Task</button>
                            </form>
                            <form id="edit_task" class="todo" style="display: none;">
                                <input type="hidden" id="edit_task_id" value="">
                                <input id="edit_task_title" type="text" name="title" placeholder="Enter a task name" value="" />
                                <button name="submit">Edit Task</button>
                            </form>
                        </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
        <script>
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            })
        </script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{url('asset/js/todo.js')}}"></script>
    </body>
</html>
