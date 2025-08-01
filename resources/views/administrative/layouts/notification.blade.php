@if(count($result) > 0)
@foreach($result as $notify)
<a href="{{route('administrative.approval.show',base64_encode($notify->id))}}" class="text-reset notification-item">
    <div class="d-flex">
        <img src="{{asset($notify->createdby->thumbnail)}}"
        class="me-3 rounded-circle avatar-xs" alt="user-pic">
        <div class="flex-1">
            <h6 class="mb-1">{{$notify->createdby->name}}</h6>
            <div class="font-size-12 text-muted">
                <p class="mb-1">{{$notify->message}}</p>
                <p class="mb-0"><i class="mdi mdi-clock-outline"></i> {{\App\Models\User::getTimeAgo(strtotime($notify->notify_datetime))}}</p>
            </div>
        </div>
    </div>
</a>
@endforeach
@else
<p class="text-center"> No Notification!</p>
@endif
