@extends('administrative.layouts.master')
@section('page-css')
@endsection
@section('content')
    @include('administrative.layouts.partial._breadcrump', [
        'breadcrumbs' => [
            ['name' => 'About', 'link' => route('administrative.company-profile.at-a-glance.list')],
            ['name' => 'Company Profile', 'link' => route('administrative.company-profile.at-a-glance.list')],
            ['name' => 'At a Glance', 'link' => route('administrative.company-profile.at-a-glance.list')],
            ['name' => 'List'],
        ],
    ])
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">At a Glance List</h4>
                        <div>
                            <a href="{{ route('administrative.company-profile.at-a-glance.create') }}"
                                class="btn btn-primary btn-sm">
                                <i class="ri-add-fill align-middle mr-2"></i>
                                Add New
                            </a>
                        </div>
                    </div>

                    <x-page-info.add-edit-form title="Page Information" module="company-profile" page="landing-page"
                        section="at-a-glance" :pageInfo="$pageInfo" actionRoute="{{ route('administrative.page.info') }}" />

                    <p class="card-title-desc"></p>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Year</th>
                                <th>Description English</th>
                                <th>Description Bangla</th>
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
                    ajax: "{{ route('administrative.company-profile.at-a-glance.data') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'year',
                            name: 'year',
                        },
                        {
                            data: 'description_english',
                            name: 'description_english',
                        },
                        {
                            data: 'description_bangla',
                            name: 'description_bangla',
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
            let url = "{{ route('administrative.company-profile.at-a-glance.destroy', ':id') }}";
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
