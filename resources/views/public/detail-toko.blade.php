@extends('public.layouts.app')

@section('content')
    <div class="container mt-3">
        <div class="row ">
            {{-- Breadcrumb --}}
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Detail Toko</li>
                </ol>
            </nav>
            <div class="col-md-12 ">
                <div class="card">
                    <div class="card-header">{{ $toko->name }}</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ asset('uploads/logo/' . $toko->logo) }}" alt="" width="250px">
                            </div>
                            <div class="col-md-8">
                                <p>{{ $toko->description }}</p>
                                <p>{{ $toko->address }}</p>

                                <iframe
                                    src="http://maps.google.com/?q={{ $toko->latitude }},{{ $toko->longitude }}&output=embed"
                                    height="300" width="300" frameborder="0"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
