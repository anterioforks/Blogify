<?php namespace jorenvanhocht\Blogify\database\Seeds;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use jorenvanhocht\Blogify\Models\Role;
use App\User;
use \Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder {

    private $admin_role;
    private $admin;

    public function __construct()
    {
        $this->admin = config('blogify.blogify.admin_user');

        // Get the id of the admin role
        $role = Role::where('name', '=', 'Admin')->first();
        $this->admin_role = $role->id;
    }

    public function run()
    {
        $user = app()->make(config(('auth.model')));
        $user->create([
            'hash'          => blogify()->makeHash('users', 'hash', true),
            'lastname'      => $this->admin['name'],
            'firstname'     => $this->admin['firstname'],
            'username'      => $this->admin['username'],
            'email'         => $this->admin['email'],
            'password'      => Hash::make($this->admin['password']),
            'role_id'       => $this->admin_role,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
    }

}