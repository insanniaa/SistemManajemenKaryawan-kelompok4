@extends('layouts.main')


@section('container')

    <div class="grid grid-cols-2 mb-6">
        <h1 class="text-4xl pt-2">{{ $title }}</h1>

        <div class="flex justify-end space-x-4">

            <a href="{{ route('karyawan.create') }}"
                class="flex justify-center align-items-center text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" btn btn-primary>Tambah
                Karyawan</a>

        </div>

    </div>
        
    <form action="/karyawan" class="mb-4 flex w-full justify-between align-items-center gap-2">
        <div class="h-12 border bg-gray-50 rounded-lg flex-1 flex justify-center align-items-center">
            <div class="h-12 w-12 flex justify-center align-items-center">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <input 
                type="text" 
                id="default-search" 
                name="search"
                class="flex-1 border-none"
                style="background: none;"
                placeholder="Cari Karyawan" value="{{ request('search') }}">
        </div>
        <button class="w-32 h-12 text-white rounded-lg btn btn-primary">Search</button>
    </form>



    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mx-4">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-3 py-3 w-1/18" >
                        Nama Karyawan
                    </th>
                    <th scope="col" class="px-3 py-3 w-1/18">
                        Jabatan
                    </th>
                    <th scope="col" class="px-3 py-3 w-2/18" >
                        {{ $title === 'Data Karyawan' ? 'tempat lahir' : '' }}
                    </th>
                    <th scope="col" class="px-3 py-3 w-3/18">
                        {{ $title === 'Data Karyawan' ? 'tanggal lahir' : '' }}
                    </th>
                    <th scope="col" class="px-3 py-3 w-2/18">
                        {{ $title === 'Data Karyawan' ? 'Alamat' : '' }}
                    </th>
                    <th scope="col" class="px-3 py-3 w-3/18">
                        {{ $title === 'Data Karyawan' ? 'nomor handphone' : '' }}
                    </th>
                    <th scope="col" class="px-3 py-3 w-1/18">
                        {{ $title === 'Data Karyawan' ? 'tanggal bergabung' : '' }}
                    </th>
                    <th scope="col" class="px-3 py-3 w-2/18">
                        {{ $title === 'Data Karyawan' ? 'nomor rekening' : '' }}
                    </th>
                    <th scope="col" class="px-3 py-3 w-1/18">
                        {{ $title === 'Data Karyawan' ? 'email' : '' }}
                    </th>
                    <th scope="col" class="px-6 py-3 w-1/18">

                    </th>
                    <th scope="col" class="px-6 py-3 w-1/18">

                    </th>

                </tr>
            </thead>
            @if ($data_karyawan->count())
                <tbody>
                    @foreach ($data_karyawan as $karyawan)
                        <tr
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            
                            <td class="px-3 py-4" >
                                {{ $karyawan->name }}
                            </td>
                            <td class="px-3 py-4">
                                {{ $karyawan->jabatan }}
                            </td>
                            <td class="px-3 py-4">
                                {{ $title === 'Data Karyawan' ? $karyawan->tempat_lahir : '' }}
                            </td>
                            <td class="px-3 py-4">
                                {{ $title === 'Data Karyawan' ? $karyawan->tanggal_lahir : '' }}
                            </td>
                            <td class="px-3 py-4">
                                {{ $title === 'Data Karyawan' ? $karyawan->alamat : '' }}
                            </td>
                            <td class="px-3 py-4">
                                {{ $title === 'Data Karyawan' ? $karyawan->nomor_handphone : '' }}
                            </td>
                            <td class="px-3 py-4">
                                {{ $title === 'Data Karyawan' ? $karyawan->tanggal_bergabung : '' }}
                            </td>
                            <td class="px-3 py-4">
                                {{ $title === 'Data Karyawan' ? $karyawan->nomor_rekening : '' }}
                            </td>
                            <td class="px-3 py-4">
                                {{ $title === 'Data Karyawan' ? $karyawan->email : '' }}
                            </td>
                            <td class="px-6 py-4">
                            <a href="{{ url('karyawan') . '/' . encrypt($karyawan->id) . '/edit' }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Update</a>

                            <td class="px-6 py-4">
                                <form action="{{ url('karyawan') .'/' .encrypt($karyawan->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

        </table>

    </div>


    <div class="flex justify-center mt-6">
        {{ $data_karyawan->links() }}
    </div>
@else
    <p>Not Found</p>
    @endif
@endsection
