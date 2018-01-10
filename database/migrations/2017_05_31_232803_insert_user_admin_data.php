<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertUserAdminData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       $user = User::create([
        'name'=> env('ADMIN_DEFAULT_NAME','Administrador'),
        'email'=> env('ADMIN_DEFAULT_EMAIL','default@email.com'),
        'password'=> bcrypt(env('ADMIN_DEFAULT_PASSWORD','secret')),
        'role'=> User::ADMIN
        ]);
       $user->verified = true;

       $user->save();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table = (new User())->getTable();
        \DB::table($table)->where('email','=',env('ADMIN_DEFAULT_EMAIL','default@email.com'))
            ->delete();
    }
}
