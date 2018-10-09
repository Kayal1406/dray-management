@extends('layouts.app')
@section('title','Compose')
@section('content')
<div class="container-fluid">
    <div class="row">
        @include('layouts.sidebar')
        <div class="col-sm-10 pt-2 mailbox">
             <div class="box-body">
                    <form method="post" action="{{route('sentmail')}}" id="compose"  class="compose" enctype='multipart/form-data'>
                        {{ csrf_field() }}
                        <div class="form-group form-row">
                            <label for='example_emailSUI' class="col-sm-2 required">Email</label>
                            <div class="col-sm-10">
                                <input type='text' id='email' placeholder="Email" class='form-control'>
                                <input type="hidden" name="email" id="email-ori">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="subject" class="col-sm-2 col-form-label required">Subject</label>
                            <div class="col-sm-10"> 
                            <input type="text" class="form-control" id="subject" placeholder="Subject" name="subject" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10 offset-sm-2">
                                <textarea class="form-control custom-control" name="whole" id="editor" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4 offset-sm-2">
                                <input type="file" name="attachment"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4 offset-sm-2">
                                <ul class="attachment">
                                </ul>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-5 offset-sm-2">
                                <a href="{{ URL::previous() }}" class="btn btn-outline-secondary">Back</a>
                                <button type="submit" class="btn btn-primary">Send</button>
                                <a  data-toggle="modal" data-target="#modalYT" class="fileattach">
                                    <i class="fas fa-paperclip"></i>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
    </div>
</div>

<!--Modal: Name-->
        <div class="modal fade" id="modalYT" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <!--Content-->
            <div class="modal-content">
                <!--Body-->
                <div class="modal-body mb-0 p-0">
                        <div class="table-responsive pt-1 table-body">
                            <form method="GET" action="{{ route('home') }}">
                                {!! csrf_field() !!}                                
                                <table class="table" id="files">
                                    <thead>
                                        <tr>
                                            <th>Check</th>
                                            <th>Shipment Id</th>
                                            <th>File No</th>
                                            <th>Doc receipt</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($shipments as $shipment)
                                            <tr>
                                                <td><input type="checkbox" name="shipmentid" class="attach" data-shipment="{{$shipment->id}}" data-attachments="{{$shipment->attachments}}"></td>
                                                <td>{{$shipment->id}}</td>
                                                <td>{{$shipment->file}}</td>
                                                <td>{{$shipment->attachments}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </form>
                        </div>
                </div>

                <!--Footer-->
                <div class="modal-footer justify-content-center">
                    <input type="button" class="btn btn-primary" data-dismiss="modal" id="attach" value="Attach">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!--/.Content-->

        </div>
        </div>
        <!--Modal: Name-->
    <script>
        $(document).ready(function(){
            $('body').on('keyup','.multiple_emails-input',function(){
                $.ajax(
                {
                    type : 'GET',
                    url: '{{ route("getsentmail") }}',
                    success: function (data)
                    {
                        var available_sentmail_list = data;
                        // console.log(available_sentmail_list);
                        $( ".multiple_emails-input" ).autocomplete({
                            source: available_sentmail_list
                        });
                    }
                });
            });

            
            ClassicEditor
                .create( document.querySelector( '#editor' ), {
                    removePlugins: [ 'Heading', 'Link' ],
                    toolbar: [ 'bold', 'italic', 'bulletedList', 'numberedList', 'blockQuote' ]
                } )
                .catch( error => {
                    console.log( error );
                } );

                $.noConflict();
                //Loading Datatable
                var table=$("#files").DataTable({
                    "dom": '<f<t>ip>'
                });
                $("#attach").click(function(){
                    var shipment;
                    shipment += $(".attach:checkbox:checked").data("shipment");
                    //console.log(shipment);
                    var values = $('.attach:checkbox:checked').map(function () {
                        var attachments=$(this).data("attachments");
                        var shipment=$(this).data("shipment");
                        var li="<li>"+attachments+"<span class='close'>&times;</span><input type='hidden' value='"+shipment+"' name='parameter[]'/></li>";
                        $(".attachment").append(li);
                        return $(this).data("shipment");
                    }).get();
                    
                });
                
                $(".fileattach").click(function(){
                    $('input[type="checkbox"]').prop("checked",false);
                });
                
                $("body").on('click','.close',function(){
                    $(this).parent("li").remove();
                });

                $("#compose").validate({
                rules: {
                    subject: "required",
                    email: {
                    required: true
                    }
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

            $('#email').multiple_emails({position: "bottom"});
			
			//Shows the value of the input device, which is in JSON format
			$('#email').change( function(){
				$('#email-ori').val($(this).val());
			});
        });
    </script>
</div>
@endsection