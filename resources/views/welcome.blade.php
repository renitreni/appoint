@extends('layouts.external')

@section('content')
    <div class="container px-sm-5">
        <div class="d-flex flex-row justify-content-center">
            <div class="mt-5">
                <h1 class="fw-bolder text-center lime-light">Services Available for Appointment</h1>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-6 mb-2">
                <div class="d-flex flex-column">
                    <div class="card shadow h-100">
                        <div class="card-body">
                            <h1 class="card-title fw-bold border-bottom">{{ $business->name }}</h1>
                            <div class="card-text">{!! $business->booking_policy !!}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 mb-2">
                <div class="d-flex flex-column">
                    @foreach($services as $key => $value)
                        <div class="card shadow h-100">
                            <div class="card-body">
                                <h5 class="card-title fw-bolder">{{ $value['name'] }}</h5>
                                <div class="card-text">{!! $value['desc'] !!}</div>
                                <a href="{{ $value['booking_link'] }}" class="btn btn-primary text-white">Book Now</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
