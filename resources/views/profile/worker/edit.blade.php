@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if(Session::has('message'))
        <div class="col-md-12">
            <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show" role="alert">
                <strong>{{ Session::get('message') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        @endif
        <div class="col-md-8 col-md-offset-2">
            <div class="card mt-3">
                <div class="card-header">
                    <h1 class="text-center">{{$profile->name}}</h1>
                    <h3 class="text-center mt-2">Edit Information</h3>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update', $profile->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">{{ __('Name') }}</label>
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $profile->name }}" placeholder="Name">
        
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">{{ __('Phone') }}</label>
                                    <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ $profile->phone }}" placeholder="Phone">
        
                                    @if ($errors->has('phone'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gender">{{ __('Gender') }}</label>
                                    <select name="gender" id="gender" class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}">
                                        <option value="">--Select Gender--</option>
                                        @foreach ($genders as $gender)
                                            <option value="{{$gender->id}}" {{$gender->id == $profile->gender ? 'selected':''}}>{{$gender->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('gender'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('gender') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nationality">{{ __('Nationality') }}</label>
                                    <select name="nationality" id="nationality" class="form-control{{ $errors->has('nationality') ? ' is-invalid' : '' }}">
                                        <option value="">--Select Nationality--</option>
                                        @foreach ($nationalitys as $nationality)
                                            <option value="{{$nationality->id}}" {{$nationality->id == $profile->nationality ? 'selected':''}}>{{$nationality->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="religion">{{ __('Religion') }}</label>
                                    <select name="religion" id="religion" class="form-control{{ $errors->has('religion') ? ' is-invalid' : '' }}" required>
                                        <option value="">--Select Religion--</option>
                                        @foreach ($religions as $religion)
                                            <option value="{{$religion->id}}" {{$religion->id == $profile->religion ? 'selected':''}}>{{$religion->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('religion'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('religion') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="native_language">{{ __('Native Language') }}</label>
                                    <select name="native_language" id="native_language" class="form-control{{ $errors->has('native_language') ? ' is-invalid' : '' }}">
                                        <option value="">--Select Native Language--</option>
                                        @foreach ($languages as $language)
                                            <option value="{{$language->id}}" {{$language->id == $profile->native_language ? 'selected':''}}>{{$language->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('native_language'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('native_language') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="other_languages">{{ __('Other Languages') }}</label>
                                    <input id="other_languages" type="text" class="form-control{{ $errors->has('other_languages') ? ' is-invalid' : '' }}" name="other_languages" value="{{ $profile->other_languages }}" placeholder="Other Languages">
        
                                    @if ($errors->has('other_languages'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('other_languages') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date_of_birth">{{ __('Date of Birth') }}</label>
                                    <input id="date_of_birth" type="date" class="form-control{{ $errors->has('date_of_birth') ? ' is-invalid' : '' }}" name="date_of_birth" value="{{ $profile->date_of_birth }}" placeholder="Date of Birth">
        
                                    @if ($errors->has('date_of_birth'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('date_of_birth') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="marital_status">{{ __('Marital Status') }}</label>
                                    <select name="marital_status" id="marital_status" class="form-control{{ $errors->has('marital_status') ? ' is-invalid' : '' }}">
                                        <option value="">--Select Marital Status--</option>
                                        @foreach ($marital_statuses as $marital_status)
                                            <option value="{{$marital_status->id}}" {{$marital_status->id == $profile->marital_status ? 'selected':''}}>{{$marital_status->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('marital_status'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('marital_status') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="height">{{ __('Height (CM)') }}</label>
                                    <input id="height" type="text" class="form-control{{ $errors->has('height') ? ' is-invalid' : '' }}" name="height" value="{{ $profile->height }}" placeholder="Height">
        
                                    @if ($errors->has('height'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('height') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="weight">{{ __('Weight (Pound)') }}</label>
                                    <input id="weight" type="text" class="form-control{{ $errors->has('weight') ? ' is-invalid' : '' }}" name="weight" value="{{ $profile->weight }}" placeholder="Weight">
        
                                    @if ($errors->has('weight'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('weight') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="highest_education">{{ __('Highest Education') }}</label>
                                    <input id="highest_education" type="text" class="form-control{{ $errors->has('highest_education') ? ' is-invalid' : '' }}" name="highest_education" value="{{ $profile->highest_education }}" placeholder="Highest Education">
        
                                    @if ($errors->has('highest_education'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('highest_education') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="skill_level">{{ __('Skill Level') }}</label>
                                    <select name="skill_level" id="skill_level" class="form-control{{ $errors->has('skill_level') ? ' is-invalid' : '' }}">
                                        <option value="">--Select Skill Level--</option>
                                        @foreach ($skill_levels as $skill_level)
                                            <option value="{{$skill_level->id}}" {{$skill_level->id == $profile->skill_level ? 'selected':''}}>{{$skill_level->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('skill_level'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('skill_level') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="work_on_off_days_with_compensation">{{ __('Work on off days with compensation') }}</label>
                                    <select name="work_on_off_days_with_compensation" id="work_on_off_days_with_compensation" class="form-control{{ $errors->has('work_on_off_days_with_compensation') ? ' is-invalid' : '' }}">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                    @if ($errors->has('work_on_off_days_with_compensation'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('work_on_off_days_with_compensation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="able_to_handle_pork">{{ __('Able to handle pork') }}</label>
                                    <select name="able_to_handle_pork" id="able_to_handle_pork" class="form-control{{ $errors->has('able_to_handle_pork') ? ' is-invalid' : '' }}">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                    @if ($errors->has('able_to_handle_pork'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('able_to_handle_pork') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="able_to_gardening">{{ __('Able to gardening') }}</label>
                                    <select name="able_to_gardening" id="able_to_gardening" class="form-control{{ $errors->has('able_to_gardening') ? ' is-invalid' : '' }}">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                    @if ($errors->has('able_to_gardening'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('able_to_handle_pork') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="able_to_care_dog_cat">{{ __('Able to care dog/cat') }}</label>
                                    <select name="able_to_care_dog_cat" id="able_to_care_dog_cat" class="form-control{{ $errors->has('able_to_care_dog_cat') ? ' is-invalid' : '' }}">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                    @if ($errors->has('able_to_care_dog_cat'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('able_to_care_dog_cat') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="able_to_simple_sewing">{{ __('Able to simple sewing') }}</label>
                                    <select name="able_to_simple_sewing" id="able_to_simple_sewing" class="form-control{{ $errors->has('able_to_simple_sewing') ? ' is-invalid' : '' }}">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                    @if ($errors->has('able_to_simple_sewing'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('able_to_simple_sewing') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="able_to_wash_car">{{ __('Able to wash car') }}</label>
                                    <select name="able_to_wash_car" id="able_to_wash_car" class="form-control{{ $errors->has('able_to_wash_car') ? ' is-invalid' : '' }}">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                    @if ($errors->has('able_to_wash_car'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('able_to_wash_car') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="able_to_eat_pork">{{ __('Able to eat pork') }}</label>
                                    <select name="able_to_eat_pork" id="able_to_eat_pork" class="form-control{{ $errors->has('able_to_eat_pork') ? ' is-invalid' : '' }}">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                    @if ($errors->has('able_to_eat_pork'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('able_to_eat_pork') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="able_to_care_infants">{{ __('Able to care infants') }}</label>
                                    <select name="able_to_care_infants" id="able_to_care_infants" class="form-control{{ $errors->has('able_to_care_infants') ? ' is-invalid' : '' }}">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                    @if ($errors->has('able_to_care_infants'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('able_to_care_infants') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="able_to_care_elderly">{{ __('Able to care elderly') }}</label>
                                    <select name="able_to_care_elderly" id="able_to_care_elderly" class="form-control{{ $errors->has('able_to_care_elderly') ? ' is-invalid' : '' }}">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                    @if ($errors->has('able_to_care_elderly'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('able_to_care_elderly') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="able_to_do_general_housework">{{ __('Able to do general housework') }}</label>
                                    <select name="able_to_do_general_housework" id="able_to_do_general_housework" class="form-control{{ $errors->has('able_to_do_general_housework') ? ' is-invalid' : '' }}">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                    @if ($errors->has('able_to_do_general_housework'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('able_to_do_general_housework') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="able_to_cook">{{ __('Able to cook') }}</label>
                                    <select name="able_to_cook" id="able_to_cook" class="form-control{{ $errors->has('able_to_cook') ? ' is-invalid' : '' }}">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                    @if ($errors->has('able_to_cook'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('able_to_cook') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="image">{{ __('Half Image') }}</label>
                                            <input onchange="previewFile('#image_preview', '#image')" id="image" type="file" class="form-control-file{{ $errors->has('image') ? ' is-invalid' : '' }}" name="image">
                                            <p class="text-danger">To get best view, upload a square size image and must be less than 250KB</p>
                                            <img id="image_preview" style="width: 100px;" src="{{$profile->image != '' ? asset('storage/'.$profile->image) :  asset('images/avatar.jpg')}}" class="img-thumbnail" height="">
                
                                            @if ($errors->has('image'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('image') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="full_image">{{ __('Full Image') }}</label>
                                            <input onchange="previewFile('#full_image_preview','#full_image')" id="full_image" type="file" class="form-control-file{{ $errors->has('full_image') ? ' is-invalid' : '' }}" name="full_image">
                                            <p class="text-danger">To get best view, upload a square size image and must be less than 250KB</p>
                                            <img id="full_image_preview" style="width: 100px;" src="{{$profile->full_image != '' ? asset('storage/'.$profile->full_image) :  asset('images/avatar_full.jpg')}}" class="img-thumbnail" height="">
                
                                            @if ($errors->has('full_image'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('full_image') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
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