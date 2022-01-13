@extends('layouts.app')

@section('ex_css')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
    <style>
        .slider-container {
            width: 100%;
            padding: 45px;
            background: #fff;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            border-radius: 3px
        }

        #rangeSlider {
            background: #fff;
            height: 8px;
        }

        .ui-widget-header {
            background: #0d6efd;
        }

        .ui-slider-handle {
            font-size: 14px;
            border-radius: 50%;
            outline: none;
            border: 8px solid #fff;
            width: 10px;
            height: 10px;
            background: #0d6efd;
            top: -8px;
            box-shadow: 0px 0px 1px 1px rgba(0, 0, 0, 0.2)
        }

        .value {
            position: absolute;
            top: 18px;
            left: 50%;
            margin: 0 0 0 -20px;
            text-align: center;
            display: block;
            font-size: 10px;
        }

        .price-range-both.value {
            width: 100px;
            margin: 0 0 0 -50px;
            top: 26px;
        }

        .price-range-both {
            display: none;
        }

        .value i {
            font-style: normal;
        }

        .img-thumbnail{
            max-width: 100px;
        }
    </style>
@endsection
@section('content')

    <div class="card p-5 border-light">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <a href="{!! route('home') !!}" style="color:  #C8C5C5;" class="text-uppercase small">
                        <i class="fa fa-chevron-left" style="color: #C8C5C5"></i> Back To HOME PAGE
                    </a>
                </div>

                <div class="col-md-12">
                    <h2>
                        Describe the task and we will be in touch
                    </h2>
                </div>

                <div class="col-md-12 mt-3">
                    <div class="row py-0">
                        <div class="col-md-5">
                            <div class="justify-content-center p-5"
                                 style="box-shadow: 10px 10px 50px 3px rgba(39, 92, 141, 0.1);border-radius: 12px;">

                                <h4>
                                    Your Task
                                </h4>

                                @php
                                    if(isset($task) && $task && $task->id){
                                        $url=route('tasks.update',$task->id);
                                    } else{
                                          $url=route('tasks.store');
                                        }
                                @endphp

                                <form class="mt-3" action="{!! $url !!}" method="post"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @if(isset($task) && $task && $task->id)
                                        @method('put')
                                    @endif

                                    <input type="hidden" name="id" value="{{(isset($task) && $task)?$task->id:''}}">
                                    <div class="row">

                                        <div class="col-md-12">
                                            @include('layouts.error')
                                        </div>

                                        <div class="col-md-12 form-group mb-3">
                                            <input
                                                class="form-control border-0 fs-6 form-control-lg @error('content') is-invalid @enderror"
                                                value="{!! old('content', (isset($task) && $task)?$task->content:'') !!}"
                                                name="content"
                                                placeholder="Task Content">
                                        </div>

                                        <div class="col-md-12 form-group mb-3">
                                            <textarea rows="4"
                                                      class="form-control fs-6 border-0 @error('description') is-invalid @enderror"
                                                      name="description"
                                                      placeholder="Task Description">{!! old('description', (isset($task) && $task)?$task->description:'') !!}</textarea>
                                        </div>

                                        <div class="col-md-12 form-group mb-3">
                                            <input
                                                class="form-control border-0 form-control-lg fs-6 @error('email') is-invalid @enderror"
                                                value="{!! old('email', (isset($task) && $task)?$task->email:Auth::user()->email) !!}"
                                                name="email" placeholder="Your Email Address">
                                        </div>

                                        <div class="col-md-12 form-group mb-3">
                                            <input
                                                class="form-control border-0 form-control-lg fs-6 @error('phone') is-invalid @enderror"
                                                value="{!! old('phone', (isset($task) && $task)?$task->phone:'') !!}"
                                                name="phone" placeholder="Your Phone">
                                        </div>


                                        <div class="col-md-12 mb-3">
                                            <label for="file-upload"
                                                   class="custom-file-upload w-100 text-center  bg-light">
                                                <i class="fa fa-cloud-upload"></i> Select File to upload
                                            </label>
                                            <input id="file-upload" type="file" name="file"/>

                                            @if(isset($task) && $task && $task->file)
                                                <a href="{!! Storage::url($task->file) !!}" target="_blank">
                                                    <img onerror="this.src='{!! asset('images/file.png') !!}';"
                                                         src="{!! Storage::url($task->file) !!}" alt="Attachment"
                                                         class="img-thumbnail my-2">
                                                </a>
                                            @endif

                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label class="text-muted mb-1">Your Budget</label>
                                            <div id="slider-range" class="mb-3"></div>
                                            <input type="hidden" id="budget_min"
                                                   value="{!! old('budget_min', (isset($task) && $task)?$task->budget_min:'') !!}"
                                                   name="budget_min">
                                            <input type="hidden" id="budget_max"
                                                   value="{!! old('budget_max', (isset($task) && $task)?$task->budget_max:'') !!}"
                                                   name="budget_max">
                                        </div>


                                        <div class="col-md-12 form-group my-3">
                                            <button class="btn btn-primary w-100 text-uppercase">Submit Task</button>
                                        </div>


                                    </div>

                                </form>

                            </div>
                        </div>
                        <div class="col-md-7 task-list-content">
                            <img class="mx-lg-5" style="max-width: 550px" src="{!! asset('images/task.png') !!}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('ex_js')
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script>
        $(document).ready(function () {
            let minVal = $('#budget_min').val();
            let maxVal = $('#budget_max').val();

            function isEmpty(value) {
                return (value == null || value === '');
            }

            if (isEmpty(minVal)) minVal = 500;
            if (isEmpty(maxVal)) maxVal = 1500;

            $('#slider-range').slider({
                range: true,
                min: 0,
                max: 5000,
                step: 100,
                values: [minVal, maxVal],
                slide: function (event, ui) {
                    $('.ui-slider-handle:eq(0) .price-range-min').html('$' + ui.values[0]);
                    $('.ui-slider-handle:eq(1) .price-range-max').html('$' + ui.values[1]);
                    $('#budget_min').val(ui.values[0]);
                    $('#budget_max').val(ui.values[1]);
                }
            });


            $('#budget_min').val($('#slider-range').slider('values', 0));
            $('#budget_max').val($('#slider-range').slider('values', 1));
            $('.ui-slider-handle:eq(0)').append('<span class="price-range-min value">$' + $('#slider-range').slider('values', 0) + '</span>');
            $('.ui-slider-handle:eq(1)').append('<span class="price-range-max value">$' + $('#slider-range').slider('values', 1) + '</span>');
        });
    </script>
@endsection
