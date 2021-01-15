<?php


use Phinx\Seed\AbstractSeed;

class RoleSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run()
    {
        $data = [
          [
              'name'=>'Admin',
              'power'=> 10000,
              'created_at'=> date('Y-m-d H:i:s'),
              'updated_at'=> date('Y-m-d H:i:s'),

          ], [
                'name'=>'User',
                'power'=> 1000,
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s'),
            ], [
                'name'=>'Guest',
                'power'=> 0,
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s'),
            ]
        ];
        $roles = $this->table('roles');
        $roles->insert($data)
            ->save();
    }
}
