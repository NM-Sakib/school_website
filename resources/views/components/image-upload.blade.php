@props(['headerName', 'buttonName', 'col', 'name', 'existingImages' => [], 'fieldType' => 'history'])
@php
    $existingImages = $existingImages ? $existingImages->sortBy('serial') : [];
@endphp
<div class="d-flex justify-content-between mb-1">
    <h4 class="card-title">{{ $headerName }}</h4>
    <div>
        <a id="add-image" class="btn btn-success btn-sm mb-2"><i class="mdi mdi-plus me-2"></i> {{ $buttonName }}</a>
    </div>
</div>

<div id="image-upload-container" class="row">
    @if (isset($existingImages) && count($existingImages) > 0)
        @foreach ($existingImages as $index => $image)
            <div class="{{ $col }} mb-2 image-item">
                <input type="number" name="{{ $name }}[{{ $index }}][order]"
                    class="form-control mb-2 serial-input" value="{{ $image['order'] }}" min="1"
                    placeholder="Serial">
                <div class="input-group" data-toggle="aizuploader" data-type="image">
                    <div class="input-group-prepend">
                        <div class="input-group-text bg-soft-secondary font-weight-medium">Browse</div>
                    </div>
                    <div class="form-control file-amount">Choose File</div>
                    <input type="hidden" name="{{ $name }}[{{ $index }}][image]" class="selected-files"
                        value="{{ $image['image'] }}" required>
                </div>
                <div class="file-preview box sm"></div>
                <button type="button" class="btn btn-danger btn-sm mt-2 remove-image">Remove</button>
            </div>
        @endforeach
    @endif
</div>

@push('page-js')
    <script>
        $(document).ready(function() {
            let imageCount = "{{ isset($existingImages) ? count($existingImages) : 0 }}";

            function updateSerialNumbers() {
                $(".serial-input").each(function(index) {
                    $(this).val(index + 1);
                });
                imageCount = $(".serial-input").length;
            }

            $("#add-image").click(function() {
                imageCount++;
                const newImageHtml = `
        <div class="{{ $col }} mb-2 image-item" style="display: none;">
          <input type="number" name="{{ $name }}[${imageCount}][order]" class="form-control mb-2 serial-input" value="${imageCount}" min="1" placeholder="Serial">

          <div class="input-group" data-toggle="aizuploader" data-type="image">
            <div class="input-group-prepend">
              <div class="input-group-text bg-soft-secondary font-weight-medium">Browse</div>
            </div>
            <div class="form-control file-amount">Choose File</div>
            <input type="hidden" name="{{ $name }}[${imageCount}][image]" class="selected-files" required>
          </div>
          <div class="file-preview box sm"></div>

          <button type="button" class="btn btn-danger btn-sm mt-2 remove-image">Remove</button>
        </div>
      `;
                $("#image-upload-container").append(newImageHtml);
                $(".image-item").last().fadeIn(500);
            });

            $(document).on("click", ".remove-image", function() {
                const imageItem = $(this).closest(".{{ $col }}");
                imageItem.fadeOut(500, function() {
                    imageItem.remove();
                    updateSerialNumbers();
                });
            });
        });
    </script>
@endpush
