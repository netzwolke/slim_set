<?php


use App\Model\User;
use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function getDependencies()
    {
       return [
         'RoleSeeder',
       ];
    }

    public function run()
    {
        $data = [
            [
                'name'=> 'root',
                'password' => '$2y$12$eRjffdn.KuPHDvTdZCAXc..LOfeMbMIX1rt7HjTbKm\/9CsJoedyky',
                'role_id' => 1
            ], [
                'name'=>'user',
                'password'=>'$2y$12$h7s8D372V2BXGbbZY5RlUe8N9C.iQNQiEDkYJXKnaqO00i1UIg9gK',
                'role_id' => 2
            ], [
                'name'=>'guest',
                'password'=>'$2y$12$lOM8elzwuL\/BN81xbEOrmupFXhPFPyqsdMGsfsvWnKTILwG\/Ks8Oy',
                'role_id'=>3,
            ]
        ];

        User::create($data);
    }
}
