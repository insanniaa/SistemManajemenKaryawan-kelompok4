@extends('layouts.main')

@section('container')
    
        <h1 class="text-4xl pt-2">Add Jabatan</h1>
        <form action="{{ route('jabatan.store') }}" method="POST">
            @csrf
            
            <div>
                <label for="id_jabatan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    ID</label>
                <input type="text" id="id_jabatan" name="id_jabatan"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    >
            </div>
            <div>
                <label for="nama_jabatan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Jabatan</label>
                <input type="text" id="NAMA_JABATAN" name="nama_jabatan"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    >
            </div>
            <div>
                <label for="gaji_pokok" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gaji Pokok</label>
                <input type="text" id="gaji_pokok" name="gaji_pokok"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    >
            </div>
           
            <div>
                <button type="submit" class="text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Submit</button>
            </div>
        </form>
    </div>
@endsection
