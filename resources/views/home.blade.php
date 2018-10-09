@extends('layouts.app')
@section('title','Home')
@section('content')
<div class="container-fluid home py-3">
    <div class="row">
        <div class="col-md-12 text-right">
            <a class="btn btn-primary" href="/shipment"> Add Shipment</a>
        </div>
    </div>
    <div class="table-responsive table-body">
        <table class="table dt-responsive table-striped" id="shipments" width="100%">
            <thead class="thead-light">
                <tr>
                    <th>Customer</th>
                    <th>File</th>
                    <th>FF</th>
                    <th>Ship Line</th>
                    <th>Contnr</th>
                    <th>Last Del</th>
                    <th>Doc CO</th>
                    <th>Pier CO</th>
                    <th>Rep</th>
                    <th>Items</th>
                    <th>Shpd</th>
                    <th>Cases</th>
                    <th>Shpd</th>
                    <th>Line</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($shipments as $shipment)
                    <tr>
                        <td>{{$shipment->customer}}</td>
                        @if($shipment->attachments)
                            <td><a href="/uploads/docreceipt/{{$shipment->id}}/{{rawurlencode($shipment->attachments)}}" class="avail" target="_blank">{{$shipment->file}}</a></td>
                        @else
                            <td><a href="#" data-toggle="modal" class="doc_popup" data-shipmentid="{{$shipment->id}}" data-target="#docmodal">{{$shipment->file}}</a></td>
                        @endif
                        <td class="wrap">{{$shipment->ff}}</td>
                        <td class="wrap">{{$shipment->shipline}}</td>
                        <td class="wrap">{{$shipment->contnr}}</td>
                        <td class="text-nowrap">{{$shipment->last_del}}</td>
                        <td class="text-nowrap">{{$shipment->doc_co}}</td>
                        <td class="text-nowrap">{{$shipment->pier_co}}</td>
                        <td>{{$shipment->rep}}</td>
                        <td>{{$shipment->items}}</td>
                        <td>{{$shipment->shpd}}</td>
                        <td class="wrap">{{$shipment->cases}}</td>
                        <td class="wrap">{{$shipment->shpd}}</td>
                        <td class="wrap">{{$shipment->line}}</td>
                        <input type="hidden" name="shipmentid_{{$shipment->id}}" id="shipmentid_{{$shipment->id}}" value="{{$shipment->id}}"/>
                        <td class="text-nowrap">
                            <a class="btn btn-icon" href="/shipment/edit/{{$shipment->id}}" title="Edit Shipment"><i class="fas fa-pencil-alt"></i></a>
                            <a class="delete btn btn-icon" data-id="{{$shipment->id}}" title="Delete Shipment"><i class="fas fa-trash-alt"></i></a>
                        </td>
                        <td class="text-nowrap">
                            <a class=" btn btn-icon comment-popup" data-toggle="modal" data-shipmentid="{{$shipment->id}}" data-target="#commentmodal" title="Add Comment" href="JavaScript:void(0);"><i class="far fa-comments" aria-hidden="true"></i></a>
                            <a href="JavaScript:void(0);" class="btn details-control btn-icon" data-count="{{$shipment->notify}}" data-shipmentid="{{$shipment->id}}" title="View Comment"><i class="far fa-eye" aria-hidden="true"></i>
                            @if($shipment->notify>0)
                                <sup><span class="button__badge">{{$shipment->notify}}</span><sup>
                            @endif                          
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Comment Modal -->
    <div class="modal fade" id="commentmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="#" id="commentform">
                    {{ csrf_field() }}
                    <input type="hidden" name="_token" id="csrf" value="<?php echo csrf_token(); ?>">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Comment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                        <input type="hidden" name="shipment_id" id="shipmentid_modal"/>
                        <input type="hidden" name="user_id" id="user_id" value="{{$userid}}"/>
                            <label for="comments" class="required">Comment</label>
                            <input type="textarea" name="comments" rows="4" cols="50" class="form-control" id="comments" placeholder="Comments" autocomplete="off" required/>
                            <label class=' error_field'></label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary save-comment">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Doc recipt Modal -->
        <div class="modal fade" id="docmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form id="docreceipt_form" method="POST" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Doc Receipt</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="file" name="receipt" id="docrecipt" accept=".pdf" />
                            <label class='error_field_doc d-block'></label>
                            <input type="hidden" name="shipment-id" id="shipment-id"/>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary docreceipt-save">Save changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Shipment Upload Modal -->
            <div class="modal fade" id="uploadshipmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form id="shipment-upload-form" action="{{ route('uploadshipment') }}" method="POST" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Upload Shipment</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="update" value=0>
                                <input type="file" name="shipmentupload" id="shipment-upload" accept=".xls,.xlsx" required/>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary shipment-upload">Save changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
