@extends('layouts.app')

@section('content')
<div class="container">
    <h1 style="letter-spacing: 5px">THANKS FOR PLACING A BID</h1>
    <br>
    <img src="https://picsum.photos/600/400" alt="">
    <br>
    <h4 style="letter-spacing: 5px" class="mt-5">Redirecting immediatly ...</h4>
</div>

<script>
    setTimeout(function() {
        window.location.href = document.referrer
    }, 2000);
</script>
@endsection