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
@section('ex_js')
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script>
        $(document).ready(function () {

            function scrollDown(){
                $('.chat-history').animate({ scrollTop: $('.chat-history').height() }, 800);
            }

            $('#task-list-content').on('click', '.task-node', function () {
                scrollDown();
                setTimeout(function () {
                    scrollDown();
                }, 500);
            });
            scrollDown();
        });
    </script>
@endsection
