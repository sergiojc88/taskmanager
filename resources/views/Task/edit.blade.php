@extends('layouts.layout')

@section('content')
<div class="container">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ url('/task' ) }}">Home</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>
    <div class="card">
        <div class="card-header">
            <h5>Create Task</h5>
        </div>
        <div class="card-body">
            <form action="{{ url('/task/'.$task->id) }}" method="POST">
                @csrf
                {{ method_field('PUT') }}
                <div class="form-grup">
                    <label for="name">Name:</label>
                    <input class="form-control" id="name" name="name" value="{{ $task->name }}"/>
                    @error('name')
                        <small>* {{ $message }}</small>
                    @enderror
                </div>
                <div class="form-grup">
                    <label for="name">Priority:</label>
                    <input class="form-control" id="priority" name="priority" value="{{ $task->priority }}"/>
                    @error('priority')
                        <small>* {{ $message }}</small>
                    @enderror
                </div>
                <div class="form-grup">
                    <input class="btn btn-primary mt-2" type="submit" name="send" value="Send"/>
                </div>
                </form>
        </div>
    </div>
</div>

@endsection
