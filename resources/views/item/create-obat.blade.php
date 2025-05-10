@extends('layouts.app')

@section('content')
    <h2>Tambah Obat</h2>
    <form action="{{ route('item.store') }}" method="POST">
        @csrf
        <input type="hidden" name="kategori" value="obat">
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Jumlah</label>
            <input type="number" name="jumlah" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Dosis</label>
            <input type="text" name="dosis" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Butuh Resep</label>
            <select name="butuh_resep" class="form-control">
                <option value="Iya">Iya</option>
                <option value="Tidak">Tidak</option>
            </select>
        </div>
        <div class="form-group">
            <label>Tanggal Kadaluarsa</label>
            <input type="date" name="tanggal_kadaluarsa" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection
