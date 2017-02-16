<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OAuthClientSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('oauth_clients')->insert([
            [
                'id' => 'appid01',
                'secret' => 'secret',
                'name' => 'My App',
                'created_at' => 'CURRENT_TIMESTAMP',
                'updated_at' => 'CURRENT_TIMESTAMP'
            ]
        ]);
      //  DB::raw("insert into oauth_clients (id, secret, name, created_at, updated_at)"
       //         . " values('appid01','secret', 'My App',CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
    }

}
