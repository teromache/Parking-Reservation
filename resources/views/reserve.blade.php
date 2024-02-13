@extends('index')

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
        <div class="card-body">
            <div class="card">
                <div class="card-body">

                    <form action="">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="name1"><i class="fas fa-user"></i> Name::</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="name1"><i class="fas fa-car"></i> Vehicle Registration Number:</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="name1"><i class="fas fa-car-side"></i> Parking Size:</label>
                                <select name="size" id="" class="form-control" required>
                                    <option value="">--Please Select--</option>
                                    <option value="small">Small</option>
                                    <option value="medium">Medium</option>
                                    <option value="large">Large</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="name1"><i class="fas fa-calendar-alt"></i> Date:</label>
                                <input type="date" id="" name="date" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="name1"> <i class="fas fa-clock"></i> Time:</label>
                                <input type="time" name="time" class="form-control" required>
                            </div>
                        </div>

                        <div class="float-left">
                            <button type="submit" class="btn btn-primary btn-md">
                                <i class="fas fa-check"></i> Book Now
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
