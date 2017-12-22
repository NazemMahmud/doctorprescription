@if( count( $notifications)>0 )
    @foreach($notifications as $notification)
        <li>
            {{--<div class="col-md-12 col-xs-12 col-sm-12">--}}
                <a href="#" style="color: #000;">
                    {{--<strong>'.$row["comment_subject"].'</strong><br />--}}{{--<small><em>'.$row["comment_text"].'</em></small>--}}
                    @if( $notification->notification_type == 'request pa' )
                        <p><strong>{{ App\Doctor::where('id',$notification->from_doc_id)->first()->name }}</strong> is requested to be your <strong>Personal Assistant</strong>  </p>
                        {{--<p>{{ $notification->notification_text }} </p>--}}
                        <button class="btn btn-primary notification-accept" style="" type="submit" onclick="">Accept</button>
                        <button class="btn  notification-accept" style="margin-left:20px;" type="submit" onclick="">Reject</button>
                    @elseif( $notification->notification_type == 'request assistant' )
                        <p><strong>{{ App\Doctor::where('id',$notification->from_doc_id)->first()->name }}</strong> is requested to be your <strong>Assistant Doctor</strong>  </p>
                        <button class="btn btn-primary notification-accept" style="" type="submit" onclick="">Accept</button>
                        <button class="btn  notification-accept" style="margin-left:20px;" type="submit" onclick="">Reject</button>
                    @endif

                </a>

            {{--</div>--}}
            {{--<div class="col-md-12 col-xs-12 col-sm-12">--}}


            {{--</div>--}}


        </li>
        <li class="divider"></li>
    @endforeach

@elseif(count( $patients)<=0)
    <li><a href="#" class="text-bold text-italic">No Notification Found</a></li>
@endif

<script>
//    function fill(Value) {
//        $('#which_doc').val(Value);         //Assigning value to "search" div in "search.php" file.
//        $('#doctors_name').hide(); //Hiding "display" div in "search.php" file.
//
//    }
</script>
