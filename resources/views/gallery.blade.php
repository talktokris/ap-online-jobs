@extends('layouts.app')
@section('content')
<div class="container-fluid bg-dark">
    {{-- @include('layouts.topbar') --}}
</div>
<div class="container py-5" style="margin-top:55px">
        <div class="row mt-3">
            <div class="col-md-12">
                <h1 class="text-center">Gallery</h1>
            </div>
            @foreach ($images as $image)
            <div class="col-4 mb-2">
                <div class="card" id="lightgallery">
                    <a href="{{ asset('storage/gallery/'. $image->image_name) }}" data-lightbox="roadtrip">
                    <img class="card-img-top" src="{{ asset('storage/gallery/'. $image->image_name) }}" alt="{{ $image->caption }}">
                    </a>
                    <div class="card-body">
                        <p class="card-text text-center">{{$image->caption}}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div><!--/.row-->
    </div><!--/.container-->
@endsection
@section('script')
<script>
    lightbox.option({
      'resizeDuration': 200,
      'wrapAround': true
    })
</script>
@endsection
