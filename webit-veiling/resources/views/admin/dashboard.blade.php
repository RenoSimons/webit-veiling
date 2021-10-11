@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard</h1>
    <!-- Add new product button -->
    <div class="w-100">
        <div class="my-3 d-md-flex justify-content-between">
            <button class="button-main" type="button" data-toggle="modal" data-target="#add-product-modal">Add new product</button>
            <div class="d-none d-md-flex">
                <img class="change-view-icon d-none" id="large" src="images/large.png" alt="large-view">
                <img class="change-view-icon" id="small" src="images/small.png" alt="small-view">
            </div>
        </div>
    </div>

    <!-- Add product Modal -->
    <x-add-product-modal />

    <!-- Overview of all products list -->
    <div class="my-5">
        <h2>Products in offering</h2>
        <ul class="toggable-list p-0">
            @if(count($data) > 0)
            @foreach($data as $product)
            <li class="dashboard-list-item custom-card d-md-flex justify-content-around align-items-center my-3 p-2">
                    <div class="col-md-4 d-flex justify-content-center">
                        <img src="{{ 'storage/product_images/' .$product->img_url }}" alt="product-image" class="img-fluid d-md-w-25">
                    </div>
                    
                    <div class="col-md-4 text-center">
                        <h4>{{ $product->name }}</h4>
                        <p>€{{ $product->start_price }}</p>
                        <p>Hoogste bod: €{{ $product->highest_offer }}</p>
                        <p class="small">Online since: {{ $product->close_date }}</p>
                    </div>

                    <div class="d-flex justify-content-center col-md-4">
                        <a class="btn btn-warning mr-2" href="{{ route('products.show', $product) }}">Show</a>
                        <button data-toggle="modal" data-target="#edit-product-modal{{$product->id}}" class="btn btn-info">Edit</button>
                        <x-edit-product-modal :data="$product" />
                        <form action="{{ route('products.destroy', $product->id) }}" method="post">
                            @csrf
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-danger ml-2">Remove</button>
                        </form>
                    </div>
             
            </li>
            @endforeach
            @else
            <h4 style="letter-spacing: 1px;">No products added yet...</h4>
            @endif
        </ul>

        <div class="my-2">
            {{ $data->links() }}
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
    $('#date').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        startDate: '+1d'
    });
</script>
<style>
    img {
        max-height: 12.5rem;
    }
</style>
@endsection