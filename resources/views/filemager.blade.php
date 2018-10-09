@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 bread-crump p-0">
            <div class="card-header"><h4>Doc Receipt List</h4></div>
        </div>
    </div>
    <div class="table-responsive pt-1 table-body">
        <form method="GET" action="{{ route('home') }}">
            {!! csrf_field() !!}
            <input type="button" class="btn btn-primary float-right" data-dismiss="modal" id="attach" value="Attach">
            <table class="table" id="files">
                <thead>
                    <tr>
                        <th>Check</th>
                        <th>ShipmentId</th>
                        <th>FileNo</th>
                        <th>Docreceipt</th>
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
<script>
    $(document).ready(function(){
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
                //console.log(attachments);
                $(".attachment").html(attachments);
                return $(this).data("shipment");
            }).get();
        });
    });
</script>
@endsection
