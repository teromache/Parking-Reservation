@extends('layout.main')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Reserve Parking Spot</li>
    </ol>
</nav>


<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h1 class="h3 mb-2 text-gray-800 reserve-title">Reserve Parking Spot</h1>
    </div>

    @if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Sorry!',
            text: '{{ session('error') }}',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    </script>
    @elseif(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'Your booking is success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    </script>
    @endif

    <div class="card-body">
        <div class="card">
            <div class="card-body">

                <!-- Content Row -->
                <div class="container">
                    <div class="row mb-4 justify-content-center">

                        <!-- Small Parking Price -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Small Parking Price</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">RM 3.50 / Hour</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-parking fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Medium Parking Price -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Medium Parking Price</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">RM 4.50 / Hour</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-parking fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Large Parking Price -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Large
                                                Parking Price
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">RM 5.50 /
                                                        Hour
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-parking fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <form id="reserveForm" action="{{ route('reserve.booking') }}" method="post">
                    @csrf
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for=""><i class="fas fa-user"></i> Name:</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for=""><i class="fas fa-car"></i> Vehicle Registration Number:</label>
                            <input type="text" name="vehicle_registration" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class=" col-md-6">
                            <label for=""><i class="fas fa-car-side"></i> Parking Size:</label>
                            <select name="size" id="" class="form-control" required>
                                <option value="">--Please Select--</option>
                                <option value="1">Small</option>
                                <option value="2">Medium</option>
                                <option value="3">Large</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for=""><i class="fas fa-calendar-alt"></i> Date:</label>
                            <input type="date" id="" name="date" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for=""><i class="fas fa-clock"></i> Time From:</label>
                            <input type="time" id="" name="time_from" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for=""><i class="fas fa-clock"></i> Time To:</label>
                            <input type="time" id="" name="time_to" class="form-control" required>
                        </div>
                    </div>

                    <div class="float-left">
                        <button type="submit" class="btn btn-primary btn-md" onclick="confirmReservation()">
                            <i class="fas fa-check"></i> Book Now
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
@endsection
