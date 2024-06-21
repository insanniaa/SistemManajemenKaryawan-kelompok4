<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use App\Models\Shift;

class ShiftController extends Controller
{
    public function index()
    {
        $data_shift = Shift::all();

        return view('shift.shift', [
            'title' => 'Data Shift',
            'data_shift' => $data_shift,
        ]);
    }

    public function list()

    {
        $data_shift = Shift::latest()->filter(request(['search', 'id']))->paginate(10)->withQueryString();

        return view('shift.shift', [
            'title' => 'Data Shift',
            'data_shift' => $data_shift,
        ]);
    }

    public function create()
    {
        $karyawans = Karyawan::all();

        return view('shift.create', [
            'title' => 'Create Shift',
            'karyawans' => $karyawans,
        ]);
    }

    public function store(Request $request)
    {
        $this->validateShift($request);

        Shift::create($this->getShiftData($request));

        return redirect('/shift')->with('success', 'Data Shift berhasil ditambahkan.');
    }

    public function edit(Shift $shift)
    {
        return view('shift.edit', [
            'title' => 'Edit Shift',
            'shift' => $shift,

        ]);
    }

    public function update(Request $request, Shift $shift)
    {
        $this->validateShift($request, $shift->id);

        $shift->update($this->getShiftData($request));

        return redirect('/shift')->with('success', 'Data Shift berhasil diperbarui.');
    }

    public function show(Shift $shift)
    {
        return view('shift.show', [
            'title' => 'Detail Shift',
            'shift' => $shift,
            'active' => 'shift',
        ]);
    }

    public function destroy(Shift $shift)
    {
        $shift->delete();

        return redirect('/shift')->with('success', 'Data Shift berhasil dihapus.');
    }

    private function validateShift(Request $request, $id = null)
    {
        $rules = [
            // 'first_name' => 'required|string|max:255',
            // 'last_name' => 'required|string|max:255',
            // 'jabatan' => 'required|string|max:255',
            'hari' => 'required|string|max:255',
            // 'jam_masuk' => 'required|date_format:H:i',
            // 'jam_keluar' => 'required|date_format:H:i|after:start_time',
        ];

        $this->validate($request, $rules);
    }

    private function getShiftData(Request $request)
    {
        // Sesuaikan dengan kolom-kolom yang ada pada model Shift
        return [
            // 'name' => $request->first_name . ' ' . $request->last_name,
            // 'jabatan' => $request->jabatan,
            'karyawan_id' => $request->karyawan_id,
            'hari' => $request->hari,
            'jam_masuk' => $request->jam_masuk,
            'jam_keluar' => $request->jam_keluar,
        ];
    }
}
