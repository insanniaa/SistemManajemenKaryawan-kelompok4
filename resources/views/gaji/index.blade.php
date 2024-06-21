@extends('layouts.main')

<!-- START DATA -->
@section('container')
    <div class="my-3 p-3 bg-body rounded shadow-sm">

        <!-- JUDUL PAYROLL -->
        <h1 class="text-4xl pt-2 mb-4">Payroll</h1>

        <!-- FORM PENCARIAN -->
        <div class="pb-3">
            <form class="d-flex" action="{{url('gaji')}}" method="get">
                <input class="form-control me-1" type="search" name="katakunci" 
                value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search">
                <button class="btn btn-secondary" type="submit">Cari</button>
            </form>
        </div>
        
        <!-- TOMBOL TAMBAH DATA -->
        <div class="pb-3">
            <a href='{{url('gaji/create')}}' class="btn btn-primary">+ Tambah Data</a>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="col-md-1">No</th>
                    <th class="col-md-3">Nama Karyawan</th>
                    <th class="col-md-2">Jabatan</th>
                    <th class="col-md-2">Bulan</th>
                    <th class="col-md-2">Gaji Pokok</th>
                    <th class="col-md-2">Potongan Gaji</th>
                    <th class="col-md-2">Total Gaji</th>
                    <th class="col-md-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = $data->firstItem() ?>
                @foreach ($data as $item)
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$item->nama_karyawan}}</td>
                        <td>{{$item->jabatan}}</td>
                        <td>{{$item->bulan}}</td>
                        <td>{{$item->gaji_pokok}}</td>
                        <td>{{$item->potongan}}</td>
                        <td>{{$item->total_gaji}}</td>
                        <td class="d-flex justify-content-between align-items-center">
                            <a href='{{url('gaji/'.$item->id_gaji.'/edit')}}' class="btn btn-warning btn-sm mx-1">Edit</a>
                            <form onsubmit="return confirm('Yakin akan menghapus data?')" class='d-inline' action="{{url('gaji/'.$item->id_gaji)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" name="submit" class="btn btn-danger btn-sm">Del</button>
                            </form>
                        </td>
                    </tr>
                    <?php $i++ ?>
                @endforeach
            </tbody>
        </table>
        {{$data->withQueryString()->links()}}
    </div> 
@endsection
