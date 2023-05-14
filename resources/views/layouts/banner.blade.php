@if (Route::currentRouteName() == 'maids' || Route::currentRouteName() == 'maids.search')
<section class="banner" style="min-height: 350px;background-size: 108%;background:url(/images/domestic.png) no-repeat fixed;">
@elseif(Route::currentRouteName() == 'workers' || Route::currentRouteName() == 'workers.search')
<section class="banner" style="min-height: 350px;background-size: 108%;background:linear-gradient(0deg,rgba(0,0,0,0.3),rgba(0,0,0,0.3)),url(/images/general.png) no-repeat fixed;">
@else
<section class="banner" style="min-height: 220px; background: url(/images/banner.jpg) no-repeat center center fixed;background-size: cover;">
@endif

        {{-- @include('layouts.topbar') --}}

        <!--  banner body and search   -->
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="margin-top: 88px;">
                    <h1 class="mt-3 text-white text-uppercase text-center" style="border-bottom: 1px solid;">
                        @if (Route::currentRouteName() == 'maids' || Route::currentRouteName() == 'maids.search')
                            Domestic Maids
                            <!-- <span class="pull-right"><small style="font-size: 14px;">Registered:</small> <span class="counter">{{$total_maids}}</span></span> -->
                        @elseif(Route::currentRouteName() == 'workers' || Route::currentRouteName() == 'workers.search')
                            Foreign Workers
                            <!-- <span class="pull-right"><small style="font-size: 14px;">Registered:</small> <span class="counter">{{$total_workers}}</span></span> -->
                        @endif
                    </h1>
                </div>
                <div class="col-md-12">
                    <div class="banner_tranparent">
                        <form method="POST" action="{{route($page.'.search')}}">
                            @csrf
                            <div class="form-row justify-content-center ext-box">
                                <div class="col-2">
                                    <label class="sr-only" for="religion">Religion</label>
                                    <select name="religion" id="religion" class="form-control">
                                        <option value="">-- Religion --</option>
                                        @foreach ($religions as $religion)
                                            <option value="{{$religion->id}}" @if(isset($request->religion) && $request->religion==$religion->id){{"selected"}} @endif >{{$religion->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-2">
                                    <label class="sr-only" for="age_term">Age</label>
                                    <select name="age_term" id="age_term" class="form-control">
                                        <option value="">-- Age --</option>
                                        <option value="18-24" @if(isset($request->age_term) && $request->age_term=="18-24"){{"selected"}} @endif>18-24</option>
                                        <option value="25-35" @if(isset($request->age_term) && $request->age_term=="25-35"){{"selected"}} @endif>25-35</option>
                                        <option value="36-45" @if(isset($request->age_term) && $request->age_term=="36-45"){{"selected"}} @endif>36-45</option>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <label class="sr-only" for="gender">Gender</label>
                                    <select name="gender" id="gender" class="form-control">
                                        <option value="">-- Gender --</option>
                                        @foreach ($genders as $gender)
                                            <option value="{{$gender->id}}" @if(isset($request->gender) && $request->gender==$gender->id){{"selected"}} @endif >{{$gender->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3">
                                    <label class="sr-only" for="nationality">Nationality</label>
                                    <select name="nationality" id="nationality" class="form-control">
                                        <option value="">-- Nationality --</option>
                                        @foreach ($nationalitys as $nationality)
                                            <option value="{{$nationality->id}}" @if(isset($request->nationality) && $request->nationality==$nationality->id){{"selected"}} @endif >{{$nationality->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3">
                                <button type="submit" class="btn btn-primary text-capitalize btn-block">Search {{$page}}</button>
                                </div>
                            </div>
                        </form>
                    </div><!--  banner trand end   -->
                </div>
            </div><!--  /.row  -->
        </div><!--  /.container  -->
    </section>