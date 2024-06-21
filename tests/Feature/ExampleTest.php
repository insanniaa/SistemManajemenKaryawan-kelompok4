<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Karyawan;

class KaryawanControllerTestPathCondition extends TestCase
{
    use RefreshDatabase, WithFaker;

    // Basis Path Testing: Menguji semua jalur eksekusi utama
    public function testIndex()
    {
        $response = $this->get('/karyawan');

        $response->assertStatus(200);
        $response->assertViewIs('personalia.personalia');
    }

    public function testCreate()
    {
        $response = $this->get('/karyawan/create');

        $response->assertStatus(200);
        $response->assertViewIs('personalia.personalia-create');
    }

    public function testStoreValidData()
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
            'nomor_handphone' => '081234567890',
        ];

        $response = $this->post('/karyawan', $requestData);

        $response->assertRedirect('/karyawan');
        $response->assertSessionHas('success', 'Karyawan berhasil ditambahkan.');

        $this->assertDatabaseHas('karyawans', [
            'email' => 'john.doe@example.com',
        ]);
    }

    public function testUpdateValidData()
    {
        // Menyiapkan data karyawan yang akan di-update
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
            'nomor_handphone' => '081234567890',
        ];

        $response = $this->put('/karyawan/' . $karyawan->id, $requestData);

        $response->assertRedirect('/karyawan');
        $response->assertSessionHas('success', 'Karyawan berhasil diperbarui.');

        $this->assertDatabaseHas('karyawans', [
            'id' => $karyawan->id,
            'email' => 'updated.john.doe@example.com',
        ]);
    }

    // Condition Testing: Menguji semua kondisi dalam metode store
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
            'nomor_handphone' => '081234567890',
        ];

        $response = $this->post('/karyawan', $requestData);

        $response->assertSessionHasErrors('first_name');
    }

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
            'nomor_handphone' => '081234567890',
        ];

        $response = $this->post('/karyawan', $requestData);

        $response->assertSessionHasErrors('email');
    }

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
            'nomor_handphone' => '081234567890',
        ];

        $response = $this->post('/karyawan', $requestData);

        $response->assertSessionHasErrors('last_name');
    }

    // Tambahkan lebih banyak tes untuk kondisi lain seperti invalid phone number, dll.

    public function testStoreMissingJabatan()
    {
        $requestData = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'jabatan' => '', // Jabatan kosong
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '1990-01-01',
            'alamat' => 'Jl. Sudirman No. 1',
            'tanggal_bergabung' => '2020-01-01',
            'nomor_rekening' => '1234567890',
            'email' => 'john.doe@example.com',
            'nomor_handphone' => '081234567890',
        ];

        $response = $this->post('/karyawan', $requestData);

        $response->assertSessionHasErrors('jabatan');
    }

    public function testStoreInvalidTanggalBergabung()
    {
        $requestData = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'jabatan' => 'Manager',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '1990-01-01',
            'alamat' => 'Jl. Sudirman No. 1',
            'tanggal_bergabung' => 'invalid-date', // Tanggal bergabung tidak valid
            'nomor_rekening' => '1234567890',
            'email' => 'john.doe@example.com',
            'nomor_handphone' => '081234567890',
        ];

        $response = $this->post('/karyawan', $requestData);

        $response->assertSessionHasErrors('tanggal_bergabung');
    }

    public function testStoreEmptyAlamat()
    {
        $requestData = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'jabatan' => 'Manager',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '1990-01-01',
            'alamat' => '', // Alamat kosong
            'tanggal_bergabung' => '2020-01-01',
            'nomor_rekening' => '1234567890',
            'email' => 'john.doe@example.com',
            'nomor_handphone' => '081234567890',
        ];

        $response = $this->post('/karyawan', $requestData);

        $response->assertSessionHasErrors('alamat');
    }

    public function testStoreInvalidEmailUnique()
    {
        // Menyiapkan data karyawan yang sudah ada di database
        Karyawan::factory()->create([
            'email' => 'john.doe@example.com',
        ]);

        $requestData = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'jabatan' => 'Manager',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '1990-01-01',
            'alamat' => 'Jl. Sudirman No. 1',
            'tanggal_bergabung' => '2020-01-01',
            'nomor_rekening' => '1234567890',
            'email' => 'john.doe@example.com', // Email yang sudah ada di database
            'nomor_handphone' => '081234567890',
        ];

        $response = $this->post('/karyawan', $requestData);

        $response->assertSessionHasErrors('email');
    }

    public function testStoreInvalidNomorRekeningUnique()
    {
        // Menyiapkan data karyawan yang sudah ada di database
        Karyawan::factory()->create([
            'nomor_rekening' => '1234567890',
        ]);

        $requestData = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'jabatan' => 'Manager',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '1990-01-01',
            'alamat' => 'Jl. Sudirman No. 1',
            'tanggal_bergabung' => '2020-01-01',
            'nomor_rekening' => '1234567890', // Nomor rekening yang sudah ada di database
            'email' => 'john.doe@example.com',
            'nomor_handphone' => '081234567890',
        ];

        $response = $this->post('/karyawan', $requestData);

        $response->assertSessionHasErrors('nomor_rekening');
    }

    // Tambahkan lebih banyak tes untuk kondisi lain seperti invalid nomor handphone, dll.

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
            'nomor_handphone' => 'invalid-phone-number', // Nomor handphone tidak valid
        ];

        $response = $this->post('/karyawan', $requestData);

        $response->assertSessionHasErrors('nomor_handphone');
    }

    public function testStoreInvalidTanggalLahir()
    {
        $requestData = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'jabatan' => 'Manager',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => 'invalid-date', // Tanggal lahir tidak valid
            'alamat' => 'Jl. Sudirman No. 1',
            'tanggal_bergabung' => '2020-01-01',
            'nomor_rekening' => '1234567890',
            'email' => 'john.doe@example.com',
            'nomor_handphone' => '081234567890',
        ];

        $response = $this->post('/karyawan', $requestData);

        $response->assertSessionHasErrors('tanggal_lahir');
    }

    public function testStoreInvalidTempatLahir()
    {
        $requestData = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'jabatan' => 'Manager',
            'tempat_lahir' => '', // Tempat lahir kosong
            'tanggal_lahir' => '1990-01-01',
            'alamat' => 'Jl. Sudirman No. 1',
            'tanggal_bergabung' => '2020-01-01',
            'nomor_rekening' => '1234567890',
            'email' => 'john.doe@example.com',
            'nomor_handphone' => '081234567890',
        ];

        $response = $this->post('/karyawan', $requestData);

        $response->assertSessionHasErrors('tempat_lahir');
    }
}
