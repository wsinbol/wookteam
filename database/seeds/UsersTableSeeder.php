<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('users')->delete();

        \DB::table('users')->insert(array (
            0 =>
            array (
                'id' => 1,
                'identity' => ',admin,',
                'token' => 'MUBhZG1pbkBPSHNKODhAMTU5MTM0Mzg1NUBzdkJ6UnU=',
                'az' => 'D',
                'username' => 'admin',
                'nickname' => '大乔',
                'userimg' => '',
                'profession' => '技术部',
                'encrypt' => 'OHsJ88',
                'userpass' => '3dd0e69a6da5b87a9de356cc8f22a1e3',
                'bgid' => 1,
                'loginnum' => 353,
                'lastip' => '127.0.0.1',
                'lastdate' => 1591343855,
                'lineip' => '127.0.0.1',
                'linedate' => 1591343909,
                'regip' => '127.0.0.1',
                'regdate' => 1589072625,
                'setting' => '{\\"version\\":1}',
            ),
            1 =>
            array (
                'id' => 2,
                'identity' => ',admin,',
                'token' => 'MkBzeXN0ZW1AQUExbHN2QDE1OTEzNDI2OTBAQlZ5Z005',
                'az' => 'X',
                'username' => 'system',
                'nickname' => '小乔',
                'userimg' => '',
                'profession' => '技术部',
                'encrypt' => 'AA1lsv',
                'userpass' => '80c515b27ae42470a7c90e59586caaab',
                'bgid' => 1,
                'loginnum' => 345,
                'lastip' => '127.0.0.1',
                'lastdate' => 1591342690,
                'lineip' => '127.0.0.1',
                'linedate' => 1591343157,
                'regip' => '127.0.0.1',
                'regdate' => 1589072625,
                'setting' => '{\\"version\\":1}',
            ),
        ));


    }
}
