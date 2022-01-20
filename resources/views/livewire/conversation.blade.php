<ul class="p-0 pe-1">
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
