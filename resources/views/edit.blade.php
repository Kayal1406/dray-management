@extends('layouts.app')
@section('content')
<div class="container-fluid main-div">
    <div class="py-4 col-sm-6 offset-sm-3">
        <form method="POST"  id="editshipment" enctype='multipart/form-data' action="{{action('ShipmentController@update',$shipment->id)}}" class="addshipment">
            {{ csrf_field() }}
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="Customer" class="required">Customer</label>
                <input type="hidden" value="{{$shipment->id}}" name="shipment_id" class="shipment_id"/>
                <input type="text" class="form-control" id="customer" value="{{$shipment->customer}}" name="customer" aria-describedby="emailHelp" placeholder="Customer" autocomplete="off">
                </div>
                <div class="form-group col-md-6">
                <label for="fileno" class="required">File No</label>
                <input type="text" class="form-control" name="fileno" value="{{$shipment->file}}" id="fileno" placeholder="File No">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="ff">FF</label>
                <input type="text" class="form-control" id="ff" value="{{$shipment->ff}}" name="ff"  placeholder="FF" autocomplete="off">
                </div>
                <div class="form-group col-md-6">
                <label for="shipline">Ship Line</label>
                <input type="text" class="form-control" name="shipline" id="shipline" value="{{$shipment->shipline}}" placeholder="Ship Line" autocomplete="off">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="contnr">Contnr</label>
                <input type="text" class="form-control" id="contnr" name="contnr" value="{{$shipment->contnr}}" aria-describedby="emailHelp" placeholder="Contnr" autocomplete="off">
                </div>
                <div class="form-group has-feedback col-md-6 calendar">
                <label for="lastdel" class="control-label">Last Del</label>
                    <div class="input-group calendar-control">
                        <input type="text" class="form-control datepicker" name="lastdel" value="{{$shipment->last_del}}" id="lastdel" placeholder="YYYY-MM-DD" autocomplete="off">
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
                    <input type="text" class="form-control datepicker calendar-cell" id="pierco" value="{{$shipment->pier_co}}" name="pierco" placeholder="YYYY-MM-DD" autocomplete="off">
                    <div class="input-group-append">
                        <span class="fa fa-calendar input-group-text"></span>
                    </div>
                </div>
                </div>
                <div class="form-group col-md-6 calendar">
                <label for="docco">Doc Co</label>
                <div class="input-group calendar-control">
                    <input type="text" class="form-control datepicker calendar-cell" name="docco" value="{{$shipment->doc_co}}" id="docco" placeholder="YYYY-MM-DD" autocomplete="off">
                    <div class="input-group-append">
                        <span class="fa fa-calendar input-group-text"></span>
                    </div>
                </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="rep">Rep</label>
                <input type="text" class="form-control" id="rep" name="rep" value="{{$shipment->rep}}" placeholder="Rep" autocomplete="off">
                </div>
                <div class="form-group col-md-6">
                <label for="items">Items</label>
                <input type="text" class="form-control" name="items" id="items" value="{{$shipment->items}}" placeholder="Items" autocomplete="off">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="shpd">Shpd</label>
                <input type="text" class="form-control" id="shpd" name="shpd" value="{{$shipment->shpd}}" placeholder="Shpd" autocomplete="off">
                </div>
                <div class="form-group col-md-6">
                <label for="cases">Cases</label>
                <input type="text" class="form-control" name="cases" id="cases" value="{{$shipment->cases}}" placeholder="Cases" autocomplete="off">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="shpd1">Shpd</label>
                <input type="text" class="form-control" id="shpd1" value="{{$shipment->shpd1}}" name="shpd1" placeholder="Shpd" autocomplete="off">
                </div>
                <div class="form-group col-md-6">
                <label for="line">Line</label>
                <input type="text" class="form-control" name="line" value="{{$shipment->line}}" id="line" placeholder="Line" autocomplete="off">
                </div>
            </div>
            <div class="form-group col-md-12">
                <label for="attachment">
                Doc Receipt</label>
                <input type="file" class="form-control-file" accept="application/pdf" id="attachment" name="attachment" />
                <span class="attachment">{{$shipment->attachments}}</span>
            </div>
            <a href="{{ URL::previous() }}" class="btn btn-primary">Back</a>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
<script>
    $(document).ready(function(){
        $.noConflict();
        //Datepicker calendar format
        $(".datepicker").datepicker({
            dateFormat: 'yy-mm-dd'
        });
        $(".input-group-append").on("click", function() {
            console.log("clicked");
            $(this).parent().find(".datepicker").datepicker("show");
        });

        $('div.alert-success').delay(2000).slideUp(300);

        $("#editshipment").validate({
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
         $("input:file").change(function (){
            var filename = $(this).val().split('\\').pop();
            $(".attachment").html(filename);
        });
    });
</script>
@endsection