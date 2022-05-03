<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //\App\Models\User::factory(1)->create();
        /*DB::table('users')->insert([
            'id' => 99,
            'surname' => 'Admin',
            'lastname' =>'Admin',
            'password' => Hash::make('Admin2022'),
            'number' => '909999999',
            'order' => 99,
            'role_id' => 1,
            'active' => 1,
            'email' => 'admin@artel.uz',
        ]);
        //4101
        DB::table('users')->insert([
            'id' => 1,
            'surname' => 'Рохат',
            'lastname' =>'Зав. Склад',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 1,
            'role_id' => 2,
            'active' => 1,
            'email' => '4101@artel.uz',
        ]);
        DB::table('users')->insert([
            'id' => 101,
            'surname' => 'Рохат',
            'lastname' =>'Управляющий',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 101,
            'role_id' => 7,
            'active' => 1,
            'email' => '4101upr@artel.uz',
        ]);
        DB::table('warehouses')->insert([
            'id' => 1,
            'name' => 'Рохат',
            'Kod' => 4101,
            'user_id' => 1,
            'manager_id' => 51,
            'adress' => 'Рохат',
            'location' => 'Рохат',
            'branchmanager_id' => 101,
        ]);
        //4102
        DB::table('users')->insert([
            'id' => 2,
            'surname' => 'Олмазор',
            'lastname' =>'Зав. Склад',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 2,
            'role_id' => 2,
            'active' => 1,
            'email' => '4102@artel.uz',
        ]);
        DB::table('users')->insert([
            'id' => 102,
            'surname' => 'Олмазор',
            'lastname' =>'Управляющий',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 102,
            'role_id' => 7,
            'active' => 1,
            'email' => '4102upr@artel.uz',
        ]);
        DB::table('warehouses')->insert([
            'id' => 2,
            'name' => 'Олмазор',
            'Kod' => 4102,
            'user_id' => 2,
            'manager_id' => 51,
            'adress' => 'Олмазор',
            'location' => 'Олмазор',
            'branchmanager_id' => 102,
        ]);
        //4103
        DB::table('users')->insert([
            'id' => 3,
            'surname' => 'Тошкент Учтепа',
            'lastname' =>'Зав. Склад',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 3,
            'role_id' => 2,
            'active' => 1,
            'email' => '4103@artel.uz',
        ]);
        DB::table('users')->insert([
            'id' => 103,
            'surname' => 'Тошкент Учтепа',
            'lastname' =>'Управляющий',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 103,
            'role_id' => 7,
            'active' => 1,
            'email' => '4103upr@artel.uz',
        ]);
        DB::table('warehouses')->insert([
            'id' => 3,
            'name' => 'Тошкент Учтепа',
            'Kod' => 4103,
            'user_id' => 3,
            'manager_id' => 51,
            'adress' => 'Олмазор',
            'location' => 'Олмазор',
            'branchmanager_id' => 103,
        ]);
        //4104
        DB::table('users')->insert([
            'id' => 4,
            'surname' => 'Бекобод',
            'lastname' =>'Зав. Склад',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 4,
            'role_id' => 2,
            'active' => 1,
            'email' => '4104@artel.uz',
        ]);
        DB::table('users')->insert([
            'id' => 104,
            'surname' => 'Бекобод',
            'lastname' =>'Управляющий',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 104,
            'role_id' => 7,
            'active' => 1,
            'email' => '4104upr@artel.uz',
        ]);
        DB::table('warehouses')->insert([
            'id' => 4,
            'name' => 'Бекобод',
            'Kod' => 4104,
            'user_id' => 4,
            'manager_id' => 51,
            'adress' => 'Бекобод',
            'location' => 'Бекобод',
            'branchmanager_id' => 104,
        ]);
        //4105
        DB::table('users')->insert([
            'id' => 5,
            'surname' => 'Янгийўл',
            'lastname' =>'Зав. Склад',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 5,
            'role_id' => 2,
            'active' => 1,
            'email' => '4105@artel.uz',
        ]);
        DB::table('users')->insert([
            'id' => 105,
            'surname' => 'Янгийўл',
            'lastname' =>'Управляющий',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 105,
            'role_id' => 7,
            'active' => 1,
            'email' => '4105upr@artel.uz',
        ]);
        DB::table('warehouses')->insert([
            'id' => 5,
            'name' => 'Янгийўл',
            'Kod' => 4105,
            'user_id' => 5,
            'manager_id' => 51,
            'adress' => 'Янгийўл',
            'location' => 'Янгийўл',
            'branchmanager_id' => 105,
        ]);
        //4106
        DB::table('users')->insert([
            'id' => 6,
            'surname' => 'Олмалик',
            'lastname' =>'Зав. Склад',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 6,
            'role_id' => 2,
            'active' => 1,
            'email' => '4106@artel.uz',
        ]);
        DB::table('users')->insert([
            'id' => 106,
            'surname' => 'Олмалик',
            'lastname' =>'Управляющий',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 106,
            'role_id' => 7,
            'active' => 1,
            'email' => '4106upr@artel.uz',
        ]);
        DB::table('warehouses')->insert([
            'id' => 6,
            'name' => 'Олмалик',
            'Kod' => 4106,
            'user_id' => 6,
            'manager_id' => 51,
            'adress' => 'Олмалик',
            'location' => 'Олмалик',
            'branchmanager_id' => 106,
        ]);
        //4107
        DB::table('users')->insert([
            'id' => 7,
            'surname' => 'Ангрен',
            'lastname' =>'Зав. Склад',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 7,
            'role_id' => 2,
            'active' => 1,
            'email' => '4107@artel.uz',
        ]);
        DB::table('users')->insert([
            'id' => 107,
            'surname' => 'Ангрен',
            'lastname' =>'Управляющий',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 107,
            'role_id' => 7,
            'active' => 1,
            'email' => '4107upr@artel.uz',
        ]);
        DB::table('warehouses')->insert([
            'id' => 7,
            'name' => 'Ангрен',
            'Kod' => 4107,
            'user_id' => 7,
            'manager_id' => 51,
            'adress' => 'Ангрен',
            'location' => 'Ангрен',
            'branchmanager_id' => 107,
        ]);
        //4108
        DB::table('users')->insert([
            'id' => 8,
            'surname' => 'Гулистон',
            'lastname' =>'Зав. Склад',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 8,
            'role_id' => 2,
            'active' => 1,
            'email' => '4108@artel.uz',
        ]);
        DB::table('users')->insert([
            'id' => 108,
            'surname' => 'Гулистон',
            'lastname' =>'Управляющий',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 108,
            'role_id' => 7,
            'active' => 1,
            'email' => '4108upr@artel.uz',
        ]);
        DB::table('warehouses')->insert([
            'id' => 8,
            'name' => 'Гулистон',
            'Kod' => 4108,
            'user_id' => 8,
            'manager_id' => 51,
            'adress' => 'Гулистон',
            'location' => 'Гулистон',
            'branchmanager_id' => 108,
        ]);
        //4109
        DB::table('users')->insert([
            'id' => 9,
            'surname' => 'Жиззах',
            'lastname' =>'Зав. Склад',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 9,
            'role_id' => 2,
            'active' => 1,
            'email' => '4109@artel.uz',
        ]);
        DB::table('users')->insert([
            'id' => 109,
            'surname' => 'Жиззах',
            'lastname' =>'Управляющий',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 109,
            'role_id' => 7,
            'active' => 1,
            'email' => '4109upr@artel.uz',
        ]);
        DB::table('warehouses')->insert([
            'id' => 9,
            'name' => 'Жиззах',
            'Kod' => 4109,
            'user_id' => 9,
            'manager_id' => 51,
            'adress' => 'Жиззах',
            'location' => 'Жиззах',
            'branchmanager_id' => 109,
        ]);
        //4110
        DB::table('users')->insert([
            'id' => 10,
            'surname' => 'Самарқанд',
            'lastname' =>'Зав. Склад',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 10,
            'role_id' => 2,
            'active' => 1,
            'email' => '4110@artel.uz',
        ]);
        DB::table('users')->insert([
            'id' => 110,
            'surname' => 'Самарқанд',
            'lastname' =>'Управляющий',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 110,
            'role_id' => 7,
            'active' => 1,
            'email' => '4110upr@artel.uz',
        ]);
        DB::table('warehouses')->insert([
            'id' => 10,
            'name' => 'Самарқанд',
            'Kod' => 4110,
            'user_id' => 10,
            'manager_id' => 51,
            'adress' => 'Самарқанд',
            'location' => 'Самарқанд',
            'branchmanager_id' => 110,
        ]);
        //4111
        DB::table('users')->insert([
            'id' => 11,
            'surname' => 'Каттақўрғон',
            'lastname' =>'Зав. Склад',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 11,
            'role_id' => 2,
            'active' => 1,
            'email' => '4111@artel.uz',
        ]);
        DB::table('users')->insert([
            'id' => 111,
            'surname' => 'Каттақўрғон',
            'lastname' =>'Управляющий',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 111,
            'role_id' => 7,
            'active' => 1,
            'email' => '4111upr@artel.uz',
        ]);
        DB::table('warehouses')->insert([
            'id' => 11,
            'name' => 'Каттақўрғон',
            'Kod' => 4111,
            'user_id' => 11,
            'manager_id' => 51,
            'adress' => 'Каттақўрғон',
            'location' => 'Каттақўрғон',
            'branchmanager_id' => 111,
        ]);
        //4112
        DB::table('users')->insert([
            'id' => 12,
            'surname' => 'Коканд',
            'lastname' =>'Зав. Склад',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 12,
            'role_id' => 2,
            'active' => 1,
            'email' => '4112@artel.uz',
        ]);
        DB::table('users')->insert([
            'id' => 112,
            'surname' => 'Коканд',
            'lastname' =>'Управляющий',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 112,
            'role_id' => 7,
            'active' => 1,
            'email' => '4112upr@artel.uz',
        ]);
        DB::table('warehouses')->insert([
            'id' => 12,
            'name' => 'Коканд',
            'Kod' => 4112,
            'user_id' => 12,
            'manager_id' => 51,
            'adress' => 'Коканд',
            'location' => 'Коканд',
            'branchmanager_id' => 112,
        ]);
        //4113
        DB::table('users')->insert([
            'id' => 13,
            'surname' => 'Фарғона',
            'lastname' =>'Зав. Склад',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 13,
            'role_id' => 2,
            'active' => 1,
            'email' => '4113@artel.uz',
        ]);
        DB::table('users')->insert([
            'id' => 113,
            'surname' => 'Фарғона',
            'lastname' =>'Управляющий',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 113,
            'role_id' => 7,
            'active' => 1,
            'email' => '4113upr@artel.uz',
        ]);
        DB::table('warehouses')->insert([
            'id' => 13,
            'name' => 'Фарғона',
            'Kod' => 4113,
            'user_id' => 13,
            'manager_id' => 51,
            'adress' => 'Фарғона',
            'location' => 'Фарғона',
            'branchmanager_id' => 113,
        ]);
        //4114
        DB::table('users')->insert([
            'id' => 14,
            'surname' => 'Наманган',
            'lastname' =>'Зав. Склад',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 14,
            'role_id' => 2,
            'active' => 1,
            'email' => '4114@artel.uz',
        ]);
        DB::table('users')->insert([
            'id' => 114,
            'surname' => 'Наманган',
            'lastname' =>'Управляющий',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 114,
            'role_id' => 7,
            'active' => 1,
            'email' => '4114upr@artel.uz',
        ]);
        DB::table('warehouses')->insert([
            'id' => 14,
            'name' => 'Наманган',
            'Kod' => 4114,
            'user_id' => 14,
            'manager_id' => 51,
            'adress' => 'Наманган',
            'location' => 'Наманган',
            'branchmanager_id' => 114,
        ]);
        //4115
        DB::table('users')->insert([
            'id' => 15,
            'surname' => 'Андижон',
            'lastname' =>'Зав. Склад',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 15,
            'role_id' => 2,
            'active' => 1,
            'email' => '4115@artel.uz',
        ]);
        DB::table('users')->insert([
            'id' => 115,
            'surname' => 'Андижон',
            'lastname' =>'Управляющий',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 115,
            'role_id' => 7,
            'active' => 1,
            'email' => '4115upr@artel.uz',
        ]);
        DB::table('warehouses')->insert([
            'id' => 15,
            'name' => 'Андижон',
            'Kod' => 4115,
            'user_id' => 15,
            'manager_id' => 51,
            'adress' => 'Андижон',
            'location' => 'Андижон',
            'branchmanager_id' => 115,
        ]);
        //4116
        DB::table('users')->insert([
            'id' => 16,
            'surname' => 'Карши',
            'lastname' =>'Зав. Склад',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 16,
            'role_id' => 2,
            'active' => 1,
            'email' => '4116@artel.uz',
        ]);
        DB::table('users')->insert([
            'id' => 116,
            'surname' => 'Карши',
            'lastname' =>'Управляющий',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 116,
            'role_id' => 7,
            'active' => 1,
            'email' => '4116upr@artel.uz',
        ]);
        DB::table('warehouses')->insert([
            'id' => 16,
            'name' => 'Карши',
            'Kod' => 4116,
            'user_id' => 16,
            'manager_id' => 51,
            'adress' => 'Карши',
            'location' => 'Карши',
            'branchmanager_id' => 116,
        ]);
        //4117
        DB::table('users')->insert([
            'id' => 17,
            'surname' => 'Термез',
            'lastname' =>'Зав. Склад',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 17,
            'role_id' => 2,
            'active' => 1,
            'email' => '4117@artel.uz',
        ]);
        DB::table('users')->insert([
            'id' => 117,
            'surname' => 'Термез',
            'lastname' =>'Управляющий',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 117,
            'role_id' => 7,
            'active' => 1,
            'email' => '4117upr@artel.uz',
        ]);
        DB::table('warehouses')->insert([
            'id' => 17,
            'name' => 'Термез',
            'Kod' => 4117,
            'user_id' => 17,
            'manager_id' => 51,
            'adress' => 'Термез',
            'location' => 'Термез',
            'branchmanager_id' => 117,
        ]);
        //4118
        DB::table('users')->insert([
            'id' => 18,
            'surname' => 'Денау',
            'lastname' =>'Зав. Склад',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 18,
            'role_id' => 2,
            'active' => 1,
            'email' => '4118@artel.uz',
        ]);
        DB::table('users')->insert([
            'id' => 118,
            'surname' => 'Денау',
            'lastname' =>'Управляющий',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 118,
            'role_id' => 7,
            'active' => 1,
            'email' => '4118upr@artel.uz',
        ]);
        DB::table('warehouses')->insert([
            'id' => 18,
            'name' => 'Денау',
            'Kod' => 4118,
            'user_id' => 18,
            'manager_id' => 51,
            'adress' => 'Денау',
            'location' => 'Денау',
            'branchmanager_id' => 118,
        ]);
        //4119
        DB::table('users')->insert([
            'id' => 19,
            'surname' => 'Бухоро',
            'lastname' =>'Зав. Склад',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 19,
            'role_id' => 2,
            'active' => 1,
            'email' => '4119@artel.uz',
        ]);
        DB::table('users')->insert([
            'id' => 119,
            'surname' => 'Бухоро',
            'lastname' =>'Управляющий',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 119,
            'role_id' => 7,
            'active' => 1,
            'email' => '4119upr@artel.uz',
        ]);
        DB::table('warehouses')->insert([
            'id' => 19,
            'name' => 'Бухоро',
            'Kod' => 4119,
            'user_id' => 19,
            'manager_id' => 51,
            'adress' => 'Бухоро',
            'location' => 'Бухоро',
            'branchmanager_id' => 119,
        ]);
        //4120
        DB::table('users')->insert([
            'id' => 20,
            'surname' => 'Навои',
            'lastname' =>'Зав. Склад',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 20,
            'role_id' => 2,
            'active' => 1,
            'email' => '4120@artel.uz',
        ]);
        DB::table('users')->insert([
            'id' => 120,
            'surname' => 'Навои',
            'lastname' =>'Управляющий',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 120,
            'role_id' => 7,
            'active' => 1,
            'email' => '4120upr@artel.uz',
        ]);
        DB::table('warehouses')->insert([
            'id' => 20,
            'name' => 'Навои',
            'Kod' => 4120,
            'user_id' => 20,
            'manager_id' => 51,
            'adress' => 'Навои',
            'location' => 'Навои',
            'branchmanager_id' => 120,
        ]);
        //4121
        DB::table('users')->insert([
            'id' => 21,
            'surname' => 'Урганч',
            'lastname' =>'Зав. Склад',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 21,
            'role_id' => 2,
            'active' => 1,
            'email' => '4121@artel.uz',
        ]);
        DB::table('users')->insert([
            'id' => 121,
            'surname' => 'Урганч',
            'lastname' =>'Управляющий',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 121,
            'role_id' => 7,
            'active' => 1,
            'email' => '4121upr@artel.uz',
        ]);
        DB::table('warehouses')->insert([
            'id' => 21,
            'name' => 'Урганч',
            'Kod' => 4121,
            'user_id' => 21,
            'manager_id' => 51,
            'adress' => 'Урганч',
            'location' => 'Урганч',
            'branchmanager_id' => 121,
        ]);
        //4122
        DB::table('users')->insert([
            'id' => 22,
            'surname' => 'Нукус',
            'lastname' =>'Зав. Склад',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 22,
            'role_id' => 2,
            'active' => 1,
            'email' => '4122@artel.uz',
        ]);
        DB::table('users')->insert([
            'id' => 122,
            'surname' => 'Нукус',
            'lastname' =>'Управляющий',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 122,
            'role_id' => 7,
            'active' => 1,
            'email' => '4122upr@artel.uz',
        ]);
        DB::table('warehouses')->insert([
            'id' => 22,
            'name' => 'Нукус',
            'Kod' => 4122,
            'user_id' => 22,
            'manager_id' => 51,
            'adress' => 'Нукус',
            'location' => 'Нукус',
            'branchmanager_id' => 122,
        ]);
        //4123
        DB::table('users')->insert([
            'id' => 23,
            'surname' => 'Караташ',
            'lastname' =>'Зав. Склад',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 23,
            'role_id' => 2,
            'active' => 1,
            'email' => '4123@artel.uz',
        ]);
        DB::table('users')->insert([
            'id' => 123,
            'surname' => 'Караташ',
            'lastname' =>'Управляющий',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 123,
            'role_id' => 7,
            'active' => 1,
            'email' => '4123upr@artel.uz',
        ]);
        DB::table('warehouses')->insert([
            'id' => 23,
            'name' => 'Караташ',
            'Kod' => 4123,
            'user_id' => 23,
            'manager_id' => 51,
            'adress' => 'Караташ',
            'location' => 'Караташ',
            'branchmanager_id' => 123,
        ]);
        //4124
        DB::table('users')->insert([
            'id' => 24,
            'surname' => 'Сергели',
            'lastname' =>'Зав. Склад',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 24,
            'role_id' => 2,
            'active' => 1,
            'email' => '4124@artel.uz',
        ]);
        DB::table('users')->insert([
            'id' => 124,
            'surname' => 'Сергели',
            'lastname' =>'Управляющий',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 124,
            'role_id' => 7,
            'active' => 1,
            'email' => '4124upr@artel.uz',
        ]);
        DB::table('warehouses')->insert([
            'id' => 24,
            'name' => 'Сергели',
            'Kod' => 4124,
            'user_id' => 24,
            'manager_id' => 51,
            'adress' => 'Сергели',
            'location' => 'Сергели',
            'branchmanager_id' => 124,
        ]);
        //4125
        DB::table('users')->insert([
            'id' => 25,
            'surname' => 'Гиждуван',
            'lastname' =>'Зав. Склад',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 25,
            'role_id' => 2,
            'active' => 1,
            'email' => '4125@artel.uz',
        ]);
        DB::table('users')->insert([
            'id' => 125,
            'surname' => 'Гиждуван',
            'lastname' =>'Управляющий',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 125,
            'role_id' => 7,
            'active' => 1,
            'email' => '4125upr@artel.uz',
        ]);
        DB::table('warehouses')->insert([
            'id' => 25,
            'name' => 'Гиждуван',
            'Kod' => 4125,
            'user_id' => 25,
            'manager_id' => 51,
            'adress' => 'Гиждуван',
            'location' => 'Гиждуван',
            'branchmanager_id' => 125,
        ]);
        //4126
        DB::table('users')->insert([
            'id' => 26,
            'surname' => 'Зарафшон',
            'lastname' =>'Зав. Склад',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 26,
            'role_id' => 2,
            'active' => 1,
            'email' => '4126@artel.uz',
        ]);
        DB::table('users')->insert([
            'id' => 126,
            'surname' => 'Зарафшон',
            'lastname' =>'Управляющий',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 126,
            'role_id' => 7,
            'active' => 1,
            'email' => '4126upr@artel.uz',
        ]);
        DB::table('warehouses')->insert([
            'id' => 26,
            'name' => 'Зарафшон',
            'Kod' => 4126,
            'user_id' => 26,
            'manager_id' => 51,
            'adress' => 'Зарафшон',
            'location' => 'Зарафшон',
            'branchmanager_id' => 126,
        ]);
        //4127
        DB::table('users')->insert([
            'id' => 27,
            'surname' => 'Чуст',
            'lastname' =>'Зав. Склад',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 27,
            'role_id' => 2,
            'active' => 1,
            'email' => '4127@artel.uz',
        ]);
        DB::table('users')->insert([
            'id' => 127,
            'surname' => 'Чуст',
            'lastname' =>'Управляющий',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 127,
            'role_id' => 7,
            'active' => 1,
            'email' => '4127upr@artel.uz',
        ]);
        DB::table('warehouses')->insert([
            'id' => 27,
            'name' => 'Чуст',
            'Kod' => 4127,
            'user_id' => 27,
            'manager_id' => 51,
            'adress' => 'Чуст',
            'location' => 'Чуст',
            'branchmanager_id' => 127,
        ]);
        //4128
        DB::table('users')->insert([
            'id' => 28,
            'surname' => 'Беруний',
            'lastname' =>'Зав. Склад',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 28,
            'role_id' => 2,
            'active' => 1,
            'email' => '4128@artel.uz',
        ]);
        DB::table('users')->insert([
            'id' => 128,
            'surname' => 'Беруний',
            'lastname' =>'Управляющий',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 128,
            'role_id' => 7,
            'active' => 1,
            'email' => '4128upr@artel.uz',
        ]);
        DB::table('warehouses')->insert([
            'id' => 28,
            'name' => 'Беруний',
            'Kod' => 4128,
            'user_id' => 28,
            'manager_id' => 51,
            'adress' => 'Беруний',
            'location' => 'Беруний',
            'branchmanager_id' => 128,
        ]);
        //4129
        DB::table('users')->insert([
            'id' => 29,
            'surname' => 'Шахрисабз',
            'lastname' =>'Зав. Склад',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 29,
            'role_id' => 2,
            'active' => 1,
            'email' => '4129@artel.uz',
        ]);
        DB::table('users')->insert([
            'id' => 129,
            'surname' => 'Шахрисабз',
            'lastname' =>'Управляющий',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 129,
            'role_id' => 7,
            'active' => 1,
            'email' => '4129upr@artel.uz',
        ]);
        DB::table('warehouses')->insert([
            'id' => 29,
            'name' => 'Шахрисабз',
            'Kod' => 4129,
            'user_id' => 29,
            'manager_id' => 51,
            'adress' => 'Шахрисабз',
            'location' => 'Шахрисабз',
            'branchmanager_id' => 129,
        ]);
        //4130
        DB::table('users')->insert([
            'id' => 30,
            'surname' => 'Абу-Сахий Мини',
            'lastname' =>'Зав. Склад',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 30,
            'role_id' => 2,
            'active' => 1,
            'email' => '4130@artel.uz',
        ]);
        DB::table('users')->insert([
            'id' => 130,
            'surname' => 'Абу-Сахий Мини',
            'lastname' =>'Управляющий',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 130,
            'role_id' => 7,
            'active' => 1,
            'email' => '4130upr@artel.uz',
        ]);
        DB::table('warehouses')->insert([
            'id' => 30,
            'name' => 'Абу-Сахий Мини',
            'Kod' => 4130,
            'user_id' => 30,
            'manager_id' => 51,
            'adress' => 'Абу-Сахий Мини',
            'location' => 'Абу-Сахий Мини',
            'branchmanager_id' => 130,
        ]);
        //4131
        DB::table('users')->insert([
            'id' => 31,
            'surname' => 'Буюк Ипак Йули',
            'lastname' =>'Зав. Склад',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 31,
            'role_id' => 2,
            'active' => 1,
            'email' => '4131@artel.uz',
        ]);
        DB::table('users')->insert([
            'id' => 131,
            'surname' => 'Буюк Ипак Йули',
            'lastname' =>'Управляющий',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 131,
            'role_id' => 7,
            'active' => 1,
            'email' => '4131upr@artel.uz',
        ]);
        DB::table('warehouses')->insert([
            'id' => 31,
            'name' => 'Буюк Ипак Йули',
            'Kod' => 4131,
            'user_id' => 31,
            'manager_id' => 51,
            'adress' => 'Буюк Ипак Йули',
            'location' => 'Буюк Ипак Йули',
            'branchmanager_id' => 131,
        ]);
        //4132
        DB::table('users')->insert([
            'id' => 32,
            'surname' => 'Шахрихон',
            'lastname' =>'Зав. Склад',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 32,
            'role_id' => 2,
            'active' => 1,
            'email' => '4132@artel.uz',
        ]);
        DB::table('users')->insert([
            'id' => 132,
            'surname' => 'Шахрихон',
            'lastname' =>'Управляющий',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 132,
            'role_id' => 7,
            'active' => 1,
            'email' => '4132upr@artel.uz',
        ]);
        DB::table('warehouses')->insert([
            'id' => 32,
            'name' => 'Шахрихон',
            'Kod' => 4132,
            'user_id' => 32,
            'manager_id' => 51,
            'adress' => 'Шахрихон',
            'location' => 'Шахрихон',
            'branchmanager_id' => 132,
        ]);
        //4137
        DB::table('users')->insert([
            'id' => 37,
            'surname' => 'Маргилон',
            'lastname' =>'Зав. Склад',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 37,
            'role_id' => 2,
            'active' => 1,
            'email' => '4137@artel.uz',
        ]);
        DB::table('users')->insert([
            'id' => 137,
            'surname' => 'Маргилон',
            'lastname' =>'Управляющий',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 137,
            'role_id' => 7,
            'active' => 1,
            'email' => '4137upr@artel.uz',
        ]);
        DB::table('warehouses')->insert([
            'id' => 37,
            'name' => 'Маргилон',
            'Kod' => 4137,
            'user_id' => 37,
            'manager_id' => 51,
            'adress' => 'Маргилон',
            'location' => 'Маргилон',
            'branchmanager_id' => 137,
        ]);
        //4138
        DB::table('users')->insert([
            'id' => 38,
            'surname' => 'Чирчик',
            'lastname' =>'Зав. Склад',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 38,
            'role_id' => 2,
            'active' => 1,
            'email' => '4138@artel.uz',
        ]);
        DB::table('users')->insert([
            'id' => 138,
            'surname' => 'Чирчик',
            'lastname' =>'Управляющий',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 138,
            'role_id' => 7,
            'active' => 1,
            'email' => '4138upr@artel.uz',
        ]);
        DB::table('warehouses')->insert([
            'id' => 38,
            'name' => 'Чирчик',
            'Kod' => 4138,
            'user_id' => 38,
            'manager_id' => 51,
            'adress' => 'Чирчик',
            'location' => 'Чирчик',
            'branchmanager_id' => 138,
        ]);
        //4139
        DB::table('users')->insert([
            'id' => 39,
            'surname' => 'Нурафшон',
            'lastname' =>'Зав. Склад',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 39,
            'role_id' => 2,
            'active' => 1,
            'email' => '4139@artel.uz',
        ]);
        DB::table('users')->insert([
            'id' => 139,
            'surname' => 'Нурафшон',
            'lastname' =>'Управляющий',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 139,
            'role_id' => 7,
            'active' => 1,
            'email' => '4139upr@artel.uz',
        ]);
        DB::table('warehouses')->insert([
            'id' => 39,
            'name' => 'Нурафшон',
            'Kod' => 4139,
            'user_id' => 39,
            'manager_id' => 51,
            'adress' => 'Нурафшон',
            'location' => 'Нурафшон',
            'branchmanager_id' => 139,
        ]);
        //4140
        DB::table('users')->insert([
            'id' => 40,
            'surname' => 'Самарканд 2',
            'lastname' =>'Зав. Склад',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 40,
            'role_id' => 2,
            'active' => 1,
            'email' => '4140@artel.uz',
        ]);
        DB::table('users')->insert([
            'id' => 140,
            'surname' => 'Самарканд 2',
            'lastname' =>'Управляющий',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 140,
            'role_id' => 7,
            'active' => 1,
            'email' => '4140upr@artel.uz',
        ]);
        DB::table('warehouses')->insert([
            'id' => 40,
            'name' => 'Самарканд 2',
            'Kod' => 4140,
            'user_id' => 40,
            'manager_id' => 51,
            'adress' => 'Самарканд 2',
            'location' => 'Самарканд 2',
            'branchmanager_id' => 140,
        ]);
        //4141
        DB::table('users')->insert([
            'id' => 41,
            'surname' => 'Хива',
            'lastname' =>'Зав. Склад',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 41,
            'role_id' => 2,
            'active' => 1,
            'email' => '4141@artel.uz',
        ]);
        DB::table('users')->insert([
            'id' => 141,
            'surname' => 'Хива',
            'lastname' =>'Управляющий',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 141,
            'role_id' => 7,
            'active' => 1,
            'email' => '4141upr@artel.uz',
        ]);
        DB::table('warehouses')->insert([
            'id' => 41,
            'name' => 'Хива',
            'Kod' => 4141,
            'user_id' => 41,
            'manager_id' => 51,
            'adress' => 'Хива',
            'location' => 'Хива',
            'branchmanager_id' => 141,
        ]);
        //4142
        DB::table('users')->insert([
            'id' => 42,
            'surname' => 'Ургут',
            'lastname' =>'Зав. Склад',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 42,
            'role_id' => 2,
            'active' => 1,
            'email' => '4142@artel.uz',
        ]);
        DB::table('users')->insert([
            'id' => 142,
            'surname' => 'Ургут',
            'lastname' =>'Управляющий',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 142,
            'role_id' => 7,
            'active' => 1,
            'email' => '4142upr@artel.uz',
        ]);
        DB::table('warehouses')->insert([
            'id' => 42,
            'name' => 'Ургут',
            'Kod' => 4142,
            'user_id' => 42,
            'manager_id' => 51,
            'adress' => 'Ургут',
            'location' => 'Ургут',
            'branchmanager_id' => 142,
        ]);
        DB::table('users')->insert([
            'id' => 51,
            'surname' => 'manager1',
            'lastname' =>'manager1',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 51,
            'role_id' => 4,
            'email' => 'manager1@artel.uz',
        ]);
        DB::table('users')->insert([
            'id' => 52,
            'surname' => 'manager2',
            'lastname' =>'manager2',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 52,
            'role_id' => 4,
            'email' => 'manager2@artel.uz',
        ]);
        DB::table('users')->insert([
            'id' => 53,
            'surname' => 'manager3',
            'lastname' =>'manager3',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 53,
            'role_id' => 4,
            'email' => 'manager3@artel.uz',
        ]);
        DB::table('users')->insert([
            'id' => 54,
            'surname' => 'manager4',
            'lastname' =>'manager4',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 54,
            'role_id' => 4,
            'email' => 'manager4@artel.uz',
        ]);
        DB::table('users')->insert([
            'id' => 55,
            'surname' => 'transfermanager',
            'lastname' =>'transfermanager',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 55,
            'role_id' => 5,
            'email' => 'sparepart@artel.uz',
        ]);
        DB::table('users')->insert([
            'id' => 56,
            'surname' => 'director',
            'lastname' =>'director',
            'password' => Hash::make('Artel2022'),
            'number' => '909999999',
            'order' => 56,
            'role_id' => 3,
            'email' => 'director@artel.uz',
        ]);
        DB::table('roles')->insert([
            'id' => 1,
            'role' => 'admin'
        ]);
        DB::table('roles')->insert([
            'id' => 2,
            'role' => 'zavsklad'
        ]);
        DB::table('roles')->insert([
            'id' => 3,
            'role' => 'director'
        ]);
        DB::table('roles')->insert([
            'id' => 4,
            'role' => 'manager'
        ]);
        DB::table('roles')->insert([
            'id' => 5,
            'role' => 'sparepartmanager'
        ]);
        DB::table('roles')->insert([
            'id' => 6,
            'role' => 'resseption'
        ]);
        DB::table('roles')->insert([
            'id' => 7,
            'role' => 'branchfilmanager'
        ]);
        DB::table('answaers')->insert([
            'id' => 1,
            'name' => 'Ожидание ответа'
        ]);
        DB::table('answaers')->insert([
            'id' => 2,
            'name' => 'Получил трансфер'
        ]);
        DB::table('answaers')->insert([
            'id' => 6,
            'name' => 'Отменен'
        ]);
        DB::table('answaers')->insert([
            'id' => 7,
            'name' => 'Отправлен'
        ]);
        DB::table('answaers')->insert([
            'id' => 8,
            'name' => 'Готово к отправке'
        ]);
        DB::table('statuses')->insert([
            'id' => 1,
            'name' => 'Ожидание'
        ]);
        DB::table('statuses')->insert([
            'id' => 2,
            'name' => 'Доставлен'
        ]);
        DB::table('statuses')->insert([
            'id' => 3,
            'name' => 'В пути'
        ]);
        DB::table('statuses')->insert([
            'id' => 4,
            'name' => 'Горит'
        ]);
        DB::table('statuses')->insert([
            'id' => 5,
            'name' => 'Отменен'
        ]);*/
    }
}
