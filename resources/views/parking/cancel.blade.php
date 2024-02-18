@extends('layout.main')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Current Reservation</a></li>
        <li class="breadcrumb-item active" aria-current="page">Cancel Reservation</li>
    </ol>
</nav>


<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h1 class="h3 mb-2 text-gray-800 reserve-title">Cancel Reservation</h1>
    </div>

    <div class="card-body">
        <div class="card">
            <div class="card-body">
                <!-- Content Row -->
                @if (session('no_reservation'))
                <script>
                    Swal.fire({
                        icon: 'warning',
                        title: 'Sorry!',
                        text: 'No reservation found',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    });
                </script>
                @endif
                @if (session('success'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        html: '{{ session('success') }}',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK',
                    })
                </script>
                @endif
                <form id="reserveForm" action="{{ route('cancel.check') }}" method="post">
                    @csrf
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for=""><i class="fas fa-user"></i> Name:</label>
                            <input type="text" name="name" class="form-control" placeholder="e.g Ali bin Abu" required>
                        </div>
                        <div class="col-md-6">
                            <label for=""><i class="fas fa-calendar"></i> Date:</label>
                            <input type="date" name="date" class="form-control" required>
                        </div>
                    </div>
                    <button class="btn btn-success"><i class="fas fa-search"></i> Find</button>
                </form>
                <br>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="background-color: #007bff;color: #fff;">No.</th>
                                <th style="background-color: #007bff;color: #fff;">Name</th>
                                <th style="background-color: #007bff;color: #fff;">Vehicle Registration</th>
                                <th style="background-color: #007bff;color: #fff;">Date</th>
                                <th style="background-color: #007bff;color: #fff;">Time From</th>
                                <th style="background-color: #007bff;color: #fff;">Time To</th>
                                <th style="background-color: #007bff;color: #fff;text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                            @endphp
                            @forelse ($cancel_data as $data)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->vehicle_number }}</td>
                                <td>{{ $data->date }}</td>
                                <td>{{ $data->time_from }}</td>
                                <td>{{ $data->time_to }}</td>
                                <td>
                                    <form id="cancelForm{{ $data->id }}"
                                        action="{{ route('cancel.process', ['id' => $data->id]) }}" method="POST">
                                        @csrf
                                        <center>
                                            <button type="button" class="btn btn-danger cancel-btn">Cancel</button>
                                        </center>
                                    </form>
                                </td>
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var cancelButtons = document.querySelectorAll('.cancel-btn');
        cancelButtons.forEach(function (button) {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                var form = this.closest('form');
                var reservationId = form.getAttribute('id').replace('cancelForm', '');
                Swal.fire({
                    icon: 'warning',
                    title: 'Cancel ?',
                    html: "The reservation will be cancel",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, proceed',
                    cancelButtonText: 'Back'
                })
                    .then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
            });
        });
    });
</script>
@endsection