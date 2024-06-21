@extends('layouts.main')


@section('container')


    <div class="grid grid-cols-2 mb-6">
        <h1 class="text-4xl pt-2">Daftar Shift</h1>

        {{-- Tombol Tambah Shift --}}
        <div class="flex justify-end space-x-4">
        
        <a href="{{ route('shift.create') }}" class="text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Tambah Shift</a>
        </div>

        {{-- Tabel Daftar Shift --}}
        
        <div class="relative shadow-md sm:rounded-lg mx-4">
        `<table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nama Shift
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Jabatan
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Hari
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Jam Masuk
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Jam Keluar
                    </th>
                    <th scope="col" class="px-6 py-3">
                        
                    </th>
        
                </tr>
            </thead>
            <tbody>
            
                @forelse($data_shift as $shift)
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $shift->id }}</th>
                        <td class="px-6 py-4">{{ $shift->karyawan->name }}</td>
                        <td class="px-6 py-4">{{ $shift->karyawan->jabatan }}</td>
                        <td class="px-6 py-4">{{ $shift->hari }}</td>
                        <td class="px-6 py-4">{{ $shift->jam_masuk }}</td>
                        <td class="px-6 py-4">{{ $shift->jam_keluar }}</td>
                        <td class="px-6 py-4">
                            {{-- Tombol Edit Shift --}}
                            <a href="{{ route('shift.edit', $shift->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Update</a>
                        </td>
                        <td class="px-6 py-4">
                            {{-- Tombol Hapus Shift --}}
                            <form action="{{ route('shift.destroy', $shift->id) }}" method="post" class="inline">
                                @csrf
                                @method('delete')
                                <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline" onclick="return confirm('Apakah Anda yakin ingin menghapus shift ini?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Not Found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
