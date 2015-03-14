<?php
class DatabaseSeeder extends Seeder
{
    public function run() {
        Eloquent::unguard();
        // $this->call('StageTableSeeder');
        // $this->command->info('Stage table seeded!');
        // $this->call('RoleTableSeeder');
        // $this->command->info('Role table seeded!');
    }
}

// class UserTableSeeder extends Seeder
// {
//     public function run() {
//         DB::table('users')->delete();
//         User::create(array(
//             'email'    => 'qwerty@qwerty.ru',
//             'name'     => 'Qwerty',
//             'password' => Hash::make('qwerty')
//         ));
//         User::create(array(
//             'email'    => 'super@admin.my',
//             'name'     => 'Admin',
//             'password' => Hash::make('1234')
//         ));
//     }

// }

// class RoleTableSeeder extends Seeder
// {
//     public function run() {
//         DB::table('roles')->delete();
//         Role::create(array('name' => 'mainAdmin'));
//         Role::create(array('name' => 'admin'));
//         Role::create(array('name' => 'moderator'));
//         Role::create(array('name' => 'ruler'));
//         Role::create(array('name' => 'user'));
//     }
}
