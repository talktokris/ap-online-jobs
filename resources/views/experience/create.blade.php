@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            <h1 class="text-center text-warning">{{__('Add Experience')}}</h1>
            <div class="card auth-form">
                <div class="card-header"></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('experience.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="employer_name">{{ __('Employer Name') }}</label>
                                    <input id="employer_name" type="text" class="form-control{{ $errors->has('employer_name') ? ' is-invalid' : '' }}" name="employer_name" value="{{ old('employer_name') }}" placeholder="Employers Name">
        
                                    @if ($errors->has('employer_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('employer_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="country">{{ __('Country') }}</label>
                                    <select name="country" id="country" class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}">
                                        <option value="">--Select Country--</option>
                                        @foreach ($countrys as $country)
                                            <option value="{{$country->id}}" {{$country->id == old('country') ? 'selected':''}}>{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="from_date">{{ __('From Date') }}</label>
                                    <input id="from_date" type="date" class="form-control{{ $errors->has('from_date') ? ' is-invalid' : '' }}" name="from_date" value="{{ old('from_date') }}" placeholder="From Date">
        
                                    @if ($errors->has('from_date'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('from_date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="to_date">{{ __('To Date') }}</label>
                                    <input id="to_date" type="date" class="form-control{{ $errors->has('to_date') ? ' is-invalid' : '' }}" name="to_date" value="{{ old('to_date') }}" placeholder="To Date">
        
                                    @if ($errors->has('to_date'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('to_date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="remark">{{ __('Remark') }}</label>
                                    <input id="remark" type="text" class="form-control{{ $errors->has('remark') ? ' is-invalid' : '' }}" name="remark" value="{{ old('remark') }}" placeholder="Remark">
        
                                    @if ($errors->has('remark'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('remark') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                         
                            <div class="col-md-12">
                                <div class="form-group mb-0 text-center">
                                    <button type="submit" class="btn btn-warning btn-block">
                                        {{ __('Save Information') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
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