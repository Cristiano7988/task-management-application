@extends('layouts.app')

@section('content')
<div class="container">
    @foreach ($tasks as $task)
        <div class="card mt-4">
            <div class="card-header">{{ $task->title }}</div>
            <div class="card-body d-flex flex-column">
                <div class="mt-2">
                    {{ $task->description }}
                </div>
                <div class="align-self-end">
                    @if (!!$task->completed)
                        <p class="text-success">Completed</p>
                    @else
                        <p class="text-danger">Not completed</p>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
    <hr />
    {{ $tasks->links() }}
</div>
@endsection
