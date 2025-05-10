@extends('layouts.app')

@section('content')
    <h2>Dashboard</h2>

    <p><strong>Logged in as:</strong> {{ ucfirst(Auth::user()->role) }}</p>

    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>

    @php
        use Carbon\Carbon;
        $today = Carbon::today();
    @endphp

    {{-- ======================== OBAT ======================== --}}
    <h3>Obat</h3>
    @if ($obat->isEmpty())
        <p>No obat available.</p>
    @else
        @php $totalObat = 0; @endphp
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Dosis</th>
                    <th>Perlu Resep</th>
                    <th>Tanggal Kadaluarsa</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($obat as $item)
                    @php
                        $isExpired = $item->tanggal_kadaluarsa && Carbon::parse($item->tanggal_kadaluarsa)->lt($today);
                        $isLowStock = $item->jumlah <= 5;
                        $totalObat += $item->harga * $item->jumlah;
                    @endphp
                    <tr @if ($isExpired || $isLowStock) class="table-danger" @endif>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                        <td>{{ ucfirst($item->kategori) }}</td>
                        <td>{{ $item->dosis }}</td>
                        <td>{{ $item->butuh_resep }}</td>
                        <td>{{ $item->tanggal_kadaluarsa }}</td>
                        <td>
                            @if (Auth::user()->role === 'Admin' || Auth::user()->role === 'Pharmacist')
                                <a href="{{ route('item.edit', $item->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{ route('item.destroy', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            @else
                                <span>Akses Ditolak</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="8" class="text-end fw-bold">Total Nilai Inventaris: Rp
                        {{ number_format($totalObat, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
    @endif

    {{-- ======================== PERALATAN ======================== --}}
    <h3>Peralatan</h3>
    @if ($peralatan->isEmpty())
        <p>No peralatan available.</p>
    @else
        @php $totalPeralatan = 0; @endphp
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Departemen</th>
                    <th>Status Operasional</th>
                    <th>Jadwal Pemeliharaan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($peralatan as $item)
                    @php
                        $isLowStock = $item->jumlah <= 5;
                        $totalPeralatan += $item->harga * $item->jumlah;
                    @endphp
                    <tr @if ($isLowStock) class="table-danger" @endif>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                        <td>{{ ucfirst($item->kategori) }}</td>
                        <td>{{ $item->departemen }}</td>
                        <td>{{ $item->status_operasional }}</td>
                        <td>{{ $item->jadwal_pemeliharaan }}</td>
                        <td>
                            @if (Auth::user()->role === 'Admin' || Auth::user()->role === 'Technician')
                                <a href="{{ route('item.edit', $item->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{ route('item.destroy', $item->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            @else
                                <span>Akses Ditolak</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="8" class="text-end fw-bold">Total Nilai Inventaris: Rp
                        {{ number_format($totalPeralatan, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
    @endif

    {{-- ======================== CONSUMABLE ======================== --}}
    <h3>Barang Habis Pakai</h3>
    @if ($consumable->isEmpty())
        <p>No barang habis pakai available.</p>
    @else
        @php $totalConsumable = 0; @endphp
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Jenis Penggunaan</th>
                    <th>Status Sterilisasi</th>
                    <th>Tanggal Kadaluarsa</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($consumable as $item)
                    @php
                        $isExpired = $item->tanggal_kadaluarsa && Carbon::parse($item->tanggal_kadaluarsa)->lt($today);
                        $isLowStock = $item->jumlah <= 5;
                        $totalConsumable += $item->harga * $item->jumlah;
                    @endphp
                    <tr @if ($isExpired || $isLowStock) class="table-danger" @endif>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                        <td>{{ $item->jenis_penggunaan }}</td>
                        <td>{{ $item->status_sterilisasi }}</td>
                        <td>{{ $item->tanggal_kadaluarsa }}</td>
                        <td>
                            @if (Auth::user()->role === 'Admin')
                                <a href="{{ route('item.edit', $item->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{ route('item.destroy', $item->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            @else
                                <span>Akses Ditolak</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="7" class="text-end fw-bold">Total Nilai Inventaris: Rp
                        {{ number_format($totalConsumable, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
    @endif

    <div class="mt-4">
        <h4>Tambah Data</h4>
        @if (Auth::user()->role === 'Admin')
            <a href="{{ route('item.create.obat') }}" class="btn btn-success">Tambah Obat</a>
            <a href="{{ route('item.create.peralatan') }}" class="btn btn-success">Tambah Peralatan</a>
            <a href="{{ route('item.create.consumable') }}" class="btn btn-success">Tambah Barang Habis Pakai</a>
        @elseif (Auth::user()->role === 'Technician')
            <a href="{{ route('item.create.peralatan') }}" class="btn btn-success">Tambah Peralatan</a>
        @elseif (Auth::user()->role === 'Pharmacist')
            <a href="{{ route('item.create.obat') }}" class="btn btn-success">Tambah Obat</a>
        @else
            <span>Akses Ditolak</span>
        @endif
    </div>

@endsection
