@extends('layouts.navbar')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h2>Riwayat Transaksi</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID Transaksi</th>
                        <th>Tanggal Transaksi</th>
                        <th>Total Harga</th>
                        <th>Jumlah Bayar</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($datas as $transaksi)
                        <tr>
                            <td>{{ $transaksi->id }}</td>
                            <td>{{ $transaksi->tanggal_dibuat }}</td>
                            <td>{{ $transaksi->jumlah_biaya_total }}</td>
                            <td>{{ $transaksi->jumlah_bayar }}</td>
                            <td>
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#detailModal{{ $transaksi->id }}">
                                    Lihat Detail
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="detailModal{{ $transaksi->id }}" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="detailModalLabel">Detail Transaksi - {{ $transaksi->id }}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Isi dengan data transaksi yang lebih detail -->
                                                <p>ID Transaksi: {{ $transaksi->id }}</p>
                                                <p>Tanggal Transaksi: {{ $transaksi->tanggal_dibuat }}</p>
                                                <p>Total Harga: {{ $transaksi->jumlah_biaya_total }}</p>
                                                <p>Jumlah Bayar: {{ $transaksi->jumlah_bayar }}</p>
                                                <p>Jumlah Kembalian: {{$transaksi->jumlah_bayar-  $transaksi->jumlah_biaya_total }}</p>

                                                <!-- Tabel untuk menampilkan detail produk -->
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Nama Produk</th>
                                                            <th>Harga Produk</th>
                                                            <!-- Tambahkan kolom-kolom lain jika diperlukan -->
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($details[$transaksi->id] as $detail)
                                                            <tr>
                                                                <td>{{ $detail->nama_produk }}</td>
                                                                <td>{{ $detail->harga_produk }}</td>
                                                                <!-- Tambahkan kolom-kolom lain jika diperlukan -->
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>

                                                <!-- ... -->
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
