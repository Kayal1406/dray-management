@extends('layouts.app')
@section('content')
<div class="container-fluid main-div">
    <div class="py-4 col-sm-6 offset-sm-3">
    <form method="POST" action="{{ route('addshipment') }}" id="addshipment" class="addshipment">
        {{ csrf_field() }}
        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="Customer" class="required">Customer</label>
            <input type="text" class="form-control" id="customer" name="customer" aria-describedby="emailHelp" placeholder="Customer" autocomplete="off">
            </div>
            <div class="form-group col-md-6">
            <label for="fileno" class="required">File No</label>
            <input type="text" class="form-control" name="fileno" id="fileno" placeholder="File No">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="ff">FF</label>
            <input type="text" class="form-control" id="ff" name="ff"  placeholder="FF" autocomplete="off">
            </div>
            <div class="form-group col-md-6">
            <label for="shipline">Ship Line</label>
            <input type="text" class="form-control" name="shipline" id="shipline" placeholder="Ship Line" autocomplete="off">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="contnr">Contnr</label>
                <input type="text" class="form-control" id="contnr" name="contnr" aria-describedby="emailHelp" placeholder="Contnr" autocomplete="off"> 
            </div>
            <div class="form-group col-md-6">
                <label for="lastdel">Last Del</label>
                <div class="input-group calendar-control">
                    <input type="text" class="form-control datepicker" name="lastdel" id="lastdel" placeholder="YYYY-MM-DD" autocomplete="off">
                    <div class="input-group-append">
                        <span class="fa fa-calendar input-group-text"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6 calendar">
                <label for="pierco">Pier C/O</label>
                <div class="input-group calendar-control">
                    <input type="text" class="form-control datepicker" id="pierco" name="pierco" placeholder="YYYY-MM-DD" autocomplete="off">
                    <div class="input-group-append">
                        <span class="fa fa-calendar input-group-text"></span>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-6 calendar">
                <label for="docco">Doc Co</label>
                <div class="input-group calendar-control">
                    <input type="text" class="form-control datepicker" name="docco" id="docco" placeholder="YYYY-MM-DD" autocomplete="off">
                    <div class="input-group-append">
                        <span class="fa fa-calendar input-group-text"></span>
                    </div>
                </div>  
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="rep">Rep</label>
            <input type="text" class="form-control" id="rep" name="rep" placeholder="Rep" autocomplete="off">
            </div>
            <div class="form-group col-md-6">
            <label for="items">Items</label>
            <input type="text" class="form-control" name="items" id="items" placeholder="Items" autocomplete="off">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="shpd">Shpd</label>
            <input type="text" class="form-control" id="shpd" name="shpd" placeholder="Shpd" autocomplete="off">
            </div>
            <div class="form-group col-md-6">
            <label for="cases">Cases</label>
            <input type="text" class="form-control" name="cases" id="cases" placeholder="Cases" autocomplete="off">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="shpd1">Shpd</label>
            <input type="text" class="form-control" id="shpd1" name="shpd1" placeholder="Shpd" autocomplete="off">
            </div>
            <div class="form-group col-md-6">
            <label for="line">Line</label>
            <input type="text" class="form-control" name="line" id="line" placeholder="Line" autocomplete="off">
            </div>
        </div>
        <a href="{{ URL::previous() }}" class="btn btn-outline-secondary">Back</a>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<script>
    $(document).ready(function(){
        $.noConflict();
        $(".datepicker").datepicker({
            dateFormat: 'yy-mm-dd'
        });
        $(".input-group-append").on("click", function() {
            console.log("clicked");
            $(this).parent().find(".datepicker").datepicker("show");
        });
        
        $('div.alert-success').delay(2000).slideUp(300);

        $("#addshipment").validate({
        rules: {
            customer: "required",
            fileno: {
            required: true,
            number:true
            },
            shpd:{
                number: true
            },
            lastdel:{
                date : true,
            },
            items:{
                number: true
            },
            cases:{
                number:true
            }
        },
        messages: {
            name: "Please specify your name"
        },
        submitHandler: function(form) {
            // disable your button here
            $('form button[type=submit]').attr('disabled', 'disabled');
            form.submit();
        },
        invalidHandler: function() {
            // re-enable the button here as validation has failed
            $('form button[type=submit]').attr("disabled", false);
        }
        });
    });
</script>
@endsection