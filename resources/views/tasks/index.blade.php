@extends('layouts.app')

@section('content')

    <div class="card p-5 border-light">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h2>
                        Your Tasks
                    </h2>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{!! route('tasks.create') !!}" class="btn btn-outline-primary btn-sm">
                        <i class="fa fa-plus"></i> Add New Task
                    </a>
                </div>

                <div class="col-md-12 mt-3 task-list-box">
                    <livewire:task-list/>

                </div>
            </div>
        </div>
    </div>
@endsection