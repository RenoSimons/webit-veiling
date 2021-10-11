<div class="custom-card mt-4">
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
                <button type="submit" class="button-main ml-2">Place your bid</button>
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

@auth
    <div class="custom-card mt-4">
        <p class="m-0">You currently have {{ Auth::user()->checkIfUserHasBidOnProduct($data->id) }} bids on this product</p>
        <p class="m-0">{{ Auth::user()->getHighestUserBidOnProduct($data->id) }}</p>
    </div>
@endauth