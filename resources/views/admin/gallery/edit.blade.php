@extends('admin.layouts.master')
@section('content')
    <div class="title-block">
        <h1 class="title"> Add Image <a class="btn btn-primary btn-sm" href="{{route('admin.gallery.index')}}">Back</a></h1>
    </div>
    <section class="section">
        <div class="row sameheight-container">
            <div class="col-md-6">
                <div class="card card-block sameheight-item" style="height: 307px;"> 
                    <form method="POST" action="{{ route('admin.gallery.update', $gallery->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="image">Select Image</label>
                            <input type="file" id="image" onchange="previewFile('#image_preview','#image')" class="form-control-file" id="image" name="image">

                            <p class="text-short-mes">Supported file format JPG, PNG. Maximum file size: 1MB</p>
                            <img id="image_preview" style="width: 100px;" src="{{ asset('storage/gallery/'. $gallery->image_name)}}" class="img-thumbnail" height="">
                        </div>
                        <div class="form-group">
                            <input id="caption" type="text" class="form-control{{ $errors->has('caption') ? ' is-invalid' : '' }}" name="caption" value="{{ $gallery->caption }}" placeholder="Caption" required>

                            @if ($errors->has('caption'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('caption') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="status" name="status" value="1" {{$gallery->status == 1 ? 'checked' : ''}}>
                            <label class="custom-control-label" for="status">Show in Gallery</label>
                        </div>

                        <div class="form-group mb-0 text-center">
                            <button type="submit" class="btn btn-warning btn-block">
                                {{ __('Save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('javascript')
<script>
    function previewFile(preview, source) {
        var preview = document.querySelector(preview);
        var file    = document.querySelector(source).files[0];
        var reader  = new FileReader();

        reader.onloadend = function () {
            preview.src = reader.result;
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "";
        }
        console.log(preview.src);
    }
</script>
@endsection