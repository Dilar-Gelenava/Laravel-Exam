@extends('layouts.app')

@section('content')

    <h3>you have {{ $product_count }} products in cart</h3>
    @foreach($products as $product)
        @include('product')
    @endforeach

@endsection
