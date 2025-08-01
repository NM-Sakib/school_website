@extends('administrative.layouts.master')
@section('page-css')

@endsection
@section('content')
@include('administrative.layouts.partial._breadcrump',['breadcrumbs' =>
[
['name' => 'Account Settings', 'link' => route('administrative.user')],
['name' => 'User', 'link' => route('administrative.user')],
['name' => 'List']
]
])
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">User List</h4>
                    @can('user_create')
                    <a href="{{route('administrative.user.create')}}" class="btn btn-primary btn-sm">
                        <i class="ri-add-fill align-middle mr-2"></i>
                        Add New
                    </a>
                    @endcan
                </div>
                <p class="card-title-desc"></p>

                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th class="disabled-sorting text-left">Action</th>
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
            ajax: "{{route('administrative.user.data')}}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'role',
                    name: 'role'
                },
                {
                    data: 'status',
                    name: 'status'
                },

                {
                    data: 'action',
                    name: 'action'
                }
            ]
        });
    });

    function deleteData(rowid) {
        let url = '{{ route("administrative.user.destroy", ":id") }}';
        url = url.replace(':id', rowid);
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#1cbb8c",
            cancelButtonColor: "#ff3d60",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                axios.delete(url).then(res => {
                    if (res.data == 'success') {
                        Swal.fire({
                            title: "Good job!",
                            text: "Delete Successfully.",
                            icon: "success",
                            timer: 2000,
                        })
                        $('#datatable').DataTable().ajax.reload(null, false);
                    }
                });
            }
        })
    }
</script>
@endsection
