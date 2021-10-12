<div class="custom-card my-3 mt-md-0">
    <h4>Bid history for {{ $data->name }}</h4>
    <div>
        @if(count($bids) > 0)
        <ul class="list-group">
            @foreach($bids as $bid)
            <li class="list-item d-flex justify-content-around align-items-center my-1">
                <span>{{ $loop->index+1 }}.</span>
                <span class="font-weight-bold">€{{ $bid->price }}</span>
                <span class="small">{{ $bid->created_at }}</span>
            </li>
            @endforeach
        </ul>
        @else
        <span class="small">No bids placed yet...</span>
        <p class="mb-0"><span class="small font-weight-bold">Bidding starts from €{{ $data->start_price+1 }}</span></p>
        @endif
    </div>
</div>