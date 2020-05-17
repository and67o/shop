<div class="product">
    <img class="" src="{{Storage::url($product->image)}}" alt="{{ $product->description }}">
    <div class="product__info">
        <div class="label">
            @if($product->isNew())
                <span class="badge-success">Новинка</span>
            @endif
            @if($product->isHit())
                <span class="badge-warning">Хит продаж!</span>
            @endif
            @if($product->isRecommend())
                <span class="badge-danger">Рекомендуем</span>
            @endif
        </div>
        <div class="">
            <p class="">{{$product->name}}</p>
            <div class="">{{$product->price}}</div>
        </div>
        <form action="{{route('basket-add', $product)}}" method="POST">
            <button type="submit" role="button">Add to Cart</button>
            {{--            <a href="{{route('product', [$product->ca])}}"></a>--}}
            @csrf
        </form>
    </div>
</div>
