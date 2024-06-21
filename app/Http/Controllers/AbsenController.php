<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Karyawan;
use App\Models\absen;

class AbsenController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $absen = Absen::where('nama', 'LIKE', '%' . $request->search . '%')
                ->orWhere('tgl_absen', 'LIKE', '%' . $request->search . '%')
                ->orWhere('id', 'LIKE', '%' . $request->search . '%')
                ->orWhere('shift', 'LIKE', '%' . $request->search . '%')
                ->orWhere('keterangan', 'LIKE', '%' . $request->search . '%')
                ->paginate(10);
        } else {
            $absen = absen::paginate(10);
        }
        return view('absen.presence', compact(['absen']));
    }

    public function createPresence(Request $request)
    {
        return view('absen.create-presence');
    }

    public function storePresence(Request $request)
    {
        Absen::create($request->all());
        return redirect()->route('presence')->with('success', 'Data absen berhasil ditambahkan!');
    }

    public function showPresence($id)
    {
        $absen = Absen::find($id);
        return view('absen.edit-presence', compact('absen'));
    }

    public function editPresence(Request $request, $id)
    {
        $absen = Absen::find($id);
        $absen->update($request->all());
        return redirect()->route('presence')->with('success', 'Data absen berhasil diupdate!');
    }

    public function deletePresence($id)
    {
        $absen = Absen::find($id);
        $absen->delete();
        return redirect()->route('presence')->with('success', 'Data absen berhasil dihapus!');
    }
}
