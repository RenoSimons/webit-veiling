<div class="custom-card">
    <h1 class="my-3 d-sm-none d-md-block">{{$data->name}}</h1>
    <div class="d-sm-block d-md-flex">
        <div class="col-sm-12 col-md-6">
            <img src="{{ '/storage/product_images/' .$data->img_url }}" alt="" class="img-fluid">
        </div>
        <div class="col-sm-12 col-md-6 d-flex flex-column justify-content-center">
            <p class="card-text">Start price: <span class="font-weight-bold">€{{ $data->start_price + 1}}</span></p>
            <p>{{ $data->description }}</p>
            <p class="small">Closing date: {{ $data->close_date }}</p>
        </div>
    </div>
</div>