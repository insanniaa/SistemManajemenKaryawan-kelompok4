@extends('layouts.main')


@section('container')

        <h1 class="text-4xl pt-2">Edit Jabatan</h1>
        <form action="{{ route('jabatan.update', $jabatan->id_jabatan) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label for="id_jabatan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ID Jabatan</label>
                <input type="integer" id="id_jabatan" name="id_jabatan"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    value="{{ explode(' ', $jabatan->id_jabatan)[0] }}" required>
            </div>
        
            <div>
                <label for="nama_jabatan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Jabatan</label>
                <input type="text" id="nama_jabatan" name="nama_jabatan"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    value="{{ $jabatan->nama_jabatan }}" required>
            </div>
            <div>
                <label for="gaji_pokok" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gaji Pokok</label>
                <input type="integer" id="gaji_pokok" name="gaji_pokok"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    value="{{ $jabatan->gaji_pokok }}" required>
            </div>
           

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    @endsection
