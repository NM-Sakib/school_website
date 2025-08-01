@extends('administrative.layouts.master')
@section('page-css')

@endsection
@section('content')
@include('administrative.layouts.partial._breadcrump',['breadcrumbs' =>
[
['name' => 'Account Settings', 'link' => route('administrative.permission')],
['name' => 'Permission', 'link' => route('administrative.permission')],
['name' => 'list']
]
])
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">Permission</h4>
                    @can('permission_create')
                    <a href="{{route('administrative.permission.create')}}" class="btn btn-primary btn-sm">
                        <i class="ri-list-check align-middle mr-2"></i>
                        Add New
                    </a>
                    @endcan
                </div>
                <p class="card-title-desc"></p>

                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th> SL</th>
                            <th>Name</th>
                            <th class="disabled-sorting text-left">Action</th>
                            <!-- <th class="disabled-sorting text-left" style="width: 100px">delete</th> -->
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

@endsection
@section('page-js')
<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            "aLengthMenu": [
                [10, 30, 50, -1],
                [10, 30, 50, "All"]
            ],
            "iDisplayLength": 10,
            "language": {
                search: "Search"
            },
            processing: true,
            serverSide: true,
            stateSave: true,
            ajax: "{{route('administrative.permission.data')}}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'action',
                    name: 'action'
                },
            ]
        });
    });

    function deleteData(rowid) {
        let url = '{{ route("administrative.permission.destroy", ":id") }}';
        url = url.replace(':id', rowid);
        Swal.fire({
            title: 'Do you want to delete this?',
            showCancelButton: true,
            confirmButtonText: 'Yes',
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                axios.delete(url).then(res => {
                    if (res.data == 'success') {
                        Swal.fire('Saved!', '', 'success')
                        $('#datatables').DataTable().ajax.reload(null, false);
                    }
                });
            }
        })
    }
</script>
@endsection