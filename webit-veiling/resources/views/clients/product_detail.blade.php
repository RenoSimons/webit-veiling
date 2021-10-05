@extends('layouts.app')

@section('content')
<div class="container d-flex">
    <div class="col-md-8">
        <h1 class="my-3">{{$data->name}}</h1>
        <div class="d-flex white-bg">
            <div class="col-md-6">
                <img src="{{ '/storage/product_images/' .$data->img_url }}" alt="" class="img-fluid">
            </div>
            <div class="col-md-6 d-flex flex-column justify-content-center">
                <p class="card-text">Start price: <span class="font-weight-bold">€{{ $data->start_price + 1}}</span></p>
                <p>{{ $data->description }}</p>
                <p class="small">Closing date: {{ $data->close_date }}</p>
            </div>
        </div>

        <div class="white-bg mt-4">
            @guest
            <h4 class="my-3">Please login to place a bid</h4>
            <a href="/login" class="btn btn-primary">Log in</a>
            @endguest
            @auth
            <h4 class="my-3">Place a bid on {{ $data->name }}</h4>
            <form action="{{ route('place_bid', $data->id) }}" method="POST">
                @csrf
                {{ method_field('POST') }}
                <div class="form-group">
                    <label for="exampleInputEmail1">Enter amount you wish to bid</label>
                    <div class="d-flex">
                        <input type="number" step="0.01" class="form-control w-25" placeholder="Enter number in €" name="user_bid" required>
                        <button type="submit" class="btn btn-primary ml-2">Place your bid</button>
                    </div>
                </div>
            </form>
            <div class="my-4">
                @if($errors->any())
                {!! implode('', $errors->all('<span class="alert alert-danger">:message</span>')) !!}
                @endif
                @endauth
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <h1 class="op-0 my-3">Spacer invisible</h1>
        <div class="white-bg">
            <h4>Bid history for {{ $data->name }}</h4>
            <div>
                @if(count($bids) > 0)
                <ul class="list-group">
                    @foreach($bids as $bid)
                    <li class="list-group-item d-flex justify-content-around align-items-center my-1">
                        <span class="font-weight-bold">€{{ $bid->price }}</span>
                        <span class="small">{{ $bid->created_at }}</span>
                    </li>
                    @endforeach
                    <li class="list-group-item d-flex justify-content-around align-items-center my-1 font-weight-bold">
                        €{{ $data->start_price }}
                    </li>
                </ul>
                @else
                <span class="small">No bids placed yet...</span>
                <p class="mb-0"><span class="small font-weight-bold">Bidding starts from €{{ $data->start_price+1 }}</span></p>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    .white-bg {
        background-color: white;
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: 5px;
        padding: 10px;
    }

    .op-0 {
        opacity: 0;
    }
</style>
@endsection