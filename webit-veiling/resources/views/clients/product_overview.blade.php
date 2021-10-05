@extends('layouts.app')

@section('content')
<div class="container d-flex">
    <div class="col-md-8">
        <h1 class="my-3">Products for sale</h1>
        <div class="d-flex justify-content-between flex-wrap">
            @foreach($data as $product)
            <div class="card mb-4" style="width:220px">
                <img class="card-img-top" src="{{ 'storage/product_images/' .$product->img_url }}" alt="Card image" style="width:100%">
                <div class="card-body">
                    <h4 class="card-title">{{ $product->name }}</h4>
                    <p class="card-text small font-weight-bold mb-0">Highest bid: {{ $product->highest_offer == null ? "No bids yet" : "€" . $product->highest_offer}}</p>
                    <p class="card-text small font-weight-bold">Start price: €{{ $product->start_price }}</p>
                    <p class="small">Online since: {{ $product->close_date }}</p>
                    <a href="#" class="btn btn-primary">See Product</a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="my-2">
            {{ $data->links() }}
        </div>
    </div>
    <div class="col-md-4">

    </div>
</div>
@endsection