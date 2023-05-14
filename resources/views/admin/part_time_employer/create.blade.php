@extends('layouts.app')
@section('content')
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" />
 <div class="container py-5">
    <div class="row">
        <div class="col-md-10 mx-auto">
        <h2 style="text-align: center;">Retired Personnel Registration</h2><hr>
                    <form method="POST" action="{{ route('retired.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="role" value="retired">

                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="name">{{ __('First Name ') }}<span class="text-danger">*</span></label>
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="First Name" required>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <!-- last name field added by Milesh on 2/14/2020 start -->
                            <div class="col-sm-3">
                                <label for="lname">{{ __('Last Name ') }}</label>
                                <input id="lname" type="text" class="form-control{{ $errors->has('lname') ? ' is-invalid' : '' }}" name="lname" value="{{ old('lname') }}" placeholder="Last Name">
                                @if ($errors->has('lname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lname') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <!-- last name field added by Milesh on 2/14/2020 end -->
                            <div class="col-sm-2">
                                <label for="age">{{ __('Age ') }}<span class="text-danger">*</span></label>
                                <input id="age" type="text" class="form-control{{ $errors->has('age') ? ' is-invalid' : '' }}" name="age" value="{{ old('age') }}" placeholder="Age" required>
                                @if ($errors->has('age'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('age') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-4">
                                <label for="nric">{{ __('Passport/NRIC ') }}<span class="text-danger">*</span></label>
                                <input id="nric" type="text" class="form-control{{ $errors->has('nric') ? ' is-invalid' : '' }}" name="nric" value="{{ old('nric') }}" placeholder="Passport/NRIC" required>
                                @if ($errors->has('nric'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nric') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="country">{{ __('Job Category ') }}<span class="text-danger">*</span></label>
                                <select name="job_category" id="job_category" class="form-control{{ $errors->has('job_category') ? ' is-invalid' : '' }}" required>
                                    <option value="">--Select Job Category--</option>
                                    @foreach ($options as $option)
                                        <option value="{{$option->id}}" {{$option->id == old('job_category') ? 'selected':''}}>{{$option->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('job_category'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('job_category') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <label for="country">{{ __('Country ') }}<span class="text-danger">*</span></label>
                                <select name="country" id="person_country" class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}" required>
                                    <!-- <option value="">--Select Country--</option> -->
                                    @foreach ($countrys as $country)
                                        <option value="{{$country->id}}" {{$country->id == old('country') ? 'selected':''}}>{{$country->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label for="state">{{ __('State ') }}<span class="text-danger">*</span></label>
                                <select name="state" id="person_state" class="form-control{{ $errors->has('state') ? ' is-invalid' : '' }}" required>
                                    <option value="" disable="true" selected="true">--Select State--</option>
                                    @foreach ($states as $state)
                                        <option value="{{$state->id}}" >{{$state->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('country'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <label for="person_city">{{ __('City ') }}<span class="text-danger">*</span></label>
                                <select name="person_city" id="person_city" class="form-control{{ $errors->has('person_city') ? ' is-invalid' : '' }}" required>
                                    <option value="" disable="true" selected="true">--Select City--</option>
                                </select>
                                @if ($errors->has('person_city'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('person_city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="address">{{ __('Address ') }}<span class="text-danger">*</span></label>
                                <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}" placeholder="Address" required>
                                @if ($errors->has('address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <label for="phone" >{{ __('Contact Number ') }}<span class="text-danger">*</span></label>
                                <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" placeholder="Contact Number" required>
                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <label for="email">{{ __('Email ') }}<span class="text-danger">*</span></label>
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email" required>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert" style="margin-top: 29px; margin-right: 15px;">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                           
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-3"> 
                                <label for="resume_file" >{{ __('Upload Resume') }}</label>
                                <input id="resume_file" type="file" class="form-control-file{{ $errors->has('resume_file') ? ' is-invalid' : '' }}" name="resume_file" value="{{ old('resume_file') }}">
                                <p class="text-danger">Supported file format DOC, DOCX & PDF. Maximum file size: 1MB</p>
                                @if ($errors->has('resume_file'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('resume_file') }}</strong>
                                    </span>
                                @endif
                            </div>
                            </div>
                        <div class="form-group row">
                            <div class="col-sm-8">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="agreement" id="customCheck1" required checked>
                                    <label class="custom-control-label" for="customCheck1">I have read and agree to the <a href="">Terms and Conditions</a> governing the use of onlinejobs.my</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-warning btn-block">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </form>
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
            var divPlus = '<div id="btnPlus" class="btnPlus">Add</div>';
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
                  'background-position': 'center center',
                  'background-repeat': 'no-repeat',
                  'height': '25px',
                  'width': '90px',
                  'cursor': 'pointer',
                  'margin': 'auto',
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
        $("#czContainerLanguage").czMore();
    </script>

<!-- <script>
    govt = document.querySelector('#govt');
    non_govt = document.querySelector('#non_govt');
    govt.addEventListener('click', function(){
        if(govt.checked){
            document.querySelector('.hide_govt_department').classList.remove("d-none");
        }
    });
    non_govt.addEventListener('click', function(){
        if(non_govt.checked){
            document.querySelector('.hide_govt_department').classList.add("d-none");
        }
    });
</script> -->
<script>
    part_time = document.querySelector('#part_time');
    full_time = document.querySelector('#full_time');
    part_time.addEventListener('click', function(){
        if(part_time.checked){
            document.querySelector('.hide_working_hours').classList.remove("d-none");
        }
    });
    full_time.addEventListener('click', function(){
        if(full_time.checked){
            document.querySelector('.hide_working_hours').classList.add("d-none");
        }
    });
</script>
@endsection