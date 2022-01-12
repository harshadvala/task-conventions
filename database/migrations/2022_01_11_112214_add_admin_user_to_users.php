<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class AddAdminUserToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_admin')->default(false);
        });

        $userData = [
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'is_admin' => true,
            'password'=>Hash::make('12345678')
        ];

        $user=new \App\Models\User();
        $user->fill($userData);
        $user->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_admin');
            \App\Models\User::where('email','admin@admin.com')->delete();
        });
    }
}
