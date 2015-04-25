<?php

class UserTableSeeder extends Seeder
{

	public function run()
	{
		DB::table('users')->delete();
		User::create(array(
			'name'     => 'Muchamad Ilman Maulana',
			'username' => 'ilman',
			'email'    => 'ilman.maulana+prudass@gmail.com',
			'password' => Hash::make('asd123'),
			'birthday'  => '1986-11-29',
		));
	}

}