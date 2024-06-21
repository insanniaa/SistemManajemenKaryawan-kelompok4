@extends('layouts.main')

@section('container')
<div class="grid grid-cols-2 mb-6">
    <h1 class="text-4xl pt-2">{{ $title }}</h1>

    <div class="flex justify-end space-x-4">
        <a href="{{ route('jabatan.create') }}" class="text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Add Jabatan</a>

        <form action="{{ $title === 'Data Jabatan' ? '/jabatan' : '/dashboard/list-jabatan' }}">
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="text" id="default-search" name="search"
                    class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Cari Jabatan" value="{{ request('search') }}">
                <button type="submit"
                    class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
            </div>
        </form>
    </div>
</div>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg mx-4">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-4">
                    ID Jabatan
                </th>
                <th scope="col" class="px-2 py-3">
                    Nama Jabatan
                </th>
                <th scope="col" class="px-2 py-3">
                    Gaji Pokok
                </th>
                <th scope="col" class="px-2 py-3">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data_jabatan as $jabatan)
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-8 py-7 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $jabatan->id_jabatan }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $jabatan->nama_jabatan }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $jabatan->gaji_pokok }}
                    </td>
                    <td class="px-6 py-4">
                        <form action="{{ route('jabatan.edit', $jabatan->id_jabatan) }}" method="GET" class="inline">
                            @csrf
                            <button type="submit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline ml-2"> Edit</button>
                        </form>
                        
                        <form action="{{ url('/jabatan/delete/'.$jabatan->id_jabatan) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline ml-2">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Tidak ada data jabatan</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="flex justify-center mt-6">
    {{ $data_jabatan->links() }}
</div>

@endsection
