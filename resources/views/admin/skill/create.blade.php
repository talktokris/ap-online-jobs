@extends('admin.layouts.master')
@section('content')
    <div class="title-block">
        <h1 class="title"> Add Skill <a class="btn btn-primary btn-sm" href="{{route('admin.skill.index')}}">Back</a></h1>
    </div>
    <section class="section">
        <div class="row sameheight-container">
            <div class="col-md-6">
                <div class="card card-block sameheight-item" style="height: 307px;"> 
                    <form method="POST" action="{{ route('admin.skill.store') }}">
                        @csrf

                        <div class="form-group">
                            <select class="form-control" id="for" name="for" required>
                                <option value="">--Skill For--</option>
                                <option value="dm">Domestic Maid</option>
                                <option value="gw">General Worker</option>
                            </select>
                            @if ($errors->has('for'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('for') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="Skill Name" required>
                            
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="type" name="type" required>
                                <option value="">--Skill Type--</option>
                                <option value="Skill">Skill</option>
                                <option value="Language">Language</option>
                                <option value="Do & Do not">Do and Don't</option>
                            </select>
                            @if ($errors->has('type'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('for') }}</strong>
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