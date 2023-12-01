@extends('layouts.navbar')

@section('content')

    <div class="row">
        <div class="col-md-9">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Kategori</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($datas as $produk)
                        <tr>
                            <td>{{ $produk->nama_produk }}</td>
                            <td>{{ $produk->harga }}</td>
                            <td>{{ $produk->nama_kategori }}</td>
                            <td>
                                <form action="{{ route('add-to-cart') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id_produk" value="{{ $produk->id }}">
                                    <button type="submit" class="btn btn-primary">Tambah ke Keranjang</button>
                                    <input type="number" name="jumlah" value="1" min="1">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-md-3">
            <h2>Keranjang Belanja</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($carts as $cart)
                        <tr>
                            <td>{{ $cart->nama_produk }}</td>
                            <td>{{ $cart->jumlah }}</td>
                            <td>{{ $cart->harga_produk }}</td>
                            <td>{{ $cart->harga_produk * $cart->jumlah }} </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <h4>Total Harga: {{ $totalHarga }}</h4>
            <form id="paymentForm" action="{{ route('complete-transaction') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="inputBayar">Jumlah Bayar:</label>
            <input type="number" class="form-control" id="inputBayar" name="jumlah_bayar" min="0" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="kembalian">Kembalian:</label>
            <span id="kembalian">0</span>
        </div>
        <button type="submit" class="btn btn-success">Selesaikan Transaksi</button>
    </form>
        </div>
    </div>
    <style>
        .list-group {
            padding: 10px;
        }

        .list-group-item {
            cursor: pointer;
        }

        .list-group-item:hover {
            background-color: #f8f9fa; /* Warna latar belakang ketika dihover */
        }
    </style>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
    var inputBayar = document.getElementById('inputBayar');
    var kembalianSpan = document.getElementById('kembalian');

    inputBayar.addEventListener('input', function () {
        var totalHarga = <?php echo json_encode($totalHarga); ?>;
        var bayar = parseFloat(inputBayar.value);
        var kembalian = bayar - totalHarga;
        kembalian = Math.max(kembalian, 0);
        kembalianSpan.textContent = kembalian.toFixed(2);
    });
});
</script>

@endsection
