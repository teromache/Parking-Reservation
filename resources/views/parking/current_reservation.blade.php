@extends('layout.main')

@section('content')
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<!-- Page Heading -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Current Reservation</li>
    </ol>
</nav>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h1 class="h3 mb-2 text-gray-800 reserve-title">Current Reservation</h1>
    </div>
    <!-- Content Row -->
    <div class="card-body">
        <div class="card">
            <div class="card-body">
                <!-- Content Row -->
                <div class="container">
                    <div class="row mb-4 justify-content-center">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Name</th>
                                            <th>Parking Name</th>
                                            <th>Date</th>
                                            <th>Time From</th>
                                            <th>Time To</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $i = 1;
                                        @endphp
                                        @foreach ($current_reservation as $data)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>$data->name</td>
                                            <td>$data->parkingSpot->name</td>
                                            <td>$data->date</td>
                                            <td>$data->time_from</td>
                                            <td>$data->time_to</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection