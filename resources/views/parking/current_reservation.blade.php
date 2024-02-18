@extends('layout.main')

@section('content')
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
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"
                        class="table primary-table">
                        <thead>
                            <tr>
                                <th style="background-color: #007bff;color: #fff;">No.</th>
                                <th style="background-color: #007bff;color: #fff;">Name</th>
                                <th style="background-color: #007bff;color: #fff;">Vehicle Registration</th>
                                <th style="background-color: #007bff;color: #fff;">Date</th>
                                <th style="background-color: #007bff;color: #fff;">Time From</th>
                                <th style="background-color: #007bff;color: #fff;">Time To</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                            @endphp
                            @forelse ($current_reservation as $data)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->vehicle_number }}</td>
                                <td>{{ $data->date }}</td>
                                <td>{{ $data->time_from }}</td>
                                <td>{{ $data->time_to }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td style="text-align: center;" colspan="7">No data available</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection