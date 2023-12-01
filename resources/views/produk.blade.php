@extends('layouts.navbar')

@section('content')
    <div class="container">
        <h2>Produk Bos!</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row mt-3">
            <div class="col-md-6">
                <!-- Form Tambah Produk -->
                <form action="{{ route('produk.add') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="nama_produk">Nama Produk:</label>
                        <input type="text" class="form-control" id="nama_produk" name="nama_produk" required>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga:</label>
                        <input type="number" class="form-control" id="harga" name="harga" required>
                    </div>
                    <div class="form-group">
                        <label for="id_kategori">Kategori:</label>
                        <select class="form-control" id="id_kategori" name="id_kategori" required>
                            @foreach($kategoriOptions as $kategoriOption)
                                <option value="{{ $kategoriOption->id }}">{{ $kategoriOption->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah Produk</button>
                </form>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <!-- Tabel Produk -->
                <table class="table">
                    <!-- Bagian-bagian lain dari tabel tetap sama -->
                    <!-- ... -->
                </table>
            </div>
        </div>
    </div>
    

        <div class="row mt-3">
            <div class="col-md-6">
                <!-- Tabel Produk -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($datas as $produk)
                            <tr>
                                <td>{{ $produk->id }}</td>
                                <td>{{ $produk->nama_produk }}</td>
                                <td>{{ $produk->harga }}</td>
                                <td>{{ $produk->nama_kategori }}</td>
                                <td>
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#updateModal{{ $produk->id }}" onclick="fillUpdateForm('{{ $produk->id }}', '{{ $produk->nama_produk }}', '{{ $produk->harga }}', '{{ $produk->id_kategori }}')">
                                        Ubah
                                    </button>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $produk->id }}">
                                        Hapus
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal Ubah -->
                            <div class="modal fade" id="updateModal{{ $produk->id }}" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel{{ $produk->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="updateModalLabel{{ $produk->id }}">Ubah Produk - {{ $produk->id }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('produk.update') }}" method="post">
                                                @csrf
                                                @method('put')
                                                <div class="form-group">
                                                    <label for="id">ID:</label>
                                                    <input type="text" class="form-control" id="id" name="id" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nama_produk">Nama Produk:</label>
                                                    <input type="text" class="form-control" id="nama_produk" name="nama_produk" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="harga">Harga:</label>
                                                    <input type="number" class="form-control" id="harga" name="harga" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="id_kategori">Kategori:</label>
                                                    <select class="form-control" id="id_kategori" name="id_kategori" required>
                                                        @foreach($kategoriOptions as $kategoriOption)
                                                            <option value="{{ $kategoriOption->id }}">{{ $kategoriOption->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Hapus -->
                            <div class="modal fade" id="deleteModal{{ $produk->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $produk->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $produk->id }}">Hapus Produk - {{ $produk->id }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Anda yakin ingin menghapus produk ini?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('produk.delete') }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <input type="hidden" name="id" value="{{ $produk->id }}">
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
