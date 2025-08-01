<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Dashboard</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('administrative.dashboard') }}">Dashboard
                        </a>
                    </li>
                    @if (isset($breadcrumbs) && is_array($breadcrumbs))
                        @foreach ($breadcrumbs as $breadcrumb)
                            <li class="breadcrumb-item {{ $loop->last ? 'active' : '' }}"
                                {{ $loop->last ? 'aria-current="page"' : '' }}>
                                @if ($loop->last)
                                    {{ $breadcrumb['name'] }}
                                @else
                                    <a href="{{ $breadcrumb['link'] }}">{{ $breadcrumb['name'] }}</a>
                                @endif
                            </li>
                        @endforeach
                    @endif
                </ol>
            </div>

        </div>
    </div>
</div>
