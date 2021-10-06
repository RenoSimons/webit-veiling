@extends('layouts.app')

@section('content')
<div class="container d-flex">
    <div class="col-md-8">
        <x-product-showcase :data=$data />
        <x-place-bid-form :data=$data />
    </div>
    <div class="col-md-4">
        <x-product-bid-history :data=$data :bids=$bids/>
    </div>
</div>
@endsection