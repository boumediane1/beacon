<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->integer('is_admin')->default(0);
            $table->string('phone_number')->nullable();
            $table->string('secondary_phone_number')->nullable();
            $table->string('address')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        \App\Models\User::create([
            'name' => 'admin',
            'password' => \Illuminate\Support\Facades\Hash::make('admin'),
            'is_admin' => 1
        ]);

        \App\Models\User::create([
            'name' => 'staff',
            'password' => \Illuminate\Support\Facades\Hash::make('staff'),
            'is_admin' => 2
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
