@extends('administrative.layouts.master')
@section('page-css')
@endsection
@section('content')
    @include('administrative.layouts.partial._breadcrump', [
        'breadcrumbs' => [
            ['name' => 'Notices', 'link' => route('administrative.notices')],
            ['name' => 'List'],
        ],
    ])
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Notices List</h4>
                        <div>
                            <a href="{{ route('administrative.notices.create') }}"
                                class="btn btn-primary btn-sm">
                                <i class="ri-add-fill align-middle mr-2"></i>
                                Add New Notice
                            </a>
                        </div>
                    </div>

                    <p class="card-title-desc"></p>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>File</th>
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
            $(function() {
                var table = $('#datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    stateSave: true,
                    ajax: "{{ route('administrative.notices.data') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'title',
                            name: 'title',
                        },
                        {
                            data: 'description',
                            name: 'description',
                        },
                        {
                            data: 'file',
                            name: 'file',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'status',
                            name: 'status',
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        }
                    ],
                });
            });
        });

        function deleteData(rowid) {
            let url = "{{ route('administrative.notices.destroy', ':id') }}";
            url = url.replace(':id', rowid);
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    axios.delete(url).then(res => {
                        if (res.data == 'success') {
                            Swal.fire({
                                title: "",
                                text: "Delete Successfully.",
                                icon: "success",
                                timer: 2000,
                            });
                            $('#datatable').DataTable().ajax.reload(null, false);
                        }
                    });
                }
            })
        }
    </script>
@endsection 