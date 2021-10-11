@extends('layouts.app')

@section('content')
<div class="container d-md-flex">
    <div class="col-sm-6 col-md-6 col-lg-8">
        <h1 class="my-3">Products for sale</h1>
        <div class="d-flex justify-content-between flex-wrap">
            @foreach($data as $product)
            <div class="custom-card mb-4" style="width:340px">
                <a href="{{ route('offer_detail', $product->id) }}" class="pb-2">
                    <img class="card-img-top" src="{{ 'storage/product_images/' .$product->img_url }}" alt="Card image" style="width:100%">
                </a>
                <div class="card-body">
                    <h4 class="card-title text-decoration-none">{{ $product->name }}</h4>
                    <p class="card-text small font-weight-bold mb-0">Highest bid: {{ $product->highest_offer == null ? "No bids yet" : "€" . $product->highest_offer}}</p>
                    <p class="card-text small font-weight-bold">Start price: €{{ $product->start_price }}</p>
                    <a href="{{ route('offer_detail', $product->id) }}" class="button-main">See Product</a>
                    <p class="small mb-0 mt-3 font-italic">Closing date: {{ $product->close_date }}</p>
                </div>
            </div>
            @endforeach
        </div>
        <div class="my-2">
            {{ $data->links() }}
        </div>
    </div>
    <div class="col-sm-6 col-md-6 col-lg-4">
        <h1 class="my-3 display-none d-md-block op-0">Hidden spacer</h1>
        <div class="white-bg">
            <h4>Your current winning bids</h4>
            @guest
            <p>Please create account or log in to see your placed bids</p>
            @endguest

            @auth
            @if(isset($user_bids))
            <ul class="list-group" id="user-bid-list">
                @foreach($user_bids as $user_bid)
                <a href="{{ '/offer/' . $user_bid->product_id }}">
                    <li class="list-group-item d-flex justify-content-between align-items-center my-1">
                        <span class="font-weight-bold">€{{ $user_bid->price }}</span>
                        <span class="small">{{ $user_bid->name }}</span>
                        <form action="{{ route('delete_bid', $user_bid->id )}}" method="post">
                            @csrf
                            {{ method_field('POST') }}
                            <button type="submit" class="btn-sm btn-danger">X</button>
                        </form>
                    </li>
                </a>
                @endforeach
            </ul>
            @else
            <p>You currently have no winning bids...</p>
            @endif
            @endauth
        </div>

        @auth
        <div class="white-bg mt-4">
            <h4>Change password</h4>
            <x-change-password />
        </div>
        <div class="white-bg mt-4">
            <h4>Bid history</h4>
            @if(isset($bid_history))
            <ul class="list-group" id="user-bid-list">
                @foreach($bid_history as $user_bid)
                <li class="list-group-item d-flex justify-content-between align-items-center my-1">
                    <span>{{ $loop->index+1 }}.</span>
                    <span class="font-weight-bold">€{{ $user_bid->price }}</span>
                    <span class="small">{{ $user_bid->name }}</span>
                </li>
                @endforeach
            </ul>

            @else
            <p>You have no bids yet...</p>
        </div>
        @endif
        @endauth
    </div>
</div>

<style>
    img {
        max-height: 14rem;
    }

    #user-bid-list {
        overflow-y: scroll;
        height: 365px;
    }
</style>
@endsection