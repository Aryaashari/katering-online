<?php

namespace Database\Seeders;

use App\Models\Paket;
use App\Models\PaketSkema;
use App\Models\Skema;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Rfc4122\UuidV4;
use Ramsey\Uuid\Uuid;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user1 = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
        ]);

        $user2 = User::factory()->create([
            'name' => 'Arya',
            'email' => 'arya@gmail.com',
        ]);

        $role1 = Role::create(['name' => 'admin']);
        $role2 = Role::create(['name' => 'user']);

        $user1->assignRole($role1);
        $user2->assignRole($role2);


        $paket = Paket::create([
            'id' => Uuid::uuid4()->toString(),
            'nama_paket' => 'Paket Katering Hemat',
            'slug' => 'paket-katering-hemat',
            'deskripsi' => 'Tes',
            'thumbnail' => '1.png',
            'foto' => json_encode(['1.png','2.png','3.png'])
        ]);

        $skema1 = Skema::create([
            'id' => UUid::uuid4()->toString(),
            'nama_skema' => 'MINGGUAN',
            'periode_hari' => 7,
            'satuan' => 'Minggu'
        ]);

        $skema2 = Skema::create([
            'id' => UUid::uuid4()->toString(),
            'nama_skema' => 'BULANAN',
            'periode_hari' => 30,
            'satuan' => 'Bulan'
        ]);

        $skema3 = Skema::create([
            'id' => UUid::uuid4()->toString(),
            'nama_skema' => 'TAHUNAN',
            'periode_hari' => 360,
            'satuan' => 'Tahun'
        ]);

        PaketSkema::create([
            'paket_id' => $paket->id,
            'skema_id' => $skema1->id,
            'deskripsi' => 'Paket Katering Hemat Mingguan',
            'harga' => 100000
        ]);

        PaketSkema::create([
            'paket_id' => $paket->id,
            'skema_id' => $skema2->id,
            'deskripsi' => 'Paket Katering Hemat Bulanan',
            'harga' => 300000
        ]);
    }
}
