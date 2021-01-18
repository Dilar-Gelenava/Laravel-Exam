<form action="{{ Route('updateProduct') }}" method="post">
    @csrf
    <input type="hidden" name="product_id" value={{ $product->id }}>
    <input type="text" name="title" value={{ $product->title }} placeholder="title" required>
    <textarea type="text" name="description" placeholder="description" required>{{ $product->description }}</textarea>
    <input type="number" name="price" placeholder="price" value={{ $product->price }}>
    <br>
    @foreach($categories as $category)
        @if(in_array($category->id, $product_categories))
            <input type="checkbox" checked name="{{ $category->id }}" value={{ $category->id }}>
        @else
            <input type="checkbox" name="{{ $category->id }}" value={{ $category->id }}>
        @endif
        <a href="{{ Route('getCategoryProducts', ['category_id' => $category->id]) }}">
            <label for="{{ $category->name }}"> {{ $category->name }}</label>
            <br>
        </a>
    @endforeach
    <button type="submit">submit</button>
</form>
