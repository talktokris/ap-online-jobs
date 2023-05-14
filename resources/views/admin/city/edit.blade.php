@extends('admin.layouts.master')
@section('content')
    <div class="title-block">
        <h1 class="title"> Edit City <a class="btn btn-primary btn-sm" href="{{route('admin.city.index')}}">Back</a></h1>
    </div>
    <section class="section">
        <div class="row sameheight-container">
            <div class="col-md-6">
                <div class="card card-block sameheight-item" style="height: 307px;"> 
                    <form method="POST" action="{{ route('admin.city.update', $city->id) }}">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $city->name }}" placeholder="City Name" required>

                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <p><a target="_blank" href="https://en.wikipedia.org/wiki/ISO_3166-1_alpha-3">Check this link for State Code</a></p>
                            <input id="code" type="text" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" name="code" value="{{ $city->code }}" placeholder="State code" required>

                            @if ($errors->has('code'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('code') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Country</label><font color="red">*</font>
                            <select required class="form-control" name="state_id" >
                                <option selected value="{{$city->state->id}}">{{$city->state->name}}</option>
                                @foreach($states as $state)
                                    <option value="{{$state->id}}" >{{$state->name}}</option>
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