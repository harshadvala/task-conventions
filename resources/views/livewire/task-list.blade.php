<div class="row py-0">
    @if($tasks->count()>0)
        <div class="col-md-6 border-end border-light border-3 task-list-content" id="task-list-content">
            @foreach($tasks as $ind=>$task)
                <div
                    class="task-node cursor-pointer border-dark border-1 px-1 py-2 {!! (($ind+1)>=$tasks->count())?'border-0':'border-bottom' !!}">
                    <div class="d-flex justify-content-between mt-2" wire:click="selectTask({{$task->id}})">
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
        <div class="col-md-6 task-list-content">
            <div class="row">
                <div class="col-lg-12">
                    @if($selectedTask)
                        <div class="chat-app">
                            <div class="chat">
                                <div class="chat-history px-1">
                                    <ul class="p-0">
                                        @php
                                            $prevMsg=null;
                                        @endphp
                                        @foreach($conversations as $row)
                                            @if(!$prevMsg || ($prevMsg && $row->created_at->format('Y-m-d') !== $prevMsg->created_at->format('Y-m-d')))
                                                <li class="clearfix date-val">
                                                    <span class="small">
                                                        {{ ($row->created_at->isToday())?'Today': (($row->created_at->isYesterday())?'Yesterday':$row->created_at->format('M d, Y')) }}
                                                    </span>
                                                </li>
                                            @endif
                                            @if(Auth::id()!== $row->from_id)
                                                <li class="clearfix">
                                                    <div class="message-data">
                                                        <img
                                                            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQqGQ8dQ-LMiMmTEyBijR0FzpQHC7tH6qTE2g&usqp=CAU"
                                                            alt="avatar">
                                                        <span class="message-data-time">{!! $row->from->name !!}
                                                            <span class="small text-muted px-1">
                                                                <small><i class="fa fa-clock-o"></i> {{ $row->created_at->format('g:i A')  }}</small>
                                                            </span>
                                                        </span>
                                                    </div>
                                                    <div class="message my-message">
                                                        {!! $row->message !!}
                                                    </div>
                                                </li>
                                            @else
                                                <li class="clearfix">
                                                    <div class="message-data text-end">
                                                    <span class="message-data-time small text-muted"><i
                                                            class="fa fa-clock-o"></i> {{ $row->created_at->format('g:i A')}}</span>
                                                    </div>
                                                    <div class="message other-message float-right text-start">
                                                        {!! $row->message !!}
                                                    </div>
                                                </li>
                                            @endif
                                            @php
                                                $prevMsg = $row;
                                            @endphp
                                        @endforeach
                                    </ul>
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
    @else
        <div class="col-md-12 text-muted text-center align-middle my-5 py-5">
            No Tasks Found
        </div>
    @endif
</div>
