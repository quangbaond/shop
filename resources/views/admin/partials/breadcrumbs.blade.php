@if (count($breadcrumbs))
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-end">
                    <ol class="breadcrumb">
                        @foreach ($breadcrumbs as $breadcrumb)
                            @if ($breadcrumb->url && !$loop->last)
                                <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
                            @else
                                <li class="breadcrumb-item active">{{ $breadcrumb->title }}</li>
                            @endif
                        @endforeach
                    </ol>
                </div>
                <h4 class="page-title">{{  $breadcrumb->title ?? env('APP_NAME') }}</h4>
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div>
@endif
