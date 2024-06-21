<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jabatan;

class JabatanController extends Controller
{
    public function index()
    {
        $data_jabatan = Jabatan::filter(request(['search', 'id']))->paginate(10)->withQueryString();

        return view('jabatan.jabatan', [
            'title' => 'Data Jabatan',
            'data_jabatan' => $data_jabatan,
        ]);
    }

    public function list()
    {
        $data_jabatan = Jabatan::latest()->filter(request(['search', 'id_jabatan']))->paginate(10)->withQueryString();

        return view('jabatan.jabatan', [
            'title' => 'Jabatan',
            'data_jabatan' => $data_jabatan,
        ]);
    }

    public function create()
    {
        return view('jabatan.jabatan-create', [
            'title' => 'Jabatan',
        ]);
    }

    public function store(Request $request)
    {
        $this->validateJabatan($request);
        
        Jabatan::create($this->getJabatanData($request));

        return redirect('/jabatan')->with('success', 'Jabatan berhasil ditambahkan.');
    }

    public function edit($id_jabatan)
{
    $jabatan = Jabatan::find($id_jabatan);
    return view('jabatan.jabatan-edit', [
        'title' => 'Edit Jabatan',
        'jabatan' => $jabatan,
    ]);
}

public function update(Request $request, $id_jabatan)
{
    $this->validateJabatan($request, $id_jabatan);

    $jabatan = Jabatan::find($id_jabatan);
    $jabatan->update($this->getJabatanData($request));

    return redirect('/jabatan')->with('success', 'Data Jabatan berhasil diperbarui.');
}


    public function show(Jabatan $jabatan)
    {
        return view('jabatan.jabatan-edit', [
            'title' => 'Edit Jabatan',
            'jabatan' => $jabatan,
            'active' => 'jabatan',
        ]);
    }

        public function destroy($id_jabatan)
    {
        $jabatan = Jabatan::findOrFail($id_jabatan);
        $jabatan->delete();
        return redirect('/jabatan')->with('success', 'Jabatan deleted successfully');
    }

    public function delete($id_jabatan)
    {
        $jabatan = Jabatan::find($id_jabatan);

        if (!$jabatan) {
            // Handle jika jabatan tidak ditemukan
            return redirect('/jabatan')->with('error', 'Jabatan not found');
        }

        $jabatan->delete();

        return redirect('/jabatan')->with('success', 'Jabatan deleted successfully');
    }

    private function validateJabatan(Request $request, $id = null)
    {
        $rules = [
            'id_jabatan' => 'required|integer',
            'nama_jabatan' => 'required|string|max:255',
            'gaji_pokok' => 'required|integer',
        ];
    
        $this->validate($request, $rules);
    }
    

    private function getJabatanData(Request $request)
    {
        return [
            'id_jabatan'=>$request->id_jabatan,
            'nama_jabatan'=>$request->nama_jabatan,
            'gaji_pokok'=>$request->gaji_pokok,
        ];
    }



}
