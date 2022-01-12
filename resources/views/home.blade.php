@extends('layouts.app')

@section('content')

    <div class="card p-5 border-light">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h1>
                        Your Tasks
                    </h1>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{!! route('tasks.create') !!}" class="btn btn-outline-primary ">
                        <i class="fa fa-plus"></i> Add New Task
                    </a>
                </div>

                <div class="col-md-12 mt-3 task-list-box">
                    <div class="row py-0">
                        <div class="col-md-6 border-end border-light border-3 task-list-content">
                            Hello
                            1 <br>
                            1 <br>
                            1 <br>
                            1 <br>
                        </div>
                        <div class="col-md-6 task-list-content">
                            Hi <br>
                            1 <br>
                            1 <br>
                            1 <br>
                            1 <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
