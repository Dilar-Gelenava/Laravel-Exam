@extends('layouts.app')

@section('content')

    @foreach($products as $product)
        @include('product')
    @endforeach

@endsection
