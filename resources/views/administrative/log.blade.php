@extends('administrative.layouts.master')
@section('page-css')

@endsection
@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('administrative.dashboard') }}">Dashboard</a></li>
        @php
        $link = url('/');
        @endphp

        @foreach(request()->segments() as $segment)
        @php
        $link .= "/" . request()->segment($loop->iteration);
        @endphp
        @if(rtrim(request()->route()->getPrefix(), '/') != $segment && ! preg_match('/[0-9]/', $segment))
        @if($loop->last)
        <li class="breadcrumb-item {{ $loop->last ? 'active' : '' }}" {{ $loop->last ? 'aria-current="page"' : '' }}>
            @if($loop->last)
            {{ $segment}}
            @else
            <a href="{{ $link }}">{{ $segment }}</a>
            @endif
        </li>
        @endif
        @endif
        @endforeach

    </ol>
</nav>
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
        <h4 class="mb-3 mb-md-0">System Log</h4>
    </div>
</div>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title"> </h6>
                <div class="table-responsive">
                    <table id="datatables" class="table">
                        <thead>
                            <tr>
                                <th> SL</th>
                                <th>Performed By</th>
                                <th>Event</th>
                                <th>Table/Menu Name</th>
                                <th>Previous Change</th>
                                <th>Current Change</th>
                                <th>URL</th>
                                <th>IP Address</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page-js')
<script>
    $(document).ready(function() {
        $('#datatables').DataTable({
            "aLengthMenu": [
                [10, 30, 50, -1],
                [10, 30, 50, "All"]
            ],
            "iDisplayLength": 10,
            "language": {
                search: ""
            },
            processing: true,
            serverSide: true,
            stateSave: true,
            stateSave: true,
            ajax: "{{route('administrative.system-log.data')}}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'user',
                    name: 'user'
                },
                {
                    data: 'event',
                    name: 'event'
                },
                {
                    data: 'auditable_type',
                    name: 'auditable_type'
                },
                {
                    data: 'old_values',
                    name: 'old_values'
                },
                {
                    data: 'new_values',
                    name: 'new_values'
                },
                {
                    data: 'url',
                    name: 'url'
                },
                {
                    data: 'ip_address',
                    name: 'ip_address'
                }
            ]
        });
    });
</script>
@endsection