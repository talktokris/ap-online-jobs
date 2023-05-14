@extends('admin.layouts.master')
@section('content')
    <div class="title-block">
        <h1 class="title"> Edit File <a class="btn btn-primary btn-sm" href="{{route('admin.downloads.index')}}">Back</a></h1>
    </div>
    <section class="section">
        <div class="row sameheight-container">
            <div class="col-md-6">
                <div class="card card-block sameheight-item" style="height: 307px;"> 
                    <form method="POST" action="{{ route('admin.downloads.update', $downloads->id) }}">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ $downloads->title }}" placeholder="File title" required="required">

                            @if ($errors->has('title'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <input id="file_name" type="file" class="form-control-file{{ $errors->has('file_name') ? ' is-invalid' : '' }}" name="file_name">
                            <p class="text-left small">Supported file format PDF, JPG, JPEG and PNG. Maximum file size: 1MB</p>
                            @if($downloads->file_name)
                                <a class="btn btn-sm btn-success mt-2" target="_blank" href="{{asset('storage/downloads/'.$downloads->file_name)}}">View File</a>
                            @endif
                            @if ($errors->has('file_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('file_name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <select name="user_type" id="user_type" class="form-control" required="required">
                                <option value="">-- Select User Type --</option>
                                <option value="agent" {{$downloads->user_type == 'agent' ? 'selected' : ''}}>For Agent</option>
                                <option value="emp" {{$downloads->user_type == 'emp' ? 'selected' : ''}}>For Employer</option>
                            </select>

                            @if ($errors->has('user_type'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('user_type') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <textarea id="comments" class="form-control{{ $errors->has('comments') ? ' is-invalid' : '' }}" name="comments" placeholder="Comments">{{ $downloads->comments }}</textarea>

                            @if ($errors->has('comments'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('comments') }}</strong>
                                </span>
                            @endif
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