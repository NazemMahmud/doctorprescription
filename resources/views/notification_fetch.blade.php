@if( count( $notifications)>0 )
    @foreach($notifications as $notification)
        <li>
            {{--<div class="col-md-12 col-xs-12 col-sm-12">--}}
                <a href="#" style="color: #000;">
                    {{--<div id="show_request" style="display: block;">--}}
                    @if($notification->accept_status==0)
                        @if( $notification->notification_type == 'request pa' )
                            <p><strong>{{ App\Doctor::where('id',$notification->from_doc_id)->first()->name }}</strong> is requested to be your <strong>Personal Assistant</strong>  </p>
                            {{--<p>{{ $notification->notification_text }} </p>--}}
                        @elseif( $notification->notification_type == 'request assistant' )
                            <p><strong>{{ App\Doctor::where('id',$notification->from_doc_id)->first()->name }}</strong> is requested to be your <strong>Assistant Doctor</strong>  </p>
                        @endif
                        <button class="btn btn-primary request_accept" id="request-accept" name="request-accept" style="" type="submit" onclick="assistantRequireHandle('yes', {{ $notification->notification_id }})">Accept</button>
                        <button class="btn request_reject" id="request-reject" name="request-reject" style="margin-left:20px;" type="submit" onclick="assistantRequireHandle('no', {{ $notification->notification_id }})">Reject</button>
                    @elseif($notification->accept_status==1)
                        @if( $notification->notification_type == 'request pa' )
                            <p><strong>{{ App\Doctor::where('id',$notification->from_doc_id)->first()->name }} </strong>is your new <strong>Personal Assistant</strong>  </p>
                        @elseif( $notification->notification_type == 'request assistant' )
                            <p><strong>{{ App\Doctor::where('id',$notification->from_doc_id)->first()->name }} </strong>is your new <strong>Assistant Doctor</strong>  </p>
                        @endif

                    @elseif($notification->accept_status==2)
                            <p><strong>{{ App\Doctor::where('id',$notification->from_doc_id)->first()->name }}</strong>'s request is rejected  </p>
                    @endif
                </a>
        </li>
        <li class="divider"></li>
    @endforeach

@elseif(count( $notifications)<=0)
    <li ><a href="#" class="text-bold text-italic dropdown-item" style="color: #000;">No New Request</a></li>
@endif

<script>
    function assistantRequireHandle(request_value, notification_id) {
//        alert(request_value + " " + notification_id);
////            var _token = $("#token").val();
            $.post("{{ URL::to('/request_handle') }}", {request_value: request_value, notification_id: notification_id }, function (data) {
                $('#dropdown-notification').html(data.notification);
//                alert(data.number);
//                alert(request_value + " " + notification_id);
            });
            if(request_value=='yes'){
                window.location.href="{{ URL::to('/assistants') }}";
                 {{-- // {{URL::to('restaurants/20')}} window.location.href = "{{URL::to('restaurants/20')}}"--}}
            }
    }
//    $(".request_accept").on("click", function(e){
//
//        e.stopPropagation();
//    });
    $(".request_reject").on("click", function(e){

        e.stopPropagation();
    });
</script>
