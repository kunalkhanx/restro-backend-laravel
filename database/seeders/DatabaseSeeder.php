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

        $user = new \App\Models\User;
        $user->name = 'Admin';
        $user->email = 'admin@example.com';
        $user->password = bcrypt('12345678');
        $user->save();

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


        $waiter = new \App\Models\Waiter;
        $waiter->name = 'Kunal Khan';
        $waiter->sex = 'male';
        $waiter->image = 'uploads/05-04-2024/9ko6bCH2xPuLJCD6rp21PI0jiBddwJeQIiLv9hLE.jpg';
        $waiter->save();

        $waiter = new \App\Models\Waiter;
        $waiter->name = 'Sumana Parvin';
        $waiter->sex = 'female';
        $waiter->image = 'uploads/05-04-2024/KsPRuiGq30bo3pj4EYDtnLoNwmoKHBCmGuDJ3Myu.jpg';
        $waiter->save();

        $waiter = new \App\Models\Waiter;
        $waiter->name = 'Souvik Chandra';
        $waiter->sex = 'male';
        $waiter->image = 'uploads/05-04-2024/9ko6bCH2xPuLJCD6rp21PI0jiBddwJeQIiLv9hLE.jpg';
        $waiter->save();

        $table = new \App\Models\Table;
        $table->table_code = 'Cash';
        $table->seats = 1;
        $table->save();

        $table = new \App\Models\Table;
        $table->table_code = 'A1';
        $table->seats = 4;
        $table->save();

        $table = new \App\Models\Table;
        $table->table_code = 'A2';
        $table->seats = 6;
        $table->save();

        $table = new \App\Models\Table;
        $table->table_code = 'B1';
        $table->seats = 8;
        $table->save();

        $table = new \App\Models\Table;
        $table->table_code = 'B2';
        $table->seats = 2;
        $table->save();

        $table = new \App\Models\Table;
        $table->table_code = 'C2';
        $table->seats = 8;
        $table->save();

        $table = new \App\Models\Table;
        $table->table_code = 'C2';
        $table->seats = 2;
        $table->save();

        $table = new \App\Models\Table;
        $table->table_code = 'C3';
        $table->seats = 2;
        $table->save();

        $table = new \App\Models\Table;
        $table->table_code = 'D1';
        $table->seats = 2;
        $table->save();

        $table = new \App\Models\Table;
        $table->table_code = 'D2';
        $table->seats = 6;
        $table->save();


        $table = new \App\Models\Table;
        $table->table_code = 'D3';
        $table->seats = 6;
        $table->save();


        $setting = new \App\Models\Setting;
        $setting->group = 'TAX';
        $setting->setting_key = 'CGST';
        $setting->setting_value = 0;
        $setting->save();

        $setting = new \App\Models\Setting;
        $setting->group = 'TAX';
        $setting->setting_key = 'SGST';
        $setting->setting_value = 0;
        $setting->save();

        $setting = new \App\Models\Setting;
        $setting->group = 'PAYMENT';
        $setting->setting_key = 'PAYMENT_METHODS';
        $setting->setting_value = json_encode(['Cash', 'UPI', "Card"]);
        $setting->save();
    }
}
