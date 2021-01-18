<div style="margin: 20px; border: 2px solid black">
    <form action="{{ Route('viewProduct', ['product_id' => $product->id]) }}">
        <button type="submit">view</button>
    </form>
    @auth()
        @if(isset($in_cart))
            <form action="{{ Route('add_to_cart') }}">
                <input type="hidden" name="product_id" value={{ $product_id }}>
                <button type="submit">add to cart</button>
            </form>
        @else
            <form action="{{ Route('add_to_cart') }}">
                <input type="hidden" name="product_id" value={{ $product_id }}>
                <button type="submit">remove from cart</button>
            </form>
        @endif
    @endauth
    @if(auth()->id() == 1)
        <form action="{{ Route('editProduct') }}" method="post">
            @csrf
            <input type="hidden" name="product_id" value={{ $product->id }}>
            <button type="submit">edit product</button>
        </form>
        <form action="{{ Route('deleteProduct') }}" method="post">
            @csrf
            <input type="hidden" name="product_id" value={{ $product->id }}>
            <button type="submit">delete product</button>
        </form>
    @endif
    <h1>{{ $product->title }}</h1>
    <p>price: {{ $product->price }}</p>
    <p>{{ $product->description }}</p>
    <img src="{{ $product->image_url }}" style="max-width: 200px;" alt="{{ $product->title }}">
    <br>
    <span>categories:</span>
    @foreach($product->categories as $category)
        <li>
            <a href="{{ Route('getCategoryProducts', ['category_id' => $category->id]) }}">{{ $category->name }}</a>
        </li>
    @endforeach
    @auth()
        <form action="{{ Route('addComment') }}" method="post">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <textarea name="body" id="" cols="30" required></textarea>
            <button type="submit">add comment</button>
        </form>
    @endauth
    @foreach($product->comments as $comment)
        @if (!$comment->parent_id)
            <div style="margin: 50px; border: 2px solid black">
                <h5>{{ $comment->user->name }}</h5>
                <p>{{ $comment->created_at->diffForHumans() }}</p>
                <p>{{ $comment->body }}</p>
                @if(auth()->id() == $comment->user_id)
                    <form action="{{ Route('deleteComment') }}" method="post">
                        @csrf
                        <input type="hidden" name="comment_id" value={{ $comment->id }}>
                        <button type="submit">delete comment</button>
                    </form>
                    @auth()
                        <form action="{{ Route('addCommentReply') }}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                            <input type="text" name="body" required>
                            <button type="submit">add reply</button>
                        </form>
                    @endauth
                @endif
                @if ( $comment->replies )
                    @foreach($comment->replies as $reply)
                        <div style="margin: 10px; border: 2px solid black">
                            <h5>{{ $reply->user->name }}</h5>
                            <p>{{ $reply->created_at->diffForHumans() }}</p>
                            <p>{{ $reply->body }}</p>
                            @if(auth()->id() == $reply->user_id)
                                <form action="{{ Route('deleteComment') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="comment_id" value={{ $reply->id }}>
                                    <button type="submit">delete comment</button>
                                </form>
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>
        @endif
    @endforeach
</div>
