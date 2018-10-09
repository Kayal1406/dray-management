@extends('layouts.app')
@section('title','Inbox')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 bread-crump p-0">
            <div class="card-header"><h4>Inbox</h4></div>
        </div>
    </div>
      <div class="row">
          @include('layouts.sidebar')
        <div class="col-md-10 read-mail">
          <div class="box box-primary">
            <div class="box-header with-border">
              {{-- <h3 class="box-title info-text p-2">Read Mail</h3> --}}
              <div class="box-tools pull-right">
                <div class="has-feedback">
                  <!--input type="text" class="form-control input-sm" placeholder="Search Mail"-->
                </div>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-read-info">
                <h4 class="info-text p-2"><small>Subject:&nbsp;</small>{!!$message->subject!!}</h4>
                <h6 class="info-text p-2"><small>{{$mail}}:&nbsp;</small>{!!$message->from!!}
                  <span class="mailbox-read-time float-right">{{$message->received_date}}</span></h6>
              </div>
              <!-- /.mailbox-read-info -->
              <div class="mailbox-read-message p-2">
                  {!!$message->body!!}
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">
              <div class="mailbox-controls">
                  {{-- <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm">@if($message->attachment==1)<i class="fa fa-paperclip"></i>@endif</button>
                  </div> --}}
                  <!-- /.btn-group -->
                </div>
                <!-- /.pull-right -->
              </div>
            </div>
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
</div>
<script>
    $(document).ready(function(){
        $.noConflict();
        //Loading Datatable
        var table=$("#inbox").DataTable({
            "dom": '<f<t>ip>'
        }); 
    });
</script>
@endsection