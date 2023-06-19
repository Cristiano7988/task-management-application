@extends('layouts.app')

<style>
    .card.edit form {
        display: block;
    }
    .card.edit .card-body .d-flex {
        display: none !important;
    }
    .card-body form {
        display: none;
    }
</style>

<script>
    const tooggleEditMode = () => document.querySelector('.card').classList.toggle('edit');
    const deleteTask = (id) => {
        if (!confirm("Do you wish to delete this task?")) return;
        fetch("/tasks/" + id, {
            method: "DELETE",
            headers: {
                'X-CSRF-Token': document.querySelector('input[name=_token]').value
            }
        })
    }
</script>

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            {{ $task->title }}
            <div>
                @csrf
                <buton class="btn btn-primary" onclick="tooggleEditMode()">Edit</buton>
                <buton class="btn btn-danger" onclick="deleteTask({{$task->id}})">Delete</buton>
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex flex-column">
                {{ $task->description }}
                @if (!!$task->completed)
                    <p class="text-success">Completed</p>
                @else
                    <p class="text-danger align-self-end">Not completed</p>
                @endif
            </div>
            <form method="POST" action="/tasks/{{ $task->id }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" id="title" class="form-control" name="title" placeholder="Title" value="{{$task->title}}" required />
                </div>
                <div class="form-outline mt-2">
                    <label for="description">Description:</label>
                    <textarea id="description" class="form-control" name="description" placeholder="Description" rows="4">{{$task->description}}</textarea>
                </div>
                <div class="form-check form-switch mt-2">
                    <input class="form-check-input" type="checkbox" role="switch" id="completed" name="completed" @if (!!$task->completed) checked @endif />
                    <label class="form-check-label" for="completed">Completed?</label>
                </div>

                <input type="submit" class="btn btn-primary mt-2" value="Create task" />
            </form>
        </div>
    </div>
</div>
@endsection
