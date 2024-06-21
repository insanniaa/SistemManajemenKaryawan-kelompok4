<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;

class KaryawanController extends Controller
{
    public function index()
    {
        $data_karyawan = Karyawan::filter(request(['search', 'id']))->paginate(10)->withQueryString();

        return view('personalia.personalia', [
            'title' => 'Data Karyawan',
            'data_karyawan' => $data_karyawan,
        ]);
    }

    public function list()
    {
        $data_karyawan = Karyawan::latest()->filter(request(['search', 'id']))->paginate(10)->withQueryString();

        return view('personalia.personalia', [
            'title' => 'Karyawan',
            'data_karyawan' => $data_karyawan,
        ]);
    }

    public function create()
    {
        return view('personalia.personalia-create', [
            'title' => 'Karyawan',
        ]);
    }

    public function store(Request $request)
    {
        $this->validateKaryawan($request);

        Karyawan::create($this->getKaryawanData($request));

        return redirect('/karyawan')->with('success', 'Karyawan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        //dd ( decrypt$id);
        $karyawan = Karyawan::findOrFail( decrypt($id));

        return view('personalia.personalia-edit', compact('karyawan'));
    }

    public function update(Request $request, $id)
    {
        $id = decrypt($id); // decrypt the ID first

        $this->validateKaryawan($request, $id);

        $karyawan = Karyawan::findOrFail($id);
        
        // Debugging dd($this->getKaryawanData($request));

        $karyawan->update($this->getKaryawanData($request));

        return redirect('/karyawan')->with('success', 'Karyawan berhasil diperbarui.');
    }

    public function show(Karyawan $karyawan)
    {
        return view('personalia.personalia-edit', [
            'title' => 'Edit Personalia',
            'karyawan' => $karyawan,
            'active' => 'personalia',
        ]);
    }

    public function destroy($id)
    {
        $karyawan = Karyawan::findOrFail( decrypt($id));
        $karyawan->delete();
        

        return redirect('/karyawan')->with('success', 'Karyawan deleted successfully');
    }

    private function validateKaryawan(Request $request, $id = null)
    {
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'nomor_handphone' => 'required|regex:/[0-9]{4}-[0-9]{4}-[0-9]{4}/',
            'alamat' => 'required|string',
            'tanggal_bergabung' => 'required|date',
            'nomor_rekening' => 'required|string',
            'email' => 'required|email|unique:karyawans,email,' . $id,
        ];

        $this->validate($request, $rules);
    }

    private function getKaryawanData(Request $request)
    {
        return [
            'name' => "$request->first_name $request->last_name",
            'email' => $request->email,
            'jabatan' => $request->jabatan,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'tanggal_bergabung' => $request->tanggal_bergabung,
            'nomor_handphone' => $request->nomor_handphone,
            'nomor_rekening' => $request->nomor_rekening,
        ];
    }
}
