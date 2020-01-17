<?php
  
use Illuminate\Database\Seeder;
use App\User;
   
class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
               'name'=>'Admin',
               'surname'=>'User',
               'email'=>'admin@example.test',
                'is_admin'=>'1',
               'password'=> bcrypt('12345678'),
            ],
            [
               'name'=>'Non_Admin',
               'surname'=>'User',
               'email'=>'user@example.test',
                'is_admin'=>'0',
               'password'=> bcrypt('12345678'),
            ],
        ];
  
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}