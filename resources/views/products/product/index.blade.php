<div class="product">
    <img class="" src="{{ asset('img/item.png') }}" alt="{{ $product->description }}">
    <div class="product__info">
        <div class="">
            <p class="">{{$product->name}}</p>
            <div class="">{{$product->price}}</div>
        </div>
        <form action="{{route('basket-add', $product)}}" method="POST">
            <button type="submit" role="button">Add to Cart</button>
            @csrf
        </form>
    </div>
</div>
