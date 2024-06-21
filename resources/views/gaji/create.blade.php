@extends('layouts.main');

<!-- START FORM -->
@section('container')

<form action='{{ url('gaji') }}' method='post'>
@csrf
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <a href='{{ url('gaji') }}' class="btn btn-secondary mb-3"><< Kembali</a>
        <h1 class="text-4xl pt-2 mb-4">Add Data</h1>
        <div class="mb-3 row">
            <label for="id_gaji" class="col-sm-2 col-form-label">ID Gaji</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='id_gaji' value="{{Session::get('id_gaji')}}" id="id_gaji">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="nama_karyawan" class="col-sm-2 col-form-label">Nama Karyawan</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='nama_karyawan' value="{{Session::get('nama_karyawan')}}" id="nama_karyawan">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='jabatan' value="{{Session::get('jabatan')}}" id="jabatan">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="bulan" class="col-sm-2 col-form-label">Bulan</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='bulan' value="{{Session::get('bulan')}}" id="bulan">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="gaji_pokok" class="col-sm-2 col-form-label">Gaji Pokok</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='gaji_pokok' value="{{Session::get('gaji_pokok')}}" id="gaji_pokok">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="potongan" class="col-sm-2 col-form-label">Potongan Gaji</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='potongan' value="{{Session::get('potongan')}}" id="potongan">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="total_gaji" class="col-sm-2 col-form-label">Total Gaji</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='total_gaji' value="{{Session::get('total_gaji')}}" id="total_gaji">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="submit" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SIMPAN</button></div>
        </div>
      </form>
    </div>
    <!-- AKHIR FORM -->
@endsection