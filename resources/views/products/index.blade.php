@extends('layouts.layout', ['title' =>'Главная страница'])

@section('content')
    <div class="row">
        @foreach ($products as $product)
            @include('.products.product.index')
        @endforeach
    </div>
    {{$products->links()}}
@endsection
