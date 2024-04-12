<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::insert("INSERT INTO `items` (`id`, `title`, `description`, `image`, `use_quantity`, `quantity`, `non_veg`, `price`, `status`, `created_at`, `updated_at`) VALUES
        (1, 'Samosa (2 PCS)', NULL, 'uploads/03-04-2024//5Wc3Jv24XtsfjQ8cEsg4B1fySSyJ95AIZobiGco4.jpg', 0, 0, 0, 36.00, 1, '2024-04-03 15:16:37', '2024-04-03 15:16:37'),
        (2, 'Aloo Paratha (2 PCS)', NULL, 'uploads/03-04-2024//0LypPpvPvUegUmCJ1zGAyYabL8QQ2XaqanTvfWRd.jpg', 0, 0, 0, 60.00, 1, '2024-04-03 15:17:31', '2024-04-03 15:17:31'),
        (3, 'Chicken Tikka Masala', NULL, 'uploads/03-04-2024//iqxuDMpTX4BnnR6kDaDwUXyYrbdVIXyNFkRYuhNr.jpg', 0, 0, 1, 135.00, 1, '2024-04-03 15:18:08', '2024-04-03 15:18:08'),
        (4, 'Saag Paneer', NULL, 'uploads/03-04-2024//PAEYfHi6hyzsjDL01RBoTNRPRvphr5SL7xNWMsMT.jpg', 0, 0, 1, 110.00, 1, '2024-04-03 15:19:10', '2024-04-03 15:19:10'),
        (5, 'Chana (Chole) Masala', NULL, 'uploads/03-04-2024//DzlMb8ZS6b8LJEhC77WYgcHqXafOajTBX1x4MPrb.jpg', 0, 0, 0, 90.00, 1, '2024-04-03 15:20:03', '2024-04-03 15:20:03'),
        (6, 'Rogan Josh', NULL, 'uploads/03-04-2024//DlvskWAjYoed5sdmXDvlvEWPtlYHqJMfL0xOUzc9.jpg', 0, 0, 1, 128.00, 1, '2024-04-03 15:20:53', '2024-04-03 15:20:53'),
        (7, 'Chicken Biryani', NULL, 'uploads/03-04-2024//A8LCNRdhZSzWOLxuWXN8pH1krhr9hkiMlCVd90IP.jpg', 0, 0, 1, 150.00, 1, '2024-04-03 15:22:14', '2024-04-03 15:22:14'),
        (8, 'Aloo gobi', NULL, 'uploads/03-04-2024//0yFoACN2YOkbg4W2n5ihFWZZol2KLs1xIDUd0Grn.jpg', 0, 0, 0, 75.00, 1, '2024-04-03 15:22:33', '2024-04-03 15:22:33'),
        (9, 'Masala Chai', NULL, 'uploads/03-04-2024//EPuXf8y1klySyiMM8vmvM7LJFBvqhplUlXyttqc1.jpg', 0, 0, 0, 25.00, 1, '2024-04-03 15:22:57', '2024-04-03 15:22:57'),
        (10, 'Gulab Jamun', NULL, 'uploads/03-04-2024//HPOz9lUAG60BzXEr6ASFH7sOe4StUKqJqQv2pHDj.jpg', 0, 0, 0, 10.00, 1, '2024-04-03 15:23:26', '2024-04-03 15:23:26'),
        (11, 'Amul Sundae Ice Cream', NULL, 'uploads/03-04-2024//OqbDtcoz0V8seKNJivu9aIvJuqs4Ams5QKsT4C4G.jpg', 1, 0, 0, 35.00, 1, '2024-04-03 15:24:28', '2024-04-03 15:24:28'),
        (12, 'Coca Cola 600ml', NULL, 'uploads/03-04-2024//xykVd85ljNkaQO7wQN984oTKXAi3l1FGvdIxDWRr.jpg', 1, 0, 0, 45.00, 1, '2024-04-03 15:25:56', '2024-04-03 15:25:56');");
    }
}
