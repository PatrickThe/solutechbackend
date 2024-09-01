@extends('layouts.admin')

@section('content')
@can('booking_create')
    
@endcan

<link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet">

<style>
  #loader {
    transition: all 0.3s ease-in-out;
    opacity: 1;
    visibility: visible;
    position: fixed;
    height: 100vh;
    width: 100%;
    background: #fff;
    z-index: 90000;
  }

  #loader.fadeOut {
    opacity: 0;
    visibility: hidden;
  }

  .spinner {
    width: 40px;
    height: 40px;
    position: absolute;
    top: calc(50% - 20px);
    left: calc(50% - 20px);
    background-color: #333;
    border-radius: 100%;
    -webkit-animation: sk-scaleout 1.0s infinite ease-in-out;
    animation: sk-scaleout 1.0s infinite ease-in-out;
  }

  @-webkit-keyframes sk-scaleout {
    0% { -webkit-transform: scale(0) }
    100% {
      -webkit-transform: scale(1.0);
      opacity: 0;
    }
  }

  @keyframes sk-scaleout {
    0% {
      -webkit-transform: scale(0);
      transform: scale(0);
    } 100% {
      -webkit-transform: scale(1.0);
      transform: scale(1.0);
      opacity: 0;
    }
  }
</style>

<div class="card">
    <!--<div class="card-header">-->
    <!--    {{ trans('cruds.booking.title_singular') }} {{ trans('global.list') }}-->
    <!--</div>-->

    <div class="card-body">
        <main class='main-content bgc-grey-100'>
            <div id='mainContent'>
                <div class="container-fluid">
                   
                    <div class="row">
                        <div class="col-md-12">
                            <div class="bgc-white bd bdrs-3 p-20 mB-20">
                                <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                      <tr>
                                        <th width="100px">Booker</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Slots</th>
                                        <th>Date Booked</th>
                                      </tr>
                                    </thead>
                                    <tfoot>
                                      <tr>
                                        <th width="100px">Booker</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Slots</th>
                                        <th>Date Booked</th>
                                      </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($bookings as $booking)
                                      <tr>
                                        <td width="100px">{{$booking->user->name}}<br>({{$booking->user->email}})</td>
                                        <td>{{$booking->ride->name}}</td>
                                        <td>{{$booking->ride->description}}</td>
                                        <td>{{$booking->ride->price}}</td>
                                        <td>{{$booking->ride->slots}}</td>
                                        <td>{{$booking->created_at}}</td>
                                      </tr>
                                      @endforeach
                                     
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

@section('scripts')
@parent
<script>
    $(document).ready(function() {
        // Initialize DataTable
        let table = $('#dataTable').DataTable({
            pageLength: 100,
            initComplete: function () {
                this.api().columns().every(function () {
                    let column = this;
                    let input = $(`<input type="text" placeholder="Search ${$(column.header()).text()}" style="width:120px" />`)
                        .appendTo($(column.header()).empty())
                        .on('keyup change', function () {
                            column.search($(this).val(), false, false).draw();
                        });
                });
            }
        });

        // Adjust table on tab change
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function () {
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        });
    });
</script>
@endsection

@endsection
