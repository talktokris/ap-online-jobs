@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row bg-dark">
        <div class="col-12">
            <h4 class="text-center text-white pb-3 pt-4"><span class="mr-3 text-muted">Personal</span> <span class="mr-3 text-muted">Experience</span> <span class="mr-3">Language</span></h4>
        </div>
    </div>
</div>
<div class="container mt-3 mb-3">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <form method="POST" action="{{ route('retiredPersonnelsLanguage.store') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div id="language" class="form-group dis-cls">
                            <label for="language">{{ __('Language ') }}</label><span class="text-danger mt-2">*</span>
                            <select class="form-control" name="language[]" id="language">
                                <option>--Select--</option>
                                @foreach($languages as $language)
                                    <option value="{{$language->name}}">{{$language->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div id="speaking" class="form-group dis-cls">
                            <label for="speaking">{{ __('Speaking') }}</label>
                            <select class="form-control" name="speaking[]" id="speaking">
                                <option>--Select--</option>
                                <option value="Fluent">Fluent</option>
                                <option value="Good">Good</option>
                                <option value="Poor">Poor</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div id="writing" class="form-group dis-cls">
                            <label for="writing">{{ __('Writing') }}</label>
                            <select class="form-control" name="writing[]" id="writing">
                                <option>--Select--</option>
                                <option value="Fluent">Fluent</option>
                                <option value="Good">Good</option>
                                <option value="Poor">Poor</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <hr class="mt-4 mb-4"/>
                    </div>
                </div>
                <div id="czContainerLanguage">
                    <div id="first">
                        <div class="recordset">
                            <div class="fieldRow clearfix">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div id="language" class="form-group dis-cls">
                                            <label for="language">{{ __('Language ') }}</label><span class="text-danger mt-2">*</span>
                                            <select class="form-control" name="language[]" id="language">
                                                <option>--Select--</option>
                                                @foreach($languages as $language)
                                                    <option value="{{$language->name}}">{{$language->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div id="speaking" class="form-group dis-cls">
                                            <label for="speaking">{{ __('Speaking') }}</label>
                                            <select class="form-control" name="speaking[]" id="speaking">
                                                <option>--Select--</option>
                                                <option value="Fluent">Fluent</option>
                                                <option value="Good">Good</option>
                                                <option value="Poor">Poor</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div id="writing" class="form-group dis-cls">
                                            <label for="writing">{{ __('Writing') }}</label>
                                            <select class="form-control" name="writing[]" id="writing">
                                                <option>--Select--</option>
                                                <option value="Fluent">Fluent</option>
                                                <option value="Good">Good</option>
                                                <option value="Poor">Poor</option>
                                            </select>
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
        $("#czContainerLanguage").czMore();
    </script>
    
@endsection