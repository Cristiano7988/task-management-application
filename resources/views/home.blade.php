@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('New Task') }}</div>
                <div class="card-body">
                    <form method="POST" action="/tasks">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" id="title" class="form-control" name="title" placeholder="Title" required />
                        </div>
                        <div class="form-outline mt-2">
                            <label for="description">Description:</label>
                            <textarea id="description" class="form-control" name="description" placeholder="Description" rows="4"></textarea>
                        </div>
                        <div class="form-check form-switch mt-2">
                            <input class="form-check-input" type="checkbox" role="switch" id="completed" name="completed" />
                            <label class="form-check-label" for="completed">Completed?</label>
                        </div>

                        <input type="submit" class="btn btn-primary mt-2" value="Create task" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
