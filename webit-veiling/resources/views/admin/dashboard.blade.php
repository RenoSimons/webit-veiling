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
    <div class="modal fade" id="add-product-modal" tabindex="-1" role="dialog" aria-labelledby="add-product-modal-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-product-modal-title">Add a new product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('POST') }}

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Titel product</label>
                            <input type="text" class="form-control" placeholder="Enter product" name="product_title" required>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Prijs product</label>
                            <input type="number" class="form-control" placeholder="Enter price" name="product_price" required>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Sluitingsdatum</label>
                            <input autocomplete="off" id="date" class="form-control" name="end_date" type="text" required>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Foto product</label>
                            <br>
                            <input id="gallery-photo-add" accept="image/*" multiple="multiple" name="file" type="file">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
                        
                        <a href="" class="btn btn-info ml-2">Edit</a>
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

