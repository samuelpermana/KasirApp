@extends('layouts.navbar')

@section('content')
    <div class="container">
        <h2>Kategori Bos!</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row mt-3">
            <div class="col-md-6">
                <!-- Form Tambah Kategori -->
                <form action="{{ route('kategori.add') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama Kategori:</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah Kategori</button>
                </form>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">

             <!-- Form Cari Kategori -->
             <form action="{{ route('kategori.search') }}" method="get">
                    <div class="form-group">
                        <label for="search">Cari Kategori:</label>
                        <input type="text" class="form-control" id="search" name="search" value="{{ request('search') }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Cari</button>
                </form>
            </div>
        </div>

                <!-- Tabel Kategori -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($datas as $kategori)
                            <tr>
                                <td>{{ $kategori->id }}</td>
                                <td>{{ $kategori->nama }}</td>
                                <td>
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#updateModal{{ $kategori->id }}">
                                        Ubah
                                    </button>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $kategori->id }}">
                                        Hapus
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal Ubah -->
                            <div class="modal fade" id="updateModal{{ $kategori->id }}" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel{{ $kategori->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="updateModalLabel{{ $kategori->id }}">Ubah Kategori - {{ $kategori->id }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('kategori.update') }}" method="post">
                                                @csrf
                                                @method('put')
                                                <input type="hidden" name="id" value="{{ $kategori->id }}">
                                                <div class="form-group">
                                                    <label for="nama">Nama Kategori:</label>
                                                    <input type="text" class="form-control" id="nama" name="nama" value="{{ $kategori->nama }}" required>
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
                            <div class="modal fade" id="deleteModal{{ $kategori->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $kategori->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $kategori->id }}">Hapus Kategori - {{ $kategori->id }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Anda yakin ingin menghapus kategori ini?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('kategori.delete') }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <input type="hidden" name="id" value="{{ $kategori->id }}">
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
