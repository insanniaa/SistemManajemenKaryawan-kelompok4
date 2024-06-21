@extends('layouts.main')


@section('container')

        <h1 class="text-4xl pt-2 pb-6">Edit Karyawan</h1>
        <form action="{{ route('karyawan.update', ['karyawan' => encrypt($karyawan->id)]) }}" method="POST">
        @csrf
            @method('put')
        
            <div>
                <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First
                    name</label>
                <input type="text" id="first_name" name="first_name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="John" value="{{ explode(' ', $karyawan->name)[0] }}" required>
            </div>
            <div>
                <label for="last_name" class="block mt-3 mb-2 text-sm font-medium text-gray-900 dark:text-white">Last
                    name</label>
                <input type="text" id="last_name" name="last_name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Doe" value="{{ str_replace(explode(' ', $karyawan->name)[0] . ' ', '', $karyawan->name) }}" required>
            </div>
            <div>
                <label for="jabatan" class="block mt-3 mb-2 text-sm font-medium text-gray-900 dark:text-white">Position</label>
                <input type="text" id="jabatan" name="jabatan"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Manager" value="{{ $karyawan->jabatan }}" required>
            </div>
            <div>
                <label for="tempat_lahir" class="block mt-3 mb-2 text-sm font-medium text-gray-900 dark:text-white">City</label>
                <input type="text" id="tempat_lahir" name="tempat_lahir"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Kota Malang" value="{{ $karyawan->tempat_lahir }}" required>
            </div>
            <div>
                <label for="tanggal_lahir" class="block mt-3 mb-2 text-sm font-medium text-gray-900 dark:text-white">Birthday</label>
                <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="01 Januari 1990" value="{{ $karyawan->tanggal_lahir }}" required>
            </div>
            <div>
                <label for="phone" class="block mt-3 mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone
                    Number</label>
                <input type="tel" id="phone" name="nomor_handphone"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="1234-4567-8901" pattern="[0-9]{4}-[0-9]{4}-[0-9]{4}" value="{{ $karyawan->nomor_handphone }}" required>
            </div>
            <div>
                <label for="alamat" class="block mt-3 mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                <input type="text" id="alamat" name="alamat"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Jl. Maju Mundur No 26" value="{{ $karyawan->alamat }}" required>
            </div>
            <div>
                <label for="tanggal_gabung" class="block mt-3 mb-2 text-sm font-medium text-gray-900 dark:text-white">First Day</label>
                <input type="date" id="tanggal_gabung" name="tanggal_bergabung"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="10 Desember 2021" value="{{ $karyawan->tanggal_bergabung }}" required>
            </div>
            <div>
                <label for="nomor_rekening" class="block mt-3 mb-2 text-sm font-medium text-gray-900 dark:text-white">Account Number</label>
                <input type="tel" id="nomor_rekening" name="nomor_rekening"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="0000-0000-0000" value="{{ $karyawan->nomor_rekening }}" required>
            </div>
        <div class="mb-6">
            <label for="email" class="block mt-3 mb-2 text-sm font-medium text-gray-900 dark:text-white">Email
                Address</label>
            <input type="email" id="email" name="email"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="john.doe@company.com" value="{{ $karyawan->email }}" required>
        </div>
        

        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
    </form>
@endsection
