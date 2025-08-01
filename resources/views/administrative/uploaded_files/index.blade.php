@extends('administrative.layouts.master')
@section('page-css')
@endsection
@section('content')
    @include('administrative.layouts.partial._breadcrump', [
        'breadcrumbs' => [
            ['name' => 'Account Settings', 'link' => route('administrative.uploaded-files')],
            ['name' => 'File Manager', 'link' => route('administrative.uploaded-files')],
            ['name' => 'List'],
        ],
    ])

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">All uploaded files</h4>
                        <div>
                            <a href="{{ route('administrative.uploaded-files.create') }}" class="btn btn-primary btn-sm">
                                <i class="ri-add-fill align-middle mr-2"></i>
                                Upload New File
                            </a>
                        </div>
                    </div>
                    <hr>
                    <form id="sort_uploads" style="margin-bottom: 10px;" action="">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <h5 class="mb-0 h6">All files</h5>
                            </div>
                            <div class="col-md-3 ms-auto">
                                <select class="form-select form-select" name="sort" onchange="sort_uploads()">
                                    <option value="newest" @if ($sort_by == 'newest') selected @endif>Sort by newest
                                    </option>
                                    <option value="oldest" @if ($sort_by == 'oldest') selected @endif>Sort by oldest
                                    </option>
                                    <option value="smallest" @if ($sort_by == 'smallest') selected @endif>Sort by
                                        smallest</option>
                                    <option value="largest" @if ($sort_by == 'largest') selected @endif>Sort by
                                        largest</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control form-control" name="search"
                                    placeholder="Search your files" value="{{ $search }}">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary btn">Search</button>
                            </div>
                        </div>
                    </form>

                    <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 row-cols-xl-6 g-3">
                        @foreach ($all_uploads as $key => $file)
                            @php
                                $file_name = $file->file_original_name ?? 'Unknown';
                            @endphp

                            <div class="col">
                                <div class="aiz-file-box">
                                    <div class="dropdown dropdown-file">
                                        <a class="dropdown-toggle dropdown-link" href="#" role="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-2-fill"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a href="javascript:void(0)" class="dropdown-item"
                                                    onclick="detailsInfo(this)" data-id="{{ $file->id }}">
                                                    <i class="ri-information-line me-2"></i>
                                                    <span>Details Info</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ asset($file->file_name) }}" target="_blank"
                                                    download="{{ $file_name }}.{{ $file->extension }}"
                                                    class="dropdown-item">
                                                    <i class="ri-chat-download-line me-2"></i>
                                                    <span>Download</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)" class="dropdown-item" onclick="copyUrl(this)"
                                                    data-url="{{ asset($file->file_name) }}">
                                                    <i class="ri-file-copy-line me-2"></i>
                                                    <span>Copy Link</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)" class="dropdown-item confirm-alert"
                                                    data-href="{{ route('administrative.uploaded-files.destroy', $file->id) }}"
                                                    data-target="#delete-modal">
                                                    <i class="ri-delete-bin-line me-2"></i>
                                                    <span>Delete</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="card-file card aiz-uploader-select c-default"
                                        title="{{ $file_name }}.{{ $file->extension }}">
                                        <div class="card-file-thumb">
                                            @if ($file->type == 'image')
                                                <img src="{{ asset($file->file_name) }}" class="img-fit">
                                            @elseif($file->type == 'video')
                                                <div class="uppy-DashboardItem-previewInnerWrap"
                                                    style="background-color: #556ee6;"><i class="ri-video-fill"></i></div>
                                            @else
                                                <div class="uppy-DashboardItem-previewInnerWrap"
                                                    style="background-color: #f46a6a;"><i class="ri-file-line"></i></div>
                                            @endif
                                        </div>
                                        <div class="card-body">
                                            <h6 class="d-flex">
                                                <span class="text-truncate title">{{ $file_name }}</span>
                                                <span class="ext">.{{ $file->extension }}</span>
                                            </h6>
                                            <p>{{ formatBytes($file->file_size) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="aiz-pagination mt-3">
                        {{ $all_uploads->appends(request()->input())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="delete-modal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <p class="mt-1">Are you sure you want to delete this file?</p>
                    <button type="button" class="btn btn-light mt-2" data-bs-dismiss="modal">Cancel</button>
                    <a href="#" class="btn btn-primary mt-2 confirm-link">Delete</a>
                </div>
            </div>
        </div>
    </div>

    <div id="info-modal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-right">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h6">File Info</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body c-scrollbar-light position-relative" id="info-modal-content">
                    <div class="c-preloader text-center position-absolute top-50 start-50 translate-middle">
                        <i class="las la-spinner la-spin la-3x opacity-70"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-js')
    <script type="text/javascript">
        function detailsInfo(e) {
            $('#info-modal-content').html(
                '<div class="c-preloader text-center absolute-center"><i class="las la-spinner la-spin la-3x opacity-70"></i></div>'
            );
            var id = $(e).data('id')
            $('#info-modal').modal('show');
            $.post("{{ route('administrative.uploaded-files.info') }}", {
                    _token: AIZ.data.csrf,
                    id: id
                },
                function(data) {
                    $('#info-modal-content').html(data);
                    // console.log(data);
                });
        }

        function copyUrl(e) {
            var url = $(e).data('url');
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val(url).select();
            try {
                document.execCommand("copy");
                showToast({
                    eleWrapper: '#hexa-toaster',
                    msg: 'Link copied to clipboard',
                    // error warning info success
                    theme: 'success',
                    closeButton: true,
                    autoClose: true
                });
            } catch (err) {
                showToast({
                    eleWrapper: '#hexa-toaster',
                    msg: 'Oops, unable to copy',
                    // error warning info success
                    theme: 'error',
                    closeButton: true,
                    autoClose: true
                });
            }
            $temp.remove();
        }

        function sort_uploads(el) {
            $('#sort_uploads').submit();
        }
    </script>
@endsection
