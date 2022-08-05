@extends('layouts.layout')

@section('content')
<div id="message"></div>

<div class="container">
    <a href="{{ url('/task/create' ) }}">Create task</a>
    <div class="card">
        <div class="card-header">
            List of Tasks
        </div>
        <div class="p-4">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Priority</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task )
                        <tr id="{{ $task->id }}">
                            <td>{{ $task->id }}</td>
                            <td>{{ $task->name }}</td>
                            <td>{{ $task->priority }}</td>
                            <td>
                            <div class="d-flex">
                                <a class="btn btn-primary" style="margin-bottom: 16px;margin-right: 5px;" href="{{ url('/task/'.$task->id.'/edit' ) }}">EDIT</a>
                                <form action="{{ url('/task/'.$task->id) }}" method="POST">
                                @csrf
                                {{ method_field('DELETE') }}
                                    <input class="btn btn-primary" type="submit" value="DELETE"/>
                                </form>
                            </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
    $(document).ready(function () {
        $(function () {
                    $("tbody").sortable({
                        start: function(e, ui) {
                            $(this).attr('data-previndex', ui.item.index());
                        },
                        update: function(event, ui) {
                            //$.post("/taskManager/public/task/" + {{ $task->id }} + '/edit', function(data){
                            //})
                            var parametros = {

                                "priority" : ui.item.index(),
                                "old_priority" : $(this).attr('data-previndex')
                            };
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $.ajax({
                                data: parametros,
                                url: "{{ url('/task/updatepriority' ) }}" + '/' + ui.item[0].id,
                                type: 'PUT',
                                success: function(result) {
                                    console.log('succes');
                                    window.location.reload();
                                }
                            });
                        }
                    });
                });
    });

</script>
@endsection
