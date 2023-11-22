<x-app-layout>
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">Dashboard</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <a href="{{ route('admintoko.products.index') }}"> <i class="fas fa-box"></i></a>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Produk</h4>
                            </div>
                            <div class="card-body">
                                {{ DB::table('products')->where('user_id', auth()->id())->count() }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <a href="{{ route('admintoko.products.index') }}"> <i class="fas fa-exchange-alt"></i></a>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Transaksi</h4>
                            </div>
                            <div class="card-body">
                                {{ $transactions->count() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header d-flext justify-content-between">
                            <h4 class="card-title">Produk yg paling banyak di sewa</h4>
                            <button type="button" data-toggle="modal" data-target="#filterPopuler"
                                class="btn btn-primary">Filter</button>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th width="30px">#</th>
                                        <th>Produk</th>
                                        <th>Tersewa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tbody>
                                    @foreach ($collectPopularProduct as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data['namaProduk'] }}</td>
                                            <td>{{ $data['tersewa'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">


                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-header-action">
                                <button type="button" data-toggle="modal" data-target="#exampleModal"
                                    class="btn btn-primary">Filter</button>
                            </div>

                        </div>
                        <div class="card-body">
                            <div>
                                <canvas id="myChart"></canvas>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>


    </section>

    <x-slot name="modal">
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Filter</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/dashboard" method="GET" class="mb-2">

                            <div class="form-group">
                                <label for="Dari">Dari</label>
                                <input type="date" class="form-control" name="dari">
                            </div>
                            <div class="form-group">
                                <label for="Sampai">Sampai</label>
                                <input type="date" class="form-control" name="sampai">
                            </div>

                            <button type="submit" class="btn btn-primary">Filter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="filterPopuler" tabindex="-1" role="dialog" aria-labelledby="filterPopulerLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="filterPopulerLabel">Filter</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/dashboard" method="GET" class="mb-2">
                            <div class="form-group">
                                <label for="bulan">Bulan</label>
                                <select name="bulan" id="bulan" class="form-control">
                                    <option value="">Semua Bulan</option>
                                    <option value="1" @selected($bulan == '1')>Januari</option>
                                    <option value="2" @selected($bulan == '2')>Februari</option>
                                    <option value="3" @selected($bulan == '3')>Maret</option>
                                    <option value="4" @selected($bulan == '4')>April</option>
                                    <option value="5" @selected($bulan == '5')>Mei</option>
                                    <option value="6" @selected($bulan == '6')>Juni</option>
                                    <option value="7" @selected($bulan == '7')>July</option>
                                    <option value="8" @selected($bulan == '8')>Agustus</option>
                                    <option value="9" @selected($bulan == '9')>September</option>
                                    <option value="10" @selected($bulan == '10')>Oktober</option>
                                    <option value="11" @selected($bulan == '11')>November</option>
                                    <option value="12" @selected($bulan == '12')>Desember</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tahun">Tahun</label>
                                <input type="number" min="2000" class="form-control" name="tahun"
                                    placeholder="Semua Tahun" value="{{ $tahun }}">
                            </div>

                            <button type="submit" class="btn btn-primary">Filter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const labels = [
                @foreach ($transactions as $transaction)
                    '{{ $transaction->created_at->format('d M') }}',
                @endforeach
            ];

            const data = {
                labels: labels,
                datasets: [{
                    label: 'Pemasukan (IDR)',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: [
                        @foreach ($transactions as $transaction)
                            '{{ $transaction->total }}',
                        @endforeach
                    ],
                }]
            };

            const config = {
                type: 'line',
                data: data,
                options: {}
            };

            const myChart = new Chart(
                document.getElementById('myChart'),
                config
            );
        </script>



    </x-slot>
</x-app-layout>
