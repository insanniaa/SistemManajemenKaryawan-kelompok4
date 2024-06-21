@extends('layouts.main')

@section('container')
    
        <h1 class="text-4xl pt-2">Tambah Shift</h1>
        <form action="{{ route('shift.store') }}" method="post">
            @csrf
            
            <label for="karyawan_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Karyawan</label>
            <select id="karyawan_id" name="karyawan_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>Pilih Karyawan</option>
                @foreach ($karyawans as $karyawan)
                    <option value="{{ $karyawan->id }}">{{ $karyawan->name }}</option>
                @endforeach
            </select>
            <label for="hari" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hari</label>
            <select id="hari" name="hari" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>Pilih Hari</option>
                <option value="senin">Senin</option>
                <option value="selasa">Selasa</option>
                <option value="rabu">Rabu</option>
                <option value="kamis">Kamis</option>
                <option value="jumat">Jumat</option>
                <option value="sabtu">Sabtu</option>
                <option value="minggu">Minggu</option>
            </select>
            <div>
                <label for="jam_masuk" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jam Masuk</label>
                <input type="time" id="jam_masuk" name="jam_masuk"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                    required>
            </div>
            <div>
                <label for="jam_keluar" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jam Keluar</label>
                <input type="time" id="jam_keluar" name="jam_keluar"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                    required>
            </div>
            <div>
                <button type="submit" class="text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Simpan</button>
            </div>
        </form>
    </div>
@endsection
