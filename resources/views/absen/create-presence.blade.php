@extends('layouts.main')

@section('container')
<h1 class="mb-10 text-3xl font-bold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-5xl dark:text-white">Tambah Data Presensi Karyawan</h1>
    <div class="w-75 h-75 block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 justify-content-center mb-7">
        <form action="/store-presence" method="POST">
            @csrf
            <div class="form group mb-5">
                <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                <input type="text" name="nama" id="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Nama Karyawan">
            </div>

            <div class="form group mb-5">
                <label for="Shift" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Shift</label>        

                <div class="flex items-center mb-4">
                    <input id="radio-pagi" type="radio" value="Pagi" name="shift" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 mr-1 ml-6" placeholder="Shift">
                    <label for="radio-pagi" class="text-sm font-medium text-gray-900 dark:text-gray-300">Pagi</label>

                    <input id="radio-sore" type="radio" value="Sore" name="shift" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 mr-1 ml-6" placeholder="Shift">
                    <label for="radio-sore" class="text-sm font-medium text-gray-900 dark:text-gray-300">Sore</label>

                    <input id="radio-malam" type="radio" value="Malam" name="shift" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 mr-1 ml-6" placeholder="Shift">
                    <label for="radio-malam" class="text-sm font-medium text-gray-900 dark:text-gray-300">Malam</label>
                </div>
            </div>

            <!--Tanggal-->
            <div class="form group mb-5">
                <label for="Tanggal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal</label>
                <input type="date" name="tgl_absen" id="tanggal" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Tanggal Presensi">
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                // Mendapatkan elemen input untuk tanggal
                var tanggalInput = document.getElementById('tanggal');
                // Mendapatkan tanggal saat ini dalam format YYYY-MM-DD
                var currentDate = new Date().toISOString().split('T')[0];
                // Mengatur nilai input tanggal dengan tanggal saat ini
                tanggalInput.value = currentDate;
                });
            </script>

            <!--DATANG-->
            <div class="form group mb-5">
    <label for="kedatangan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kedatangan</label>
    <!-- Input untuk waktu dengan format lengkap -->
    <input type="text" name="kedatangan" id="kedatangan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-40 p-2.5 ml-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="HH:mm:ss">
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mendapatkan elemen input untuk waktu lengkap
        var waktuInput = document.getElementById('kedatangan');
        // Mendapatkan timestamp saat ini
        var currentTimestamp = new Date();
        // Mendapatkan waktu lengkap dari timestamp saat ini
        var currentTime = ('0' + currentTimestamp.getHours()).slice(-2) + ':' +
                          ('0' + currentTimestamp.getMinutes()).slice(-2) + ':' +
                          ('0' + currentTimestamp.getSeconds()).slice(-2);
        // Mengatur nilai input waktu lengkap dengan waktu lengkap dari timestamp saat ini
        waktuInput.value = currentTime;
    });
</script>

        <!--Pulang-->
            <div class="form group mb-5">
                <label for="pulang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pulang</label>
                <input type="time" name="pulang" id="pulang" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Waktu pulang">
            </div>
            <div class="form group mb-5">
                <label for="keterangan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Keterangan</label>
                <input type="text" name="keterangan" id="keterangan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Keterangan">
            </div>
            <div class="index">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 ">Tambah</button>
            </div>
        </form>
    </div>
@endsection
