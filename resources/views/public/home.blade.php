@extends('public.layouts.app')


@section('content')
    <div class="container">

        <div class="row mt-3 mb-4 button-group filter-button-group">
            <div class="col d-flex justify-content-center">
                <a href="/home" class="btn btn-primary mx-1 text-white">All</a>
                @foreach ($categories as $category)
                    <a href="{{ route('home.category', $category->id) }}"
                        class="btn btn-primary mx-1 text-white text-capitalize">{{ $category->name }}</a>
                @endforeach
            </div>
            <form class="d-flex text-center justify-content-center mt-2" method="get" action="">
                <input class="form-control me-2" type="search" placeholder="Cari produk . . . . . . . . ."
                    aria-label="Search" style="width: 500px;" name="search">
            </form>

        </div>

        <div class="row justify-content-center" id="product-list">

            @forelse ($products as $product)
                @if ($product->toko)
                    <div class="col-lg-3  mb-3 col-md-3 {{ $product->category->name }}">
                        <a href="{{ route('public.products.show', $product->id) }}" class="text-decoration-none text-dark">
                            <div class="product-item">
                                <div class="product-img">
                                    <b class="m-2 text-uppercase">{{ $product->toko->name }}</b>
                                    <img width="250px" height="250px" src="{{ asset('uploads/image/' . $product->image) }}"
                                        class=" p-2">
                                </div>
                                <div class="product-content text-center py-3">
                                    <span class="d-block text-uppercase fw-bold">{{ $product->name }}</span>
                                    <span class="d-block">Rp. {{ number_format($product->price) }}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif
            @empty
                <h1>Produk tidak ada !!!</h1>
            @endforelse

            {{ $products->links() }}



        </div>
    </div>
@endsection


@section('modal')
@endsection
