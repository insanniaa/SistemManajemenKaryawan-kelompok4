@extends('layouts.main')

@section('container')
<head>
<h1 class="mb-4 text-3xl font-bold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-5xl dark:text-white">Presence</h1>

<div class="flex items-center mb-5">
    <div class="index">
        <a href="{{ route('create-presence') }}" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Tambah Data</a>
    </div>
    <div class="ml-auto">
        <form action="/presence" method="GET" class="flex">
            <label for="search" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cari data presensi</label>
            <input type="search" name="search" id="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <button type="submit" class="ml-2 px-3 py-1 bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm text-white dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Cari</button>
        </form>
    </div>
</div>
</head>

<body>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mx-4">
        <table class="w-full text-sm text-left rtl:text-right text-black-500 dark:text-black-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-1 py-3">
                        No
                    </th>
                    <th scope="col" class="px-3 py-3">
                        Nama
                    </th>
                    <th scope="col" class="px-2 py-3">
                        Shift
                    </th>
                    <th scope="col" class="px-2 py-3">
                        Tanggal
                    </th>
                    <th scope="col" class="px-2 py-3">
                        Jam datang
                    </th>
                    <th scope="col" class="px-2 py-3">
                        Jam Pulang
                    </th>
                    <th scope="col" class="px-2 py-3">
                        Keterangan
                    </th>
                    <th scope="col" class="px-2 py-3">
                        Aksi
                    </th>
                </tr>
            </thead>
            @php
                $id = 1;
            @endphp
            @if ($absen->count())
            @foreach($absen as $a)
                <tr>
                    <td class="px-1 py-3">
                        {{$id++}}
                    </td>
                    <td class="px-3 py-3">
                        {{$a->nama}}
                    </td>
                    <td class="px-2 py-3">
                        {{$a->shift}}
                    </td>
                    <td class="px-2 py-3">
                        {{$a->tgl_absen}}
                    </td>
                    <td class="px-2 py-3">
                        {{$a->kedatangan}}
                    </td>
                    <td class="px-2 py-3">
                        {{$a->pulang}}
                    </td>
                    <td class="px-2 py-3">
                        {{$a->keterangan}}
                    </td>
                    <td class="px-2 py-3">
                        <a href="/show-presence/{{ $a->id }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a> /
                        <a href="/delete-presence/{{ $a->id }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" onclick="return confirm('Apakah Anda yakin ingin menghapus data absen?')">Hapus</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="flex justify-center mt-6">
        {{ $absen->links() }}
    </div>
@else
    <p>Not Found</p>
    @endif
</body>
@endsection