</div>
<script>
    $(document).ready(function(){
        //Removing data from comment Modal
        $('#commentmodal').on('hidden.bs.modal', function () {
            $("#comments").val('');
            $(".error_field").html("");
        });

        //Removing doc modal
        $('#docmodal').on('hidden.bs.modal', function () {
            $("#docrecipt").val('');
            $(".error_field_doc").html("");
        });
        
        //Removing Shipment modal
        $('#uploadshipmodel').on('hidden.bs.modal', function () {
            $("#shipment-upload").val('');
        });

        $.noConflict();
        //Loading Datatable
        var table=$("#shipments").DataTable({
            responsive: {
                details: false
            },
            "order": [],
            "dom": '<f<t>ip>',
                "columnDefs": [ {
                "targets":[14,15],
                "orderable": false
                } ]
        });        

        //Data to modal popup for comments
        $("body").on('click','.comment-popup',function(){
            var shipmentid=$(this).data("shipmentid");
            $("#shipmentid_modal").val(shipmentid);
        });

        $("#comments").keyup(function(){
           $(".error_field") .html('');
        });        

        //Comments form data saving via ajax
        $(".save-comment").click(function(){
            var el = $(this);
            el.prop('disabled', true);
            setTimeout(function(){el.prop('disabled', false); }, 1000);
            var comments=$("#comments").val();
            if(!comments){
                $(".error_field").html("This field is required!");
                return;
            }
            var csrf=$("#csrf").val();
            var shipment_id=$("#shipmentid_modal").val();
            var user_id=$("#user_id").val();
            //alert(user_id);alert(shipment_id);
            $.ajax({
                url:'{{ route('comments.store') }}',
                type:"POST",
                data:{"comments":comments,"_token":csrf,"shipment_id":shipment_id,"user_id":user_id},
                success:function(data,result){
                    if(data.success){
                        //$(".comment-popup").click();
                        location.reload();
                    }
                    else if(data.error){
                        location.reload();
                    }
                },
                error:function(err){
                    console.log(err);
                    location.reload();
                }
            });
        });

        //Data to modal pop up for docreceipt
         $("body").on('click','.doc_popup',function(){
            var shipment_id=$(this).data("shipmentid");
            $("#shipment-id").val(shipment_id);
        });
        
        $('#docrecipt').change(function(){
            $(".error_field_doc").html('');
        });
        
        //Doc receipt form submission via ajax
        $('#docreceipt_form').submit(function(event) {
            event.preventDefault();
            var docreceipt=$("#docrecipt").val();
            if(!docreceipt){
                $(".error_field_doc").html("This field is required!");
                return;
            }
            var formData = new FormData(this);
            //console.log(formData);
            $.ajax({
                type:'POST',
                url: "/docupload",
                data:formData,
                cache:false,
                contentType: false,
                processData: false,
                success:function(data){
                    if(data.success){
                        location.reload();
                    }
                    else if(data.error){
                        location.reload();
                    }
                },
                error: function(data){
                    console.log(data);
                }
            });
        });

        //Uploadshipoment model
        $("#shipment-upload-form").submit(function(e){
             e.preventDefault();
             var el = $(".shipment-upload");
            el.prop('disabled', true);
            setTimeout(function(){el.prop('disabled', false); }, 2000);
             var form_data = new FormData();
             var file_data = $('#shipment-upload').prop('files')[0];
             var update = $('input[name="update"').val();
             form_data.append('shipmentupload', file_data);
             form_data.append('update', update);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('input[name=_token]').val()
                }
            });
            $.ajax({
                url: "{{url('uploadshipment')}}", // point to server-side PHP script
                data: form_data,
                type: 'POST',
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false,
                success: function(data) {
                    //console.log(data);
                    if (typeof data.shipment !== 'undefined' && data.shipment>0) {
                        var x=confirm("DO you want to overwrite?");
                        if(x==true){
                            $('input[name="update"').val(1);
                            $("#shipment-upload-form").submit();
                        }
                        else{
                            location.reload();
                        }
                    }
                    else{
                        location.reload();
                    }
                },
                error:function(err){
                    console.log(err);
                    //alert("Please upload the excel file in correct format!");
                    location.reload();
                }
            });
        });
        
        $("body").on('click','.delete',function(){
            var shipment_id=$(this).data("id");
            var check=confirm("Are you sure want to delete?");
            if(check==false)
                return false;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:'POST',
                url: "/deleteshipment",
                cache:false,
                data:{"shipment_id":shipment_id},
                success:function(data){
                    //console.log(data);
                    if(data.success){
                        location.reload();
                    }
                    else{
                        location.reload();
                    }
                },
                error: function(data){
                    console.log(data);
                }
            });
        });

        // Add event listener for opening and closing comments
            $('#shipments tbody').on('click', '.details-control', function () {
                var el = $(this);
                el.prop('disabled', true);
                setTimeout(function(){el.prop('disabled', false); }, 500);
                var tr = $(this).closest('tr');
                var row = table.row( tr );
                var shipment_id=$(this).data("shipmentid");
                var class1=$(this).parent().parent().next().attr('class');
                var count=$(this).data("count");
                if ( class1=='child' ) {
                    // This row is already open - close it
                    $(this).parent().parent().next(".child").remove();
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    var comments;
                     $.ajax({
                        type:'POST',
                        url: "/listcomments",
                        cache:false,
                        context: this,
                        data:{"shipment_id":shipment_id,"count":count},
                        success:function(data){
                            //console.log(data.data);
                            if(data.data){
                                $(this).find(".button__badge").hide();
                                comments=data.data;
                                $(this).parent().parent().after(format(comments));
                                //console.log(comments);
                            }
                            else{
                                $(this).parent().parent().after(format(comments));
                            }
                        },
                        error: function(data){
                            console.log(data);
                            alert("Failed to load Comments.Try Again!");
                        }
                    });
                }
            } );

            function format ( d ) {
                // `d` is the original data object for the row

                if(d.length==0){
                    return '<tr class="child" colspan="16"><td colspan="16"><div class="col-md-12 text-center">No Comments found</div></td></tr>';
                }
                var row;
                row+='<tr class="child"><td colspan="16">'+
                        '<div class="row font-weight-bold">'+
                            '<div class="col-md-8">Comments</div>'+
                            '<div class="col-md-2">User</div>'+
                            '<div class="col-md-2">Date</div>'+
                        '</div>';
                d.forEach(function(val,index,arr){
                    row+= '<div class="row">'+
                            '<div class="col-md-8">'+val.comments+'</div>'+
                            '<div class="col-md-2">'+val.name+'</div>'+
                            '<div class="col-md-2">'+val.created_at+'</div>'+'</div>';
                });
                row+='</td></tr>';
                return row;
            }
        $('div.error_flash').delay(2000).fadeOut(300);
    });
</script>
@endsection
