@extends('admin.layouts.master')
@section('content')
    <div class="title-block">
        <h1 class="title"> <a class="btn btn-primary btn-sm" href="{{route('admin.sector.index')}}">Back</a></h1>
    </div>
    <section class="section">
        <div class="row sameheight-container">
            <div class="col-md-6">
                <div class="card card-block sameheight-item" style="height: 307px;"> 
                    <h1>{{$sector->name}}</h1>
                    <h5>Sub Sectors</h5>
                    <ul>
                        @foreach ($sector->sub_sectors as $sub_sector)
                            <li>{{$sub_sector->name}} <a class="btn btn-info btn-sm" href="{{route('admin.subSector.edit', $sub_sector->id)}}">Edit</a> 
                                <a class="btn btn-danger btn-sm" href="{{route('admin.subSector.destroy', $sub_sector->id)}}"
                                    onclick="event.preventDefault();
                                    document.getElementById('destroy-form-{{$sub_sector->id}}').submit();">
                                    {{ __('Delete') }}
                                </a>
                                <form id="destroy-form-{{$sub_sector->id}}" action="{{route('admin.subSector.destroy', $sub_sector->id)}}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card card-block sameheight-item" style="height: 307px;"> 
                    <h5>Add Sub Sector</h5>
                    <form method="POST" action="{{ route('admin.subSector.store') }}">
                        @csrf
                        <input type="hidden" name="sector_id" value="{{$sector->id}}">
                        <div class="form-group">
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="Sector Name" required>

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