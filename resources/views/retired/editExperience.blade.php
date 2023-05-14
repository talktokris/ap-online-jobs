@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row bg-dark">
        <div class="col-12">
            <h4 class="text-center text-white pb-3 pt-4"><span class="mr-3 text-muted">Personal</span> <span class="mr-3">Experience</span> <span class="mr-3 text-muted">Language</span></h4>
        </div>
    </div>
</div>
<div class="container mt-3 mb-3">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <form method="POST" action="{{ route('retiredPersonnelExperience.update', $user->id) }}">
                @csrf
                @method('PATCH')
                @if($user->retired_personnel_experiences->count()>0)
                @foreach ($user->retired_personnel_experiences as $experience)
                <div class="row">
                    <div class="col-md-6">
                        <div id="company_name" class="form-group dis-cls">
                            <label for="company_name">{{ __('Company Name ') }}</label><span class="text-danger mt-2">*</span>
                            <input id="company_name" type="text" class="form-control" name="company_name[]" value="{{$experience->company_name}}" placeholder="Company Name" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div id="address" class="form-group dis-cls">
                            <label for="address">{{ __('Address') }}</label>
                            <input id="address" type="text" class="form-control" name="address[]" value="{{$experience->address}}" placeholder="Address">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div id="position" class="form-group dis-cls">
                            <label for="position">{{ __('Position') }}</label>
                            <input id="position" type="text" class="form-control" name="position[]" value="{{$experience->position}}" placeholder="Position">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div id="nature_of_company_business" class="form-group dis-cls">
                            <label for="nature_of_company_business" style="margin-top: -10px;">{{ __('Nature of company Business') }}</label>
                            <input id="nature_of_company_business" type="text" class="form-control" name="nature_of_company_business[]" value="{{$experience->nature_of_company_business}}" placeholder="Nature of company Business">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div id="from" class="form-group dis-cls">
                            <label for="from">{{ __('from') }}</label>
                            <select class="form-control" name="from_month[]" id="">
                                <option value="">--Month--</option>
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{$i}}" {{$experience->from_month() == $i ? 'selected' : ''}}>{{$i}}</option>
                                @endfor
                            </select>
                            <select class="form-control" name="from_year[]" id="">
                                <option value="">--Year--</option>
                                @for ($i = 1960; $i <= date('Y', time()); $i++)
                                    <option value="{{$i}}" {{$experience->from_year() == $i ? 'selected' : ''}}>{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div id="to" class="form-group dis-cls">
                            <label for="to">{{ __('to') }}</label>
                            <select class="form-control" name="to_month[]" id="">
                                <option value="">--Month--</option>
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{$i}}" {{$experience->to_month() == $i ? 'selected' : ''}}>{{$i}}</option>
                                @endfor
                            </select>
                            <select class="form-control" name="to_year[]" id="">
                                <option value="">--Year--</option>
                                @for ($i = 1960; $i <= date('Y', time()); $i++)
                                    <option value="{{$i}}" {{$experience->to_year() == $i ? 'selected' : ''}}>{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div id="work_description" class="form-group dis-cls">
                            <label class="col-md-2" for="work_description">{{ __('Work Description') }}</label>
                            <textarea class="form-control" name="work_description[]" id="work_description" cols="30" rows="3">{{$experience->work_description}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <hr class="mt-4 mb-4"/>
                    </div>
                </div>
                @endforeach
                @endif
                <div id="czContainerExperience">
                    <div id="first">
                        <div class="recordset">
                            <div class="fieldRow clearfix">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div id="company_name" class="form-group dis-cls">
                                            <label for="company_name">{{ __('Company Name *') }}</label><span class="text-danger mt-2">*</span>
                                            <input id="company_name" type="text" class="form-control" name="company_name[]" placeholder="Company Name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div id="address" class="form-group dis-cls">
                                            <label for="address">{{ __('Address') }}</label>
                                            <input id="address" type="text" class="form-control" name="address[]" placeholder="Address">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div id="position" class="form-group dis-cls">
                                            <label for="position">{{ __('Position') }}</label>
                                            <input id="position" type="text" class="form-control" name="position[]" placeholder="Position">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div id="nature_of_company_business" class="form-group dis-cls">
                                            <label for="nature_of_company_business" style="margin-top: -10px;">{{ __('Nature of company Business') }}</label>
                                            <input id="nature_of_company_business" type="text" class="form-control" name="nature_of_company_business[]" placeholder="Nature of company Business">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div id="from" class="form-group dis-cls">
                                            <label for="from">{{ __('from') }}</label>
                                            <select class="form-control" name="from_month[]" id="">
                                                <option value="">--Month--</option>
                                                @for ($i = 1; $i <= 12; $i++)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                            <select class="form-control" name="from_year[]" id="">
                                                <option value="">--Year--</option>
                                                @for ($i = 1960; $i <= date('Y', time()); $i++)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div id="to" class="form-group dis-cls">
                                            <label for="to">{{ __('to') }}</label>
                                            <select class="form-control" name="to_month[]" id="">
                                                <option value="">--Month--</option>
                                                @for ($i = 1; $i <= 12; $i++)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                            <select class="form-control" name="to_year[]" id="">
                                                <option value="">--Year--</option>
                                                @for ($i = 1960; $i <= date('Y', time()); $i++)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div id="work_description" class="form-group dis-cls">
                                            <label class="col-md-2" for="work_description">{{ __('Work Description') }}</label>
                                            <textarea class="form-control" name="work_description[]" id="work_description" cols="30" rows="3"></textarea>
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
        $("#czContainerExperience").czMore();
    </script>
    
@endsection