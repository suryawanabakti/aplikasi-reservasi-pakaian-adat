<x-app-layout>


    <section class="section">

        <div class="section-header">
            <h1>Booking</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Booking</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <x-auth-validation-errors>

                </x-auth-validation-errors>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar Booking</h4>

                        </div>

                        <div class="card-body">
                            <form action="">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="">Mulai</label>
                                        <input required type="date" class="form-control" name="mulai"
                                            value="{{ request('mulai') }}">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="">Sampai</label>
                                        <input required type="date" class="form-control" name="sampai"
                                            value="{{ request('sampai') }}">
                                    </div>
                                    <div class="col">
                                        <button class="btn btn-primary mt-4" type="submit">Filter</button>
                                        <a class="btn btn-primary mt-4"
                                            href="/admintoko/transactions/print?mulai={{ request('mulai') }}&sampai={{ request('sampai') }}">Cetak</a>
                                    </div>

                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table  table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tanggal</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Total bayar</th>
                                            <th>Waktu Pengambilan</th>
                                            <th>Status</th>
                                            <th>Metode</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transactions as $transaction)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $transaction->created_at->format('d M Y') }}</td>
                                                <td>{{ $transaction->user->name ?? null }}</td>
                                                <td>{{ $transaction->user->alamat ?? null }}</td>
                                                <td>Rp.{{ number_format($transaction->total) }}</td>
                                                <td>{{ \Carbon\Carbon::createFromdate($transaction->waktu_pengambilan)->format('d M Y H:i') }}
                                                </td>
                                                <td>
                                                    @if ($transaction->status == 'process')
                                                        <span class=" badge badge-warning"> process </span>
                                                    @endif
                                                    @if ($transaction->status == 'success')
                                                        <span class=" badge badge-primary"> siap diambil </span>
                                                    @endif
                                                    @if ($transaction->status == 'diterima')
                                                        <span class=" badge badge-success"> diterima </span>
                                                    @endif
                                                    @if ($transaction->status == 'decline')
                                                        <span class=" badge badge-danger"> decline </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $transaction->metode }}
                                                </td>
                                                <td>
                                                    @if ($transaction->status == 'success')
                                                        <a href="{{ route('admintoko.transactions.diterima', $transaction->id) }}"
                                                            onclick="return confirm('apakah anda yakin barang ini sudah di kembalikan?')"
                                                            class="btn btn-primary btn-sm">
                                                            Sudah Dikembalikan</a> <br>
                                                    @elseif ($transaction->status !== 'diterima')
                                                        <div class="badge">
                                                            <a href="javascript:void(0)" class="btn btn-info"
                                                                data-toggle="modal"
                                                                data-target="#myModal{{ $transaction->id }}">Detail
                                                                Transaksi</a>
                                                        </div>
                                                    @elseif ($transaction->status == 'diterima')
                                                        <span class="badge badge-success">Sudah Diterima</span>
                                                    @endif
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
    </section>

    <x-slot name="modal">
        <!-- Modal -->
        @foreach ($transactions as $tran)
            <div class="modal fade" id="myModal{{ $tran->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Detail Transaksi </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <ul>
                                @foreach ($tran->carts as $cart)
                                    <li><b>{{ $cart->product->name }} <br> Jumlah: </b> {{ $cart->jumlah }} pcs. <br>
                                        <b>Catatan: </b>
                                        :{{ $cart->catatan ?? 'tidak ada' }}
                                    </li>
                                @endforeach
                            </ul>
                            <a href="/uploads/buktiPembayaran/{{ $tran->bukti_pembayaran }}" target="_blank">
                                <img src="{{ asset('uploads/buktiPembayaran/' . $tran->bukti_pembayaran) }}"
                                    alt="" width="150px">
                            </a>
                        </div>
                        <div class="modal-footer">
                            <a href="{{ route('admintoko.transactions.terima', $tran->id) }}" class="btn btn-success"
                                onclick="return confirm('apakah anda yakin menerima ini?')">
                                Terima</a> <br>
                        </div>
                    </div>

                </div>
            </div>
        @endforeach

    </x-slot>
</x-app-layout>
