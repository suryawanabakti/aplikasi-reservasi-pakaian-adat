<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Resi</title>
</head>

<body>

    <b>Wisata Adat Kajang</b> <br>
    <small>{{ now()->format('d M Y') }}</small>
    <hr>
    <p style="text-transform: capitalize">Nama : {{ $transaction->user->name }}</p>
    <b>Daftar Produk : </b><br>
    @foreach ($transaction->carts as $cart)
        <span>{{ $cart->product->name }} , {{ $cart->product->price }} * {{ $cart->jumlah }} pcs . :
            {{ number_format($cart->total) }}
        </span> <br>
    @endforeach <br>
    <span>Total Bayar: Rp.{{ number_format($transaction->total) }}</span> <br> <br>
    <span>Waktu Pengambilan : {{ \Carbon\Carbon::createFromDate($transaction->waktu_pengambilan)->format('d M Y H:i') }}
    </span><br>
    <small style="color:red">*Pembeli diharapkan datang tepat waktu, toleransi waktu 15 menit.</small>
    <script>
        window.print()
    </script>
</body>

</html>
