<div class="row py-0">
    <button class="btn btn-light btn-sm mb-1 d-none" id="refresh-chat-btn"
            wire:click="refreshChat">
        <i class="fa fa-refresh text-secondary "></i> Refresh Chat
    </button>
    @if($tasks->count()>0)
        <div
            class="col-md-6 border-end border-light border-3 task-list-content {!! ($agent !== 'Mobile')?'scroll-v':'' !!}"
            id="task-list-content">
            @foreach($tasks as $ind=>$task)
                <div
                    class="task-node cursor-pointer border-dark border-1 px-1 py-2 {!! (($ind+1)>=$tasks->count())?'border-0':'border-bottom' !!}">
                    <div class="d-flex justify-content-between mt-2" wire:click="selectTask({{$task->id}})"
                         @if($agent == 'Mobile') data-toggle="modal" data-target="#exampleModal" @endif>

                        <div class="fs-7 fw-bold {!! ($task->id == $selectedTask)?'text-primary':'' !!}">
                            {!! $task->content !!}
                        </div>
                        <div>
                            <label class="w-auto small px-2 {!! ($task->id == $selectedTask)?'bg-lb':'bg-lg' !!}">
                                ${!! $task->budget_min !!} - ${!! $task->budget_max !!}
                            </label>
                        </div>
                    </div>
                    <div class="">
                        <div class="small text-muted">
                            <span wire:click="selectTask({{$task->id}})">
                                {!! $task->description !!}
                            </span>
                            @if($task->user_id === auth::id())
                                <div class="d-flex align-bottom p-1 float-right">
                                    <a href="{!! route('tasks.edit',$task->id) !!}">
                                        <i class="fa fa-edit text-secondary me-1 fs-5"></i>
                                    </a>

                                    <i class="fa fa-trash text-danger fs-5" wire:click="deleteTask({{ $task->id }})"
                                       onclick="confirm('Are you sure you want to remove?') || event.stopImmediatePropagation()"></i>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            @endforeach

        </div>
        @if($agent !== 'Mobile')
            <div class="d-none d-md-block col-md-6 task-list-content ">
                <div class="row gx-5">
                    @if($taskObject)
                        <div class="bg-light p-2 d-md-none border border-light w-100">
                            {!! $taskObject->content !!}
                        </div>
                    @endif
                    <div class="col-lg-12">
                        @if($selectedTask)
                            <div class="chat-app">
                                <div class="chat">
                                    <div class="chat-history px-2">
                                        @include('livewire.conversation')
                                    </div>
                                    <div class="chat-message clearfix px-0">
                                        <div class="input-group mb-0">
                                            <input type="text" wire:keydown.enter="sendMessage" wire:model="message"
                                                   class="form-control border-0 form-control-lg fs-6" maxlength="190"
                                                   placeholder="Type text here...">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    @else
        <div class="col-md-12 text-muted text-center align-middle my-5 py-5">
            No Tasks Found
        </div>
    @endif

    @if($agent == 'Mobile')
        <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-fullscreen" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            @if($taskObject)
                                {!! $taskObject->content !!}
                            @endif
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body chat-history" style="height: 80vh ">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="chat-app">

                                    <div class="chat">
                                        <div class="text-end border-bottom  border-light mb-2 d-none">
                                            <button class="btn btn-light btn-sm mb-1" id="refresh-chat-btn"
                                                    wire:click="refreshChat">
                                                <i class="fa fa-refresh text-secondary "></i> Refresh Chat
                                            </button>
                                        </div>

                                        <div class="chat-history px-2" style="height: unset;overflow: unset">
                                            @include('livewire.conversation')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="input-group mb-0">
                            <input type="text" wire:keydown.enter="sendMessage" wire:model="message"
                                   class="form-control border-0 form-control-lg fs-6" maxlength="190"
                                   placeholder="Type text here...">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
