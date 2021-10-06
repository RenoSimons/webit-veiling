<div class="modal fade" id="edit-product-modal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="add-product-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-product-modal-title">Edit product: {{$data->name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('products.update', $data) }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{ method_field('PUT') }}

                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Titel product</label>
                        <input type="text" class="form-control" placeholder="Enter product" value="{{$data->name}}" name="product_title" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Prijs product</label>
                        <input type="float" class="form-control" placeholder="Enter price" name="product_price" value="{{$data->start_price}}" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Sluitingsdatum</label>
                        <input autocomplete="off" id="date" class="form-control" name="end_date" value="{{$data->close_date}}" type="text" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Foto product</label>
                        <br>
                        <input id="gallery-photo-add" accept="image/*" multiple="multiple" name="file" type="file">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

