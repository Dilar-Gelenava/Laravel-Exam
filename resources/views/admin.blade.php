@extends('layouts.app')

@section('content')
    @if(auth()->id() == 1)
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        @if (auth()->id() == 1)
                            <h1>signed as admin</h1>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <h3>create product:</h3>
                            <form action="{{ Route('addProduct') }}" method="post">
                                @csrf
                                <input type="text" name="title" placeholder="title" required>
                                <textarea type="text" name="description" placeholder="description" required></textarea>
                                <input type="file" name="image" accept="image/png, image/jpeg">
                                <input type="number" name="price" placeholder="price">
                                <br>
                                @foreach($categories as $category)
                                    <input type="checkbox" name="{{ $category->id }}" value={{ $category->id }}>
                                    <label for="{{ $category->name }}"> {{ $category->name }}</label><br>
                                @endforeach
                                <button type="submit">submit</button>
                            </form>

                            <h3>create category:</h3>
                            <form action="{{ Route('addCategory') }}" method="post">
                                @csrf
                                <input type="text" name="name" placeholder="name" required>
                                <button type="submit">submit</button>
                            </form>

                                @foreach($products as $product)
                                    @include('product')
                                @endforeach

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
        <h1>you are not admin</h1>
    @endif
@endsection
