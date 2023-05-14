@extends('admin.layouts.master')
@section('content')
    <div class="title-block">
        <h1 class="title"> Add State <a class="btn btn-primary btn-sm" href="{{route('admin.state.index')}}">Back</a></h1>
    </div>
    <section class="section">
        <div class="row sameheight-container">
            <div class="col-md-6">
                <div class="card card-block sameheight-item" style="height: 307px;"> 
                    <form method="POST" action="{{ route('admin.state.store') }}">
                        @csrf

                        <div class="form-group">
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="State Name" required>

                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <p><a target="_blank" href="https://en.wikipedia.org/wiki/ISO_3166-1_alpha-3">Check this link for State Code</a></p>
                            <input id="code" type="text" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" name="code" value="{{ old('code') }}" placeholder="State code" required>

                            @if ($errors->has('code'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('code') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Country</label><font color="red">*</font>
                            <select required class="form-control" name="country_id" >
                                <option selected value="">Select Country</option>
                                @foreach($country as $coun)
                                    <option value="{{$coun->id}}" >{{$coun->name}}</option>
                                @endforeach

                            </select>
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