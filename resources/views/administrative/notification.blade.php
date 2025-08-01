<!-- Notifications Dropdown Menu -->

<!-- <span class="dropdown-item dropdown-header">15 Notifications</span> -->
@if(count($result) > 0)

@foreach($result as $notify)

<div class="{{$loop->iteration == 1 ? '' : 'dropdown-divider'}}"></div>
<a href="{{empty($notify['action']) ? '#' : $notify['action']}}" data-id="{{$notify->id}}" class="dropdown-item notification-msgs {{$notify->is_read == '0' ? 'unread-msgs' : 'read-msgs'}} hitNotify">
    {{$notify['message']}} <br>
    <span style="font-size:.6rem" class="text-muted text-sm"> - {{\App\Models\User::getTimeAgo(strtotime($notify->created_at))}}</span>
</a>

@endforeach
@else
<p class="text-center"> No Notification!</p>
@endif