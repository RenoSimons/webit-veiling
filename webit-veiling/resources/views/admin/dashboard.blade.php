@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard</h1>
    <!-- Add new product button -->
    <button class="btn btn-info " type="button" data-toggle="modal" data-target="#add-product-modal">Add new product</button>

    <div class="my-3">
        @if($errors->any())
        {!! implode('', $errors->all('<span class="alert alert-danger py-2">:message</span>')) !!}
        @endif

        @if (session('success'))
        <span class="alert alert-success py-2">{{ session('success') }}</span>
        @endif
    </div>

    <!-- Add product Modal -->
    <x-add-product-modal />

    <!-- Overview of all products list -->
    <div class="my-5">
        <h2>Products in offering</h2>
        <ul class="list-group">
            @foreach($data as $product)
            <li class="list-group-item shadow d-flex justify-content-around align-items-center my-3">
                <img src="{{ 'storage/product_images/' .$product->img_url }}" alt="product-image" class="img-fluid w-25">
                <div>
                    <h4>{{ $product->name }}</h4>
                    <p>€{{ $product->start_price }}</p>
                    <p class="small">Online since: {{ $product->close_date }}</p>
                </div>

                <div class="d-flex">
                    <form action="{{ route('products.destroy', $product->id) }}" method="post">
                        @csrf
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger">Remove</button>
                    </form>

                    <button data-toggle="modal" data-target="#edit-product-modal{{$product->id}}" class="btn btn-info ml-2">Edit</button>
                    <x-edit-product-modal :data="$product" />
                </div>
            </li>
            @endforeach
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

@endsection