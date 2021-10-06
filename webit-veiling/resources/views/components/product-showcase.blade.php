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