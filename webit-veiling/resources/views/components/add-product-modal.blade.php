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
                    <button type="submit" class="button-main">Add product</button>
                </div>
            </form>
        </div>
    </div>
</div>
