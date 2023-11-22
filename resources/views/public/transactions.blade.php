@extends('public.layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-3">
            {{-- Breadcrumb --}}
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Transactions</li>
                </ol>
            </nav>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Transactions</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Daftar Produk</th>
                                        <th>Toko</th>
                                        <th>Total bayar</th>
                                        <th>Waktu Pengambilan</th>
                                        <th>Bukti Pembayaran</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $transaction)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <ul>
                                                    @foreach ($transaction->carts as $cart)
                                                        <li>{{ $cart->product->name }} , {{ $cart->jumlah }} pcs.
                                                            <br>{{ $cart->catatan }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td>{{ $transaction->toko->name }}</td>
                                            <td>{{ $transaction->total }}</td>
                                            <td>{{ \Carbon\Carbon::createFromdate($transaction->waktu_pengambilan)->format('d M Y H:i') }}
                                            </td>
                                            <td>
                                                @if ($transaction->bukti_pembayaran)
                                                    <img src="{{ asset('uploads/buktiPembayaran/' . $transaction->bukti_pembayaran) }}"
                                                        alt="" width="150px">
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @if ($transaction->status == 'process')
                                                    <span class=" badge bg-warning"> packing </span>
                                                @endif
                                                @if ($transaction->status == 'success')
                                                    <span class=" badge bg-success"> siap diambil </span>
                                                @endif
                                                @if ($transaction->status == 'decline')
                                                    <span class=" badge bg-danger"> decline </span>
                                                @endif
                                                @if ($transaction->status == 'diterima')
                                                    <span class=" badge bg-primary"> selesai </span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="#"
                                                    onclick='window.open(
                                                    "/transactions/print/{{ $transaction->id }}",
                                                    "_blank",
                                                    "location=yes,height=570,width=800,scrollbars=yes,status=yes,left=100,top=20"
                                                )'
                                                    class="btn btn-sm btn-primary btn-icon"><svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-printer" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path
                                                            d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2">
                                                        </path>
                                                        <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
                                                        <path
                                                            d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z">
                                                        </path>
                                                    </svg></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection

@push('js')
    <script></script>
@endpush
