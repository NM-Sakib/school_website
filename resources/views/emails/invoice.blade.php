<p>Dear {{$data['name']}},</p>
<p>{{$data['message']}}</p>
@if(isset($data['link']))
<strong><a href="{{$data['link']}}">{{$data['link']}}</a></strong>
@endif
<p>
    Should you have any questions, feel free to reach out.
</p>
<p>
    Best regards,
</p>
<p>
    Kyro
</p>
