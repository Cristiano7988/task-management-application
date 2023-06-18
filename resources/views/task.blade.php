@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">{{ $task->title }}</div>
        <div class="card-body d-flex flex-column">
            {{ $task->description }}
            @if (!!$task->completed)
                <p class="text-success">Completed</p>
            @else
                <p class="text-danger align-self-end">Not completed</p>
            @endif
        </div>
    </div>
</div>
@endsection
