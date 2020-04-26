@extends('layouts.layout', ['title' =>' Корзина'])

@section('content')
    <div class="container">
        <div class="starter-template">
            <h1>Корзина</h1>
            <p>Оформление заказа</p>
            <div class="panel">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Название</th>
                        <th>Кол-во</th>
                        <th>Цена</th>
                        <th>Стоимость</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($order->products))
                        @foreach($order->products as $product)
                            <tr>
                                <td>
                                    <a href="{{route('product', [$product->id])}}">
                                        <img height="56px" src="{{\Illuminate\Support\Facades\Storage::url($product->image)}}">
                                        {{$product->name}}
                                    </a>
                                </td>
                                <td>
                                    <span class="badge">
                                        {{$product->pivot->count}}
                                    </span>
                                    <div class="btn-group form-inline">
                                        <form action="{{route('basket-remove', [$product])}}" method="POST">
                                            <button type="submit" role="button">-</button>
                                            @csrf
                                        </form>
                                        <form action="{{route('basket-add', [$product])}}" method="POST">
                                            <button type="submit" role="button">+</button>
                                            @csrf
                                        </form>
                                    </div>
                                </td>
                                <td>{{$product->price}}</td>
                                <td>{{$product->getPriceForCount()}}</td>
                            </tr>
                        @endforeach
                    @endif
                    <tr>
                        <td colspan="3">Общая стоимость:</td>
                        <td>{{$order->getFullPrice()}}</td>
                    </tr>
                    </tbody>
                </table>
                <br>
                <div class="btn-group pull-right" role="group">
                    <a type="button" class="btn btn-success" href="{{route('basket-place')}}">Оформить заказ</a>
                </div>
            </div>
        </div>
    </div>
@endsection
