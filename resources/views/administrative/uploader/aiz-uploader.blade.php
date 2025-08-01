
<div class="modal fade" id="aizUploaderModal"  data-bs-backdrop="static"  data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-adaptive  modal-xl" role="document">
		<div class="modal-content h-100">
			<div class="modal-header pb-2 bg-light">
				<div class="uppy-modal-nav">
					<ul class="nav nav-tabs border-0"  role="tablist">
						<li class="nav-item" role="presentation">
							<a class="nav-link active" data-bs-toggle="tab" href="#aiz-select-file" role="tab" aria-selected="true">Select File</a>
						</li>
						<li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#aiz-upload-new" role="tab" aria-selected="false" tabindex="-1">Upload New</a>
						</li>
					</ul>
				</div>
                <button type="button" class="btn-close" style="margin-right: 0px" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="tab-content h-100">
					<div class="tab-pane active h-100" id="aiz-select-file">
						<div class="aiz-uploader-filter pt-1 pb-3 border-bottom mb-4">
							<div class="row align-items-center gutters-5 gutters-md-10 position-relative">
								<div class="col-md-3">
									<div class="">
										<select class="form-select aiz-selectpicker" name="aiz-uploader-sort">
											<option value="newest" selected>Sort by newest</option>
											<option value="oldest">Sort by oldest</option>
											<option value="smallest">Sort by smallest</option>
											<option value="largest">Sort by largest</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-check pt-1">
										<input type="checkbox" class="form-check-input" name="aiz-show-selected" id="aiz-show-selected" name="stylishRadio">
										<label class="form-check-label" for="aiz-show-selected">
											Selected Only
										</label>
									</div>
								</div>
								<div class="col-md-3 ml-auto mr-0 position-static">
									<div class="aiz-uploader-search text-right">
										<input type="text" class="form-control form-control-xs" name="aiz-uploader-search" placeholder="Search your files..">
									</div>
								</div>
							</div>
						</div>
						<div class="aiz-uploader-all clearfix c-scrollbar-light">
							<div class="align-items-center d-flex h-100 justify-content-center w-100">
								<div class="text-center">
									<h3>No files found</h3>
								</div>
							</div>
						</div>
					</div>

					<div class="tab-pane h-100" id="aiz-upload-new">
						<div id="aiz-upload-files" class="h-100">
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer justify-content-between bg-light">
				<div class="flex-grow-1 overflow-hidden d-flex">
					<div class="pr-3" style="margin-right: 20px;">
						<strong><div class="aiz-uploader-selected">0 File selected</div></strong>
						<a class="btn-link text-danger  p-0 aiz-uploader-selected-clear">Clear</a>
					</div>
					<div class="mb-0 ml-3">
						<button type="button" class="btn btn-secondary btn-rounded waves-effect waves-light" id="uploader_prev_btn">Prev</button>
						<button type="button" class="btn btn-secondary btn-rounded waves-effect waves-light" id="uploader_next_btn">Next</button>
					</div>
				</div>
				<button type="button" class="btn btn-primary btn-rounded waves-effect waves-light" data-toggle="aizUploaderAddSelected">
                    <i class="ri-add-fill align-middle mr-2"></i> Add Files
                </button>
			</div>
		</div>
	</div>
</div>
