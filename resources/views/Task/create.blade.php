@extends('layouts.layout')

@section('content')
<div class="container">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ url('/task' ) }}">Home</a></li>
        <li class="breadcrumb-item active">Create</li>
    </ol>
    <div class="card">
        <div class="card-header">
            <h5>Create Task</h5>
        </div>
        <div class="card-body">
            <form action="{{ url('/task') }}" method="POST">
                @csrf
                    <div class="form-grup">
                        <label for="name">Name:</label>
                        <input class="form-control" id="name" name="name" value="{{ old('name')}}"/>
                        @error('name')
                            <small>* {{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-grup">
                        <label for="priority">Priority:</label>
                        <input class="form-control" id="priority" name="priority" value="{{ old('priority')}}"/>
                        @error('priority')
                            <small>* {{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-grup mt-2">
                        <input class="btn btn-primary" type="submit" name="send" value="Send"/>
                    </div>
            </form>
        </div>
    </div>
</div>
@endsection
