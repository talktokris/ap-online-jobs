@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row bg-dark">
        <div class="col-12">
            <h4 class="text-center text-white pb-3 pt-4"><span class="mr-3 text-muted">Personal</span> <span class="mr-3 text-muted">Education</span><span class="mr-3">Experience</span></h4>
        </div>
    </div>
</div>
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card auth-form mb-5">
                <div class="card-header text-center">
                    <a class="btn btn-info" href="{{route('professional.profile')}}">Skip Adding Expereince >></a>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('professionalExperience.update', $user->id) }}">
                        @csrf
                        @method('PATCH')
                        @if(count($user->professional_experiences)>0)
                            @foreach ($user->professional_experiences as $professional_experience)
                            <div class="col-md-11">
                                <div class="form-group row">
                                    <label for="designation" class="col-sm-4 col-form-label text-right">{{ __('Designation ') }}<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input id="designation" type="text" class="form-control{{ $errors->has('designation') ? ' is-invalid' : '' }}" name="designation[]" value="{{ $professional_experience->designation }}" placeholder="Designation" required>
        
                                    @if ($errors->has('designation'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('designation') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="company" class="col-sm-4 col-form-label text-right">{{ __('Company ') }}<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input id="company" type="text" class="form-control{{ $errors->has('company') ? ' is-invalid' : '' }}" name="company[]" value="{{ $professional_experience->company }}" placeholder="Company" required>
        
                                    @if ($errors->has('company'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('company') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="from" class="col-sm-4 col-form-label text-right">{{ __('From ') }}<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        {{-- <input id="from" type="date" class="form-control{{ $errors->has('from') ? ' is-invalid' : '' }}" name="from[]" value="{{ $professional_experience->from }}" placeholder="from" required> --}}
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <select class="form-control" name="from_month[]" id="">
                                                    <option value="">--Month--</option>
                                                    @for ($i = 1; $i <= 12; $i++)
                                                        <option value="{{$i}}" {{$professional_experience->from_month() == $i ? 'selected' : ''}}>{{$i}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <select class="form-control" name="from_year[]" id="">
                                                    <option value="">--Year--</option>
                                                    @for ($i = 1960; $i <= date('Y', time()); $i++)
                                                        <option value="{{$i}}" {{$professional_experience->from_year() == $i ? 'selected' : ''}}>{{$i}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
        
                                    @if ($errors->has('from'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('from') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label text-right">{{ __('Present Job?') }}</label>
                                    <div class="col-sm-8">
                                        <div class="form-check mt-2">
                                            <input type="hidden" name="is_present_job[]" value="0" />
                                            <input onchange="hideInput(this);" type="checkbox" class="form-check-input" {{ $professional_experience->is_present_job == 1 ? 'checked' : ''}} value="1" id="is_present_job">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="to" class="col-sm-4 col-form-label text-right">{{ __('To') }}</label>
                                    <div class="col-sm-8">
                                        {{-- <input id="to" type="date" class="form-control{{ $errors->has('to') ? ' is-invalid' : '' }}" name="to[]" value="{{ $professional_experience->to }}" placeholder="To"> --}}
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <select class="form-control" name="to_month[]" id="">
                                                    <option value="">--Month--</option>
                                                    @for ($i = 1; $i <= 12; $i++)
                                                        <option value="{{$i}}" {{$professional_experience->to_month() == $i ? 'selected' : ''}}>{{$i}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <select class="form-control" name="to_year[]" id="">
                                                    <option value="">--Year--</option>
                                                    @for ($i = 1960; $i <= date('Y', time()); $i++)
                                                        <option value="{{$i}}" {{$professional_experience->to_year() == $i ? 'selected' : ''}}>{{$i}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    @if ($errors->has('to'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('to') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="position_level" class="col-sm-4 col-form-label text-right">{{ __('Position Level') }}</label>
                                    <div class="col-sm-8">
                                        <input id="position_level" type="text" class="form-control{{ $errors->has('position_level') ? ' is-invalid' : '' }}" name="position_level[]" value="{{ $professional_experience->position_level }}" placeholder="Position Level">
        
                                    @if ($errors->has('position_level'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('position_level') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="experience_description" class="col-sm-4 col-form-label text-right">{{ __('Experience Description ') }}<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control{{ $errors->has('experience_description') ? ' is-invalid' : '' }}" name="experience_description[]" id="experience_description" cols="30" rows="9" required>{{ $professional_experience->experience_description }}</textarea>
                                    @if ($errors->has('experience_description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('experience_description') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr class="mt-4 mb-4"/>
                            </div>
                            @endforeach
                        @else
                        <div class="col-md-11">
                            <div class="form-group row">
                                <label for="designation" class="col-sm-4 col-form-label text-right">{{ __('Designation ') }}<span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <input id="designation" type="text" class="form-control{{ $errors->has('designation') ? ' is-invalid' : '' }}" name="designation[]" value="{{ old('designation') }}" placeholder="Designation" required>
    
                                @if ($errors->has('designation'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('designation') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="company" class="col-sm-4 col-form-label text-right">{{ __('Company ') }}<span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <input id="company" type="text" class="form-control{{ $errors->has('company') ? ' is-invalid' : '' }}" name="company[]" value="{{ old('company') }}" placeholder="Company" required>
    
                                @if ($errors->has('company'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('company') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="from" class="col-sm-4 col-form-label text-right">{{ __('From ') }}<span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    {{-- <input id="from" type="date" class="form-control{{ $errors->has('from') ? ' is-invalid' : '' }}" name="from[]" value="{{ old('from') }}" placeholder="from" required> --}}
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <select class="form-control" name="from_month[]" id="">
                                                <option value="">--Month--</option>
                                                @for ($i = 1; $i <= 12; $i++)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <select class="form-control" name="from_year[]" id="">
                                                <option value="">--Year--</option>
                                                @for ($i = 1960; $i <= date('Y', time()); $i++)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                @if ($errors->has('from'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('from') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label text-right">{{ __('Present Job?') }}</label>
                                <div class="col-sm-8">
                                    <div class="form-check mt-2">
                                        <input type="hidden" name="is_present_job[]" value="0" />
                                        <input onchange="hideInput(this);" type="checkbox" class="form-check-input" {{old('is_present_job') == 1 ? 'checked' : ''}} value="1" id="is_present_job">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="to" class="col-sm-4 col-form-label text-right">{{ __('To') }}</label>
                                <div class="col-sm-8">
                                    {{-- <input id="to" type="date" class="form-control{{ $errors->has('to') ? ' is-invalid' : '' }}" name="to[]" value="{{ old('to') }}" placeholder="To"> --}}
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <select class="form-control" name="to_month[]" id="">
                                                <option value="">--Month--</option>
                                                @for ($i = 1; $i <= 12; $i++)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <select class="form-control" name="to_year[]" id="">
                                                <option value="">--Year--</option>
                                                @for ($i = 1960; $i <= date('Y', time()); $i++)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                @if ($errors->has('to'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('to') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="position_level" class="col-sm-4 col-form-label text-right">{{ __('Position Level') }}</label>
                                <div class="col-sm-8">
                                    <input id="position_level" type="text" class="form-control{{ $errors->has('position_level') ? ' is-invalid' : '' }}" name="position_level[]" value="{{ old('position_level') }}" placeholder="Position Level">
    
                                @if ($errors->has('position_level'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('position_level') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="experience_description" class="col-sm-4 col-form-label text-right">{{ __('Experience Description ') }}<span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <textarea class="form-control{{ $errors->has('experience_description') ? ' is-invalid' : '' }}" name="experience_description[]" id="experience_description" cols="30" rows="9" required>{{ old('experience_description') }}</textarea>
                                @if ($errors->has('experience_description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('experience_description') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <hr class="mt-4 mb-4"/>
                        </div>
                        @endif
                        
                        <div id="czContainerEducation">
                            <div id="first">
                                <div class="recordset">
                                    <div class="fieldRow clearfix">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label for="designation" class="col-sm-4 col-form-label text-right">{{ __('Designation ') }}<span class="text-danger">*</span></label>
                                                    <div class="col-sm-8">
                                                        <input id="designation" type="text" class="form-control{{ $errors->has('designation') ? ' is-invalid' : '' }}" name="designation[]" value="{{ old('designation') }}" placeholder="Designation" required>
                        
                                                    @if ($errors->has('designation'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('designation') }}</strong>
                                                        </span>
                                                    @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="company" class="col-sm-4 col-form-label text-right">{{ __('Company ') }}<span class="text-danger">*</span></label>
                                                    <div class="col-sm-8">
                                                        <input id="company" type="text" class="form-control{{ $errors->has('company') ? ' is-invalid' : '' }}" name="company[]" value="{{ old('company') }}" placeholder="Company" required>
                        
                                                    @if ($errors->has('company'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('company') }}</strong>
                                                        </span>
                                                    @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="from" class="col-sm-4 col-form-label text-right">{{ __('From ') }}<span class="text-danger">*</span></label>
                                                    <div class="col-sm-8">
                                                        {{-- <input id="from" type="date" class="form-control{{ $errors->has('from') ? ' is-invalid' : '' }}" name="from[]" value="{{ old('from') }}" placeholder="from" required> --}}
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <select class="form-control" name="from_month[]" id="">
                                                                    <option value="">--Month--</option>
                                                                    @for ($i = 1; $i <= 12; $i++)
                                                                        <option value="{{$i}}">{{$i}}</option>
                                                                    @endfor
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <select class="form-control" name="from_year[]" id="">
                                                                    <option value="">--Year--</option>
                                                                    @for ($i = 1960; $i <= date('Y', time()); $i++)
                                                                        <option value="{{$i}}">{{$i}}</option>
                                                                    @endfor
                                                                </select>
                                                            </div>
                                                        </div>
                                                    @if ($errors->has('from'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('from') }}</strong>
                                                        </span>
                                                    @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label text-right">{{ __('Present Job?') }}</label>
                                                    <div class="col-sm-8">
                                                        <div class="form-check mt-2">
                                                            <input type="hidden" name="is_present_job[]" value="0" />
                                                            <input onchange="hideInput(this);" type="checkbox" class="form-check-input" {{old('is_present_job') == 1 ? 'checked' : ''}} value="1" id="is_present_job">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="to" class="col-sm-4 col-form-label text-right">{{ __('To') }}</label>
                                                    <div class="col-sm-8">
                                                        {{-- <input id="to" type="date" class="form-control{{ $errors->has('to') ? ' is-invalid' : '' }}" name="to[]" value="{{ old('to') }}" placeholder="To"> --}}
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <select class="form-control" name="to_month[]" id="">
                                                                    <option value="">--Month--</option>
                                                                    @for ($i = 1; $i <= 12; $i++)
                                                                        <option value="{{$i}}">{{$i}}</option>
                                                                    @endfor
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <select class="form-control" name="to_year[]" id="">
                                                                    <option value="">--Year--</option>
                                                                    @for ($i = 1960; $i <= date('Y', time()); $i++)
                                                                        <option value="{{$i}}">{{$i}}</option>
                                                                    @endfor
                                                                </select>
                                                            </div>
                                                        </div>
                                                    @if ($errors->has('to'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('to') }}</strong>
                                                        </span>
                                                    @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="position_level" class="col-sm-4 col-form-label text-right">{{ __('Position Level') }}</label>
                                                    <div class="col-sm-8">
                                                        <input id="position_level" type="text" class="form-control{{ $errors->has('position_level') ? ' is-invalid' : '' }}" name="position_level[]" value="{{ old('position_level') }}" placeholder="Position Level">
                        
                                                    @if ($errors->has('position_level'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('position_level') }}</strong>
                                                        </span>
                                                    @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="experience_description" class="col-sm-4 col-form-label text-right">{{ __('Experience Description ') }}<span class="text-danger">*</span></label>
                                                    <div class="col-sm-8">
                                                        <textarea class="form-control{{ $errors->has('experience_description') ? ' is-invalid' : '' }}" name="experience_description[]" id="experience_description" cols="30" rows="9" required>{{ old('experience_description') }}</textarea>
                                                    @if ($errors->has('experience_description'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('experience_description') }}</strong>
                                                        </span>
                                                    @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <hr class="mt-4 mb-4"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-0 mt-3">
                            <button type="submit" class="btn btn-warning btn-block">
                                {{ __('Save') }}
                            </button>
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
    (function ($, undefined) {
    $.fn.czMore = function (options) {

        //Set defauls for the control
        var defaults = {
            max: 5,
            min: 0,
            onLoad: null,
            onAdd: null,
            onDelete: null,
            styleOverride: false,
        };
        //Update unset options with defaults if needed
        var options = $.extend(defaults, options);
        $(this).bind("onAdd", function (event, data) {
            options.onAdd.call(event, data);
        });
        $(this).bind("onLoad", function (event, data) {
            options.onLoad.call(event, data);
        });
        $(this).bind("onDelete", function (event, data) {
            options.onDelete.call(event, data);
        });
        //Executing functionality on all selected elements
        return this.each(function () {
            var obj = $(this);
            var i = obj.children(".recordset").length;
            var divPlus = '<div id="btnPlus" class="btnPlus">Add more experience</div>';
            var count = '<input id="' + this.id + '_czMore_txtCount" name="' + this.id + '_czMore_txtCount" type="hidden" value="0" size="5" />';

            obj.before(count);
            var recordset = obj.children("#first");
            obj.after(divPlus);
            var set = recordset.children(".recordset").children().first();
            var btnPlus = obj.siblings("#btnPlus");

            if(!options.styleOverride) {
              btnPlus.css({
                  'border': '0px',
                  'background-image': 'url("/images/add.png")',
                  //'background-position': 'center center',
                  'background-repeat': 'no-repeat',
                  'height': '25px',
                  'padding-left': '25px',
                  'cursor': 'pointer',
                  'margin-left': '220px'
              });
            }

            if (recordset.length) {
                obj.siblings("#btnPlus").click(function () {
                    var i = obj.children(".recordset").length;
                    var item = recordset.clone().html();
                    i++;
                    item = item.replace(/\[([0-9]\d{0})\]/g, "[" + i + "]");
                    item = item.replace(/\_([0-9]\d{0})\_/g, "_" + i + "_");
                    //$(element).html(item);
                    //item = $(item).children().first();
                    //item = $(item).parent();

                    obj.append(item);
                    loadMinus(obj.children().last());
                    minusClick(obj.children().last());
                    if (options.onAdd != null) {
                        obj.trigger("onAdd", i);
                    }

                    obj.siblings("input[name$='czMore_txtCount']").val(i);
                    return false;
                });
                recordset.remove();
                for (var j = 0; j <= i; j++) {
                    loadMinus(obj.children()[j]);
                    minusClick(obj.children()[j]);
                    if (options.onAdd != null) {
                        obj.trigger("onAdd", j);
                    }
                }

                if (options.onLoad != null) {
                    obj.trigger("onLoad", i);
                }
                //obj.bind("onAdd", function (event, data) {
                //If you had passed anything in your trigger function, you can grab it using the second parameter in the callback function.
                //});
            }

            function resetNumbering() {
                $(obj).children(".recordset").each(function (index, element) {
                   $(element).find('input:text, input:password, input:file, select, textarea').each(function(){
                        old_name = this.name;
                        new_name = old_name.replace(/\_([0-9]\d{0})\_/g, "_" + (index + 1) + "_");
                        this.id = this.name = new_name;
                        //alert(this.name);
                    });
                    index++
                    minusClick(element);
                });
            }

            function loadMinus(recordset) {
                var divMinus = '<div id="btnMinus" class="btnMinus" />';
                $(recordset).children().first().before(divMinus);
                var btnMinus = $(recordset).children("#btnMinus");
                if(!options.styleOverride) {
                  btnMinus.css({
                      'float': 'right',
                      'border': '0px',
                      'background-image': 'url("/images/remove.png")',
                      'background-position': 'center center',
                      'background-repeat': 'no-repeat',
                      'height': '25px',
                      'width': '25px',
                      'cursor': 'poitnter',
                  });
              }
            }

            function minusClick(recordset) {
                $(recordset).children("#btnMinus").click(function () {
                    var i = obj.children(".recordset").length;
                    var id = $(recordset).attr("data-id")
                    $(recordset).remove();
                    resetNumbering();
                    obj.siblings("input[name$='czMore_txtCount']").val(obj.children(".recordset").length);
                    i--;
                    if (options.onDelete != null) {
                        if (id != null)
                            obj.trigger("onDelete", id);
                    }
                });
            }
        });
    };
})(jQuery);

    </script>
    <script type="text/javascript">
        //One-to-many relationship plugin by Yasir O. Atabani. Copyrights Reserved.
        $("#czContainer").czMore();
        $("#czContainerEducation").czMore();
    </script>
    <script>
        function hideInput(x)
        {
            console.log(x.previousElementSibling.value);
            if(x.checked){
                console.log('checked');
                x.previousElementSibling.value = 1;
                x.parentElement.parentElement.parentElement.nextElementSibling.classList.add("d-none");
            }else if(!x.checked){
                console.log('unchecked');
                x.previousElementSibling.value = 0;
                x.parentElement.parentElement.parentElement.nextElementSibling.classList.remove("d-none");
            }
        }
    </script>
@endsection