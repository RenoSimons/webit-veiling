<div class="custom-card">
    <h1 class="my-3 d-sm-none d-md-block">{{$data->name}}</h1>
    <div class="d-sm-block d-md-flex">
        <div class="col-sm-12 col-md-6">
            <img src="{{ '/storage/product_images/' .$data->img_url }}" alt="" class="img-fluid">
        </div>
        <div class="col-sm-12 col-md-6 d-flex flex-column justify-content-center">
            <p class="card-text">Start price: <span class="font-weight-bold">€{{ $data->start_price + 1}}</span></p>
            <p>{{ $data->description }}</p>
            <p class="small">Closing in: <span id="closing-date" data-options="{{ $data->close_date }}"></span></p>
        </div>
    </div>
</div>

<script>
    let close_date = $('#closing-date').data("options");
    // Format and set date
    close_date = close_date.split('/')
    close_date = close_date[2] + '/' + close_date[1] + '/' + close_date[0]
    var countDownDate = new Date(close_date).getTime();


    // Update the count down every 1 second
    var x = setInterval(function() {

        var now = new Date().getTime();
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result
        document.getElementById("closing-date").innerHTML = days + "d " + hours + "h " +
            minutes + "m " + seconds + "s ";

        if (distance < 0) {
            clearInterval(x);
            document.getElementById("closing-date").innerHTML = "EXPIRED";
        }
    }, 1000);
</script>