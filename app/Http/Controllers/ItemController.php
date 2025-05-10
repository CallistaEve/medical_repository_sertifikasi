<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $obat = Item::where('kategori', 'obat')->get();
        $peralatan = Item::where('kategori', 'peralatan')->get();
        $consumable = Item::where('kategori', 'barang_habis_pakai')->get();

        return view('dashboard', compact('obat', 'peralatan', 'consumable'));
    }

    public function create()
    {
        return view('item.create');
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'nama' => 'required|string|max:255',
            'jumlah' => 'required|integer',
            'harga' => 'required|numeric',
            'kategori' => 'required|in:obat,peralatan,barang_habis_pakai', // Ensure category is valid
            'jenis_penggunaan' => 'required_if:kategori,barang_habis_pakai|string', // Required for consumable items
            'status_sterilisasi' => 'required_if:kategori,barang_habis_pakai|string', // Required for consumable items
            'tanggal_kadaluarsa' => 'required_if:kategori,barang_habis_pakai|date', // Only required for consumables
        ]);

        // Menyimpan data item
        $item = new Item();
        $item->nama = $request->nama;
        $item->jumlah = $request->jumlah;
        $item->harga = $request->harga;
        $item->kategori = $request->kategori;

        // Kolom khusus berdasarkan kategori
        switch ($request->kategori) {
            case 'obat':
                $item->dosis = $request->dosis ?? null;
                $item->butuh_resep = $request->butuh_resep ?? null;
                $item->tanggal_kadaluarsa = $request->tanggal_kadaluarsa ?? null; // Optional for obat
                break;

            case 'peralatan':
                $item->departemen = $request->departemen ?? null;
                $item->status_operasional = $request->status_operasional ?? null;
                $item->jadwal_pemeliharaan = $request->jadwal_pemeliharaan ?? null;
                break;

            case 'barang_habis_pakai':
                $item->jenis_penggunaan = $request->jenis_penggunaan;
                $item->status_sterilisasi = $request->status_sterilisasi;
                $item->tanggal_kadaluarsa = $request->tanggal_kadaluarsa;
                break;
        }

        $item->save();

        return redirect()->route('dashboard')->with('success', 'Item berhasil ditambahkan.');
    }

    public function show($id)
    {
        $item = Item::findOrFail($id);
        return view('item.show', compact('item'));
    }

    public function edit($id)
    {
        $item = Item::findOrFail($id);
        return view('item.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        $item->nama = $request->nama;
        $item->jumlah = $request->jumlah;
        $item->harga = $request->harga;
        $item->kategori = $request->kategori;

        // Reset kolom khusus terlebih dahulu agar tidak campur data lama
        $item->dosis = null;
        $item->tanggal_kadaluarsa = null;
        $item->butuh_resep = null;
        $item->departemen = null;
        $item->status_operasional = null;
        $item->jadwal_pemeliharaan = null;
        $item->jenis_penggunaan = null;
        $item->status_sterilisasi = null;

        // Isi ulang berdasarkan kategori
        switch ($request->kategori) {
            case 'obat':
                $item->dosis = $request->dosis;
                $item->tanggal_kadaluarsa = $request->tanggal_kadaluarsa;
                $item->butuh_resep = $request->butuh_resep;
                break;

            case 'peralatan':
                $item->departemen = $request->departemen;
                $item->status_operasional = $request->status_operasional;
                $item->jadwal_pemeliharaan = $request->jadwal_pemeliharaan;
                break;

            case 'barang_habis_pakai':
                $item->jenis_penggunaan = $request->jenis_penggunaan;
                $item->status_sterilisasi = $request->status_sterilisasi;
                $item->tanggal_kadaluarsa = $request->tanggal_kadaluarsa;
                break;
        }

        $item->save();

        return redirect()->route('item.index')->with('success', 'Item berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        return redirect()->route('dashboard')->with('success', 'Item berhasil dihapus.');
    }

    public function createObat()
    {
        return view('item.create-obat');
    }

    public function createPeralatan()
    {
        return view('item.create-peralatan');
    }

    public function createConsumable()
    {
        return view('item.create-consumable');
    }
}
