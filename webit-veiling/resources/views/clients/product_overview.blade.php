@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-3 w-100">Products for sale</h1>
    <div class="d-md-flex">
        <div class="col-sm-12 col-md-6 col-lg-8">
            <div class="d-flex justify-content-between flex-wrap">
                @foreach($data as $product)
                <div class="custom-card mb-4" id="card-front-page">
                    <a href="{{ route('offer_detail', $product->id) }}" class="pb-2">
                        <img class="card-img-top img-fluid" src="{{ 'storage/product_images/' .$product->img_url }}" alt="Card image" style="max-height: 14rem">
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
            <div class="custom-card">
                <h4>Your current winning bids</h4>
                @guest
                <p>Please create account or log in to see your placed bids</p>
                @endguest

                @auth
                @if(isset($user_bids))
                <ul class="list-group" id="user-bid-list">
                    <div class="d-flex justify-content-between small">
                        <div>Amount</div>
                        <div>Name</div>
                        <div class="mr-3">Delete</div>
                    </div>
                    @foreach($user_bids as $user_bid)
                    <a href="{{ '/offer/' . $user_bid->product_id }}">
                        <li class="list-item bg--green d-flex justify-content-between align-items-center my-1">
                            <span class="font-weight-bold">€{{ $user_bid->price }}</span>
                            <span class="small">{{ $user_bid->name }}</span>
                            <form action="{{ route('delete_bid', $user_bid->id )}}" method="post">
                                @csrf
                                {{ method_field('POST') }}
                                <button type="submit" class="remove-btn">X</button>
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
            <div class="custom-card mt-4">
                <h4>Bid history</h4>
                @if(isset($bid_history))
                <ul class="list-group" id="user-bid-list">
                    @foreach($bid_history as $user_bid)
                    <li class="list-item d-flex justify-content-between align-items-center my-1 bg--primary-subtle2">
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

        @auth
        <div class="custom-card mt-4">
            <h4>Change password</h4>
            <x-change-password />
        </div>
        @endauth
    </div>

</div>
@endsection