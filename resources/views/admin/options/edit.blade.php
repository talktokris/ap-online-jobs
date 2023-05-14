@extends('admin.layouts.master')
@section('content')
    <div class="title-block">
        <h1 class="title"> Edit Option <a class="btn btn-primary btn-sm" href="{{route('admin.options.index')}}">Back</a></h1>
    </div>
    <section class="section">
        <div class="row sameheight-container">
            <div class="col-md-6">
                <div class="card card-block sameheight-item" style="height: 307px;"> 
                    <form method="POST" action="{{ route('admin.options.update', $option->id) }}">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            <select name="type" id="type" class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" required>
                                <option> --Select Type-- </option>
                                @foreach ($types as $type)
                                    <option value="{{ $type }}" {{ $type == $option->type ? 'selected' : '' }}>{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $option->name }}" placeholder="Option Name" required>

                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
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