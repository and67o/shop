@extends('auth.layouts.layout')

@section('title', 'Продукт ' . $product->name)

@section('content')
    <div class="col-md-12">
        <h1>{{ $product->name }}</h1>
        <table class="table">
            <tbody>
            <tr>
                <th>Поле</th>
                <th>Значение</th>
            </tr>
            <tr>
                <td>ID</td>
                <td>{{ $product->id}}</td>
            </tr>
            <tr>
                <td>Название</td>
                <td>{{ $product->name }}</td>
            </tr>
            <tr>
                <td>Описание</td>
                <td>{{ $product->description }}</td>
            </tr>
            <tr>
                <td>Картинка</td>
                <td><img src="{{\Illuminate\Support\Facades\Storage::url($product->image)}}" height="240px"></td>
            </tr>
            <tr>
                <td>Категория</td>
                <td>{{ $product->category->name }}</td>
            </tr>
            <tr>
                <td>Лейблы</td>
                <td>
                    @if($product->isNew())
                        <span class="badge-success">Новинка</span>
                    @endif
                    @if($product->isHit())
                        <span class="badge-warning">Хит продаж!</span>
                    @endif
                    @if($product->isRecommend())
                        <span class="badge-danger">Рекомендуем</span>
                    @endif
                </td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
