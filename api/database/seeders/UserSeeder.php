<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Xóa dữ liệu cũ nếu có
        User::truncate();

        // Tạo admin user
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'address' => 'Hà Nội, Việt Nam',
            'phone' => '0123456789',
        ]);

        // Tạo một số user mẫu
        User::create([
            'first_name' => 'Nguyễn',
            'last_name' => 'Văn An',
            'email' => 'user1@example.com',
            'password' => Hash::make('password'),
            'address' => 'TP. Hồ Chí Minh, Việt Nam',
            'phone' => '0987654321',
        ]);

        User::create([
            'first_name' => 'Trần',
            'last_name' => 'Thị Bình',
            'email' => 'user2@example.com',
            'password' => Hash::make('password'),
            'address' => 'Đà Nẵng, Việt Nam',
            'phone' => '0555666777',
        ]);

        User::create([
            'first_name' => 'Lê',
            'last_name' => 'Minh Chính',
            'email' => 'user3@example.com',
            'password' => Hash::make('password'),
            'address' => 'Cần Thơ, Việt Nam',
            'phone' => '0333444555',
        ]);

        // Tạo thêm 10 user random
        for ($i = 4; $i <= 13; $i++) {
            User::create([
                'first_name' => 'User',
                'last_name' => $i,
                'email' => "user{$i}@example.com",
                'password' => Hash::make('password'),
                'address' => 'Việt Nam',
                'phone' => '09' . str_pad($i, 8, '0', STR_PAD_LEFT),
            ]);
        }

        $this->command->info('Đã tạo ' . User::count() . ' người dùng thành công!');
    }
}
