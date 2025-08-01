@extends('administrative.layouts.master')
@section('page-css')

@endsection
@section('content')
@include('administrative.layouts.partial._breadcrump',['breadcrumbs' =>
[
['name' => 'Upload New File', 'link' => route('administrative.uploaded-files')],
['name' => 'Create']
]
])

<div class="row">
	<div class="col-12 mx-auto">
		<div class="card">
			<div class="card-body">
				<div class="d-flex justify-content-between">
					<h4 class="card-title">Upload New File</h4>
					<a href="{{route('administrative.uploaded-files')}}" class="btn btn-primary btn-sm">
						<i class="ri-list-check align-middle mr-2"></i>
						All files
					</a>
				</div>


					<div class="card-header">
						<h5 class="mb-0 h6">Drag & drop your files</h5>
					</div>
					<div class="card-body">
						<div id="aiz-upload-files" class="h-420px" style="min-height: 65vh">

						</div>
					</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('page-js')
<script type="text/javascript">
	$(document).ready(function() {
		AIZ.plugins.aizUppy();
	});
</script>
@endsection