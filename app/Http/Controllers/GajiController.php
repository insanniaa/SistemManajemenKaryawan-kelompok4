<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GajiController extends Controller
{
    /**
     * Menampilkan daftar sumber daya.
     */
    public function index(Request $request)
    {
        // Ambil kata kunci pencarian dari permintaan
        $katakunci = $request->katakunci;
        // Tentukan jumlah baris per halaman
        $jumlahbaris = 5;

        // Periksa apakah ada kata kunci pencarian
        if (strlen($katakunci)) {
            // Lakukan query pencarian berdasarkan id_gaji dan nama_karyawan
            $data = Gaji::where('id_gaji', 'like', "%$katakunci%")
                ->orWhere('nama_karyawan', 'like', "%$katakunci%")
                ->paginate($jumlahbaris);
        } else {
            // Jika tidak ada kata kunci pencarian, ambil semua data yang diurutkan berdasarkan id_gaji
            $data = Gaji::orderBy('id_gaji', 'desc')
                ->paginate($jumlahbaris);
        }

        // Kirimkan data ke tampilan untuk ditampilkan
        return view('gaji.index')->with('data', $data);
    }

    /**
     * Menampilkan formulir untuk membuat sumber daya baru.
     */
    public function create()
    {
        // Tampilkan formulir untuk membuat sumber daya baru
        return view('gaji.create');
    }

    /**
     * Menyimpan sumber daya yang baru dibuat.
     */
    public function store(Request $request)
    {
        // Simpan input data ke sesi untuk kemungkinan penggunaan di tampilan
        Session::flash('id_gaji', $request->id_gaji);
        Session::flash('nama_karyawan', $request->nama_karyawan);
        Session::flash('jabatan', $request->jabatan);
        Session::flash('bulan', $request->bulan);
        Session::flash('gaji_pokok', $request->gaji_pokok);
        Session::flash('potongan', $request->potongan);
        Session::flash('total_gaji', $request->total_gaji);

        // Validasi data permintaan yang masuk
        $request->validate([
            'id_gaji' => 'required|numeric|unique:gaji,id_gaji',
            'nama_karyawan' => 'required',
            'jabatan' => 'required',
            'bulan' => 'required',
            'gaji_pokok' => 'required',
            'potongan' => 'required',
            'total_gaji' => 'required',
        ]);

        // Buat array data
        $data = [
            'id_gaji' => $request->id_gaji,
            'nama_karyawan' => $request->nama_karyawan,
            'jabatan' => $request->jabatan,
            'bulan' => $request->bulan,
            'gaji_pokok' => $request->gaji_pokok,
            'potongan' => $request->potongan,
            'total_gaji' => $request->total_gaji,
        ];

        // Buat instance Gaji baru dan simpan ke database
        Gaji::create($data);

        // Alihkan ke halaman indeks setelah penyimpanan berhasil
        return redirect()->to('gaji');
    }

   
    /**
     * Menampilkan formulir untuk mengedit sumber daya tertentu.
     */
    public function edit(string $id)
    {
        // Ambil data untuk id tertentu dari model Gaji
        $data = Gaji::where('id_gaji', $id)->first();

        // Kirimkan data ke tampilan untuk diedit
        return view('gaji.edit')->with('data', $data);
    }

    /**
     * Memperbarui sumber daya tertentu di penyimpanan.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data permintaan yang masuk
        $request->validate([
            'nama_karyawan' => 'required',
            'jabatan' => 'required',
            'bulan' => 'required',
            'gaji_pokok' => 'required',
            'potongan' => 'required',
            'total_gaji' => 'required',
        ]);

        // Buat array data untuk pembaruan
        $data = [
            'nama_karyawan' => $request->nama_karyawan,
            'jabatan' => $request->jabatan,
            'bulan' => $request->bulan,
            'gaji_pokok' => $request->gaji_pokok,
            'potongan' => $request->potongan,
            'total_gaji' => $request->total_gaji,
        ];

        // Perbarui catatan Gaji dalam database berdasarkan id tertentu
        Gaji::where('id_gaji', $id)->update($data);

        // Alihkan ke halaman indeks setelah pembaruan berhasil
        return redirect()->to('gaji');
    }

    /**
     * Menghapus sumber daya tertentu dari penyimpanan.
     */
    public function destroy(string $id)
    {
        // Hapus catatan Gaji dari database berdasarkan id tertentu
        Gaji::where('id_gaji', $id)->delete();

        // Alihkan ke halaman indeks setelah penghapusan berhasil
         return redirect()->to('gaji');
    }
}
