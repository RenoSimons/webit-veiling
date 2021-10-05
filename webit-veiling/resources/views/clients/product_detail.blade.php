@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-8">
            <h1 class="my-3">{{$data->name}}</h1>
            <div class="d-flex white-bg">
                <div class="col-md-6">
                    <img src="{{ '/storage/product_images/' .$data->img_url }}" alt="" class="img-fluid">
                </div>
                <div class="col-md-6 d-flex flex-column justify-content-center">
                    <p class="card-text">Start price: <span class="font-weight-bold">€{{ $data->start_price }}</span></p>
                    <p>{{ $data->description }}</p>
                    <p class="small">Online since: {{ $data->close_date }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">

        </div>
    </div>

    <style>
        .white-bg {
            background-color: white;
            border: 1px solid rgba(0,0,0,0.1);
            border-radius: 5px;
            padding: 10px;
        }
    </style>
@endsection

