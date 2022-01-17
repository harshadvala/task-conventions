@extends('layouts.app')
@section('content')

    <div class="card p-0 p-md-5 border-light">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <a href="{!! route('home') !!}" style="color:  #C8C5C5;" class="text-uppercase small">
                        <i class="fa fa-chevron-left" style="color: #C8C5C5"></i> Back To HOME PAGE
                    </a>
                </div>

                <div class="col-md-12">
                    <h2>
                        Task has been submitted successfully
                    </h2>
                </div>

                <div class="col-md-12 mt-3">
                    <div class="row py-0">
                        <div class="col-sm-12 col-md-5">
                            <small>Your unique generated key</small>
                            <div class="my-6">
                                <h4>{!! $task->key !!}</h4>
                            </div>

                            <div class="my-2">
                                <hr>
                            </div>
                            <div class="py-2">
                                <p class="small text-muted">
                                    The details of your task have been sent to your e-mail.
                                    <br>
                                    The person who will be responsible for the task will contact you soon.
                                </p>

                            </div>

                            <div class="py-2">
                                <table class="small text-muted align-middle table-lg table table-borderless">
                                    <tr>
                                        <td style="width: 130px">Task Content</td>
                                        <td>
                                            {!! $task->content !!}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Task Description</td>
                                        <td>
                                            {!! $task->description !!}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Your Email Address</td>
                                        <td>
                                            {!! $task->email !!}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Your Phone</td>
                                        <td>
                                            {!! $task->phone !!}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Your Budget</td>
                                        <td>
                                            ${!! $task->budget_min !!} - ${!! $task->budget_max !!}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <img class="mx-lg-5" style="max-width: 350px" src="{!! asset('images/task-success.png') !!}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
