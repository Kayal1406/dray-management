@extends('layouts.app')
@section('title','Inbox')
@section('content')
<div class="container-fluid">
      <div class="row">
        @include('layouts.sidebar')
        <div class="col-sm-10 mailbox">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title ml-1">Inbox</h3>

              <div class="box-tools pull-right">
                <div class="has-feedback">
                  <!--input type="text" class="form-control input-sm" placeholder="Search Mail"-->
                </div>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped " id="inbox-class">
                  <tbody>
                     @if($paginator->count() > 0)
                        @foreach($paginator as $oMessage)
                        <tr>
                          <td class="mailbox-name"><a href="/showmail/{{$oMessage->id}}">{{$oMessage->from}}</a></td>
                          <td class="mailbox-subject">
                            @if($oMessage->is_read==0)
                              <a href="/showmail/{{$oMessage->id}}" class="font-mail">{{$oMessage->subject}}</a>                            
                            @else
                              <a href="/showmail/{{$oMessage->id}}">{{$oMessage->subject}}</a>                            
                            @endif
                          </td>
                          <td class="mailbox-attachment">@if($oMessage->attachment)<i class="fa fa-paperclip"></i>@endif</td>
                          <td class="mailbox-date">{{$oMessage->received_date}}</td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4">No messages found</td>
                        </tr>
                    @endif
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                  <div class="btn-group px-2">
                      {{ $paginator->links() }}
                  </div>
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
@endsection