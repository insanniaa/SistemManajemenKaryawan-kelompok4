<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Karyawan;

class KaryawanControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    // Basis Path Testing: Menguji semua jalur eksekusi utama

    /**
     * Menguji halaman indeks karyawan.
     *
     * Menggunakan HTTP GET untuk memastikan halaman karyawan ditampilkan dengan benar.
     * Melakukan assertion terhadap status respons 200 OK dan view 'personalia.personalia'.
     */
    public function testIndex()
    {
        $response = $this->get('/karyawan');

        $response->assertStatus(200);
        $response->assertViewIs('personalia.personalia');
    }

    /**
     * Menguji halaman pembuatan karyawan.
     *
     * Menggunakan HTTP GET untuk memastikan halaman pembuatan karyawan ditampilkan dengan benar.
     * Melakukan assertion terhadap status respons 200 OK dan view 'personalia.personalia-create'.
     */
    public function testCreate()
    {
        $response = $this->get('/karyawan/create');

        $response->assertStatus(200);
        $response->assertViewIs('personalia.personalia-create');
    }

    /**
     * Menguji penambahan data karyawan dengan data valid.
     *
     * Menggunakan HTTP POST untuk menyimpan data karyawan baru dengan data valid.
     * Melakukan assertion terhadap redirect ke halaman '/karyawan' setelah penyimpanan sukses.
     * Melakukan assertion terhadap session flash message 'success' yang sesuai.
     * Melakukan assertion terhadap keberadaan data karyawan baru di dalam database.
     */
   
    public function testStoreValidData(){
        $requestData = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'jabatan' => 'Manager',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '1990-01-01',
            'alamat' => 'Jl. Sudirman No. 1',
            'tanggal_bergabung' => '2020-01-01',
            'nomor_rekening' => '1234567890',
            'email' => 'john.doe@example.com',
            'nomor_handphone' => '0812-3456-7890', 
        ];

        $response = $this->post('/karyawan', $requestData);

        $response->assertRedirect('/karyawan');
        $response->assertSessionHas('success', 'Karyawan berhasil ditambahkan.');

        $this->assertDatabaseHas('karyawans', [
            'name' => 'John Doe',
            'jabatan' => 'Manager',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '1990-01-01',
            'alamat' => 'Jl. Sudirman No. 1',
            'tanggal_bergabung' => '2020-01-01',
            'nomor_rekening' => '1234567890',
            'email' => 'john.doe@example.com',
            'nomor_handphone' => '0812-3456-7890', 
        ]);
    }


    /**
     * Menguji pembaruan data karyawan dengan data valid.
     *
     * Menggunakan HTTP PUT untuk memperbarui data karyawan yang sudah ada.
     * Melakukan assertion terhadap redirect ke halaman '/karyawan' setelah pembaruan sukses.
     * Melakukan assertion terhadap session flash message 'success' yang sesuai.
     * Melakukan assertion terhadap keberadaan data karyawan yang diperbarui di dalam database.
     */
    public function testUpdateValidData()
{
    // Membuat data karyawan baru untuk diupdate
    $karyawan = Karyawan::factory()->create();

    $requestData = [
        'first_name' => 'Updated John',
        'last_name' => 'Doe',
        'jabatan' => 'Senior Manager',
        'tempat_lahir' => 'Jakarta',
        'tanggal_lahir' => '1990-01-01',
        'alamat' => 'Jl. Sudirman No. 1',
        'tanggal_bergabung' => '2020-01-01',
        'nomor_rekening' => '1234567890',
        'email' => 'updated.john.doe@example.com',
        'nomor_handphone' => '0812-3456-7890',
    ];

    // Mengirim permintaan PUT untuk memperbarui data karyawan
    $response = $this->put('/karyawan/' . $karyawan->id, $requestData);

    // Memastikan pengalihan ke halaman '/karyawan' setelah pembaruan berhasil
    $response->assertRedirect('/karyawan');

    // Memastikan bahwa pesan flash session 'success' sesuai
    $response->assertSessionHas('success', 'Karyawan berhasil diperbarui.');

    // Memeriksa keberadaan data karyawan yang diperbarui di dalam database
    $this->assertDatabaseHas('karyawans', [
        'id' => $karyawan->id,
        'name' => 'Updated John Doe',
        'jabatan' => 'Senior Manager',
        'tempat_lahir' => 'Jakarta',
        'tanggal_lahir' => '1990-01-01',
        'alamat' => 'Jl. Sudirman No. 1',
        'tanggal_bergabung' => '2020-01-01',
        'nomor_rekening' => '1234567890',
        'email' => 'updated.john.doe@example.com',
        'nomor_handphone' => '0812-3456-7890',
    ]);
}


    // Condition Testing: Menguji semua kondisi dalam metode store

    /**
     * Menguji penambahan data karyawan dengan field nama depan kosong.
     *
     * Menggunakan HTTP POST untuk menyimpan data karyawan baru dengan field nama depan kosong.
     * Melakukan assertion terhadap keberadaan error session 'first_name'.
     */
    public function testStoreMissingFirstName()
    {
        $requestData = [
            'first_name' => '',
            'last_name' => 'Doe',
            'jabatan' => 'Manager',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '1990-01-01',
            'alamat' => 'Jl. Sudirman No. 1',
            'tanggal_bergabung' => '2020-01-01',
            'nomor_rekening' => '1234567890',
            'email' => 'john.doe@example.com',
            'nomor_handphone' => '0812-3456-7890',
        ];

        $response = $this->post('/karyawan', $requestData);
        $response->assertSessionHasErrors('first_name');
    }

    /**
     * Menguji penambahan data karyawan dengan email tidak valid.
     */
    public function testStoreInvalidEmail()
    {
        $requestData = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'jabatan' => 'Manager',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '1990-01-01',
            'alamat' => 'Jl. Sudirman No. 1',
            'tanggal_bergabung' => '2020-01-01',
            'nomor_rekening' => '1234567890',
            'email' => 'not-an-email',
            'nomor_handphone' => '0812-3456-7890',
        ];

        $response = $this->post('/karyawan', $requestData);
        $response->assertSessionHasErrors('email');
    }

    /**
     * Menguji penambahan data karyawan dengan field nama belakang kosong.
     */
    public function testStoreMissingLastName()
    {
        $requestData = [
            'first_name' => 'John',
            'last_name' => '',
            'jabatan' => 'Manager',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '1990-01-01',
            'alamat' => 'Jl. Sudirman No. 1',
            'tanggal_bergabung' => '2020-01-01',
            'nomor_rekening' => '1234567890',
            'email' => 'john.doe@example.com',
            'nomor_handphone' => '0812-3456-7890',
        ];

        $response = $this->post('/karyawan', $requestData);

        $response->assertSessionHasErrors('last_name');
    }

    /**
     * Menguji penambahan data karyawan dengan field jabatan kosong.
     */
    public function testStoreMissingJabatan()
    {
        $requestData = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'jabatan' => '',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '1990-01-01',
            'alamat' => 'Jl. Sudirman No. 1',
            'tanggal_bergabung' => '2020-01-01',
            'nomor_rekening' => '1234567890',
            'email' => 'john.doe@example.com',
            'nomor_handphone' => '0812-3456-7890',
        ];

        $response = $this->post('/karyawan', $requestData);

        $response->assertSessionHasErrors('jabatan');
    }

    /**
     * Menguji penambahan data karyawan dengan tanggal lahir tidak valid.
     */
    public function testStoreInvalidTanggalLahir()
    {
        $requestData = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'jabatan' => 'Manager',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => 'invalid-date',
            'alamat' => 'Jl. Sudirman No. 1',
            'tanggal_bergabung' => '2020-01-01',
            'nomor_rekening' => '1234567890',
            'email' => 'john.doe@example.com',
            'nomor_handphone' => '0812-3456-7890',
        ];

        $response = $this->post('/karyawan', $requestData);
        $response->assertSessionHasErrors('tanggal_lahir');
    }

    /**
     * Menguji penambahan data karyawan dengan tanggal bergabung tidak valid.
     */
    public function testStoreInvalidTanggalBergabung()
    {
        $requestData = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'jabatan' => 'Manager',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '1990-01-01',
            'alamat' => 'Jl. Sudirman No. 1',
            'tanggal_bergabung' => 'invalid-date',
            'nomor_rekening' => '1234567890',
            'email' => 'john.doe@example.com',
            'nomor_handphone' => '0812-3456-7890',
        ];

        $response = $this->post('/karyawan', $requestData);

        $response->assertSessionHasErrors('tanggal_bergabung');
    }

    /**
     * Menguji penambahan data karyawan dengan nomor rekening tidak valid.
     */
    public function testStoreInvalidNomorRekening()
    {
        $requestData = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'jabatan' => 'Manager',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '1990-01-01',
            'alamat' => 'Jl. Sudirman No. 1',
            'tanggal_bergabung' => '2020-01-01',
            'nomor_rekening' => 'not-a-number',
            'email' => 'john.doe@example.com',
            'nomor_handphone' => '0812-3456-7890',
        ];

        $response = $this->post('/karyawan', $requestData);
        $response->assertSessionHasErrors('nomor_rekening');
    }

    /**
     * Menguji penambahan data karyawan dengan nomor handphone tidak valid.
     */
    public function testStoreInvalidNomorHandphone()
    {
        $requestData = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'jabatan' => 'Manager',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '1990-01-01',
            'alamat' => 'Jl. Sudirman No. 1',
            'tanggal_bergabung' => '2020-01-01',
            'nomor_rekening' => '1234567890',
            'email' => 'john.doe@example.com',
            'nomor_handphone' => 'not-a-phone-number',
        ];

        $response = $this->post('/karyawan', $requestData);

        $response->assertSessionHasErrors('nomor_handphone');
    }

    /**
     * Menguji pembaruan data karyawan dengan email tidak valid.
     */
    public function testUpdateInvalidEmail()
    {
        $karyawan = Karyawan::factory()->create();

        $requestData = [
            'first_name' => 'Updated John',
            'last_name' => 'Doe',
            'jabatan' => 'Senior Manager',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '1990-01-01',
            'alamat' => 'Jl. Sudirman No. 1',
            'tanggal_bergabung' => '2020-01-01',
            'nomor_rekening' => '1234567890',
            'email' => 'not-an-email',
            'nomor_handphone' => '081234567890',
        ];

        $response = $this->put('/karyawan/' . $karyawan->id, $requestData);

        $response->assertSessionHasErrors('email');
    }
}

