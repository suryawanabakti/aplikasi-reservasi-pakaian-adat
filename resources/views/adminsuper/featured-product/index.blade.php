<x-app-layout>


    <section class="section">

        <div class="section-header">
            <h1>Featured Product</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Products</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <x-auth-validation-errors>

                </x-auth-validation-errors>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Featured Product</h4>
                            <div class="card-header-form">
                                <form action="" method="GET">
                                    <select name="user_id" id="" class="form-control">
                                        <option value="">==== FILTER TOKO ====</option>
                                        @foreach ($tokos as $toko)
                                            <option value="{{ $toko->user->id }}">{{ $toko->name }}</option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table  table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Toko</th>
                                            <th>Product</th>
                                            <th>Barang Terjual</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $product['toko']['name'] ?? null }}</td>
                                                <td>{{ $product['name'] ?? null }}</td>
                                                <td>{{ $product['terjual'] ?? 0 }}
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
        <script>
            $('[name="user_id"]').change(function() {
                $(this).closest('form').submit();
            });
        </script>
    </x-slot>
</x-app-layout>
