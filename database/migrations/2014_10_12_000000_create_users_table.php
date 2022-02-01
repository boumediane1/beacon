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
            $table->string('name')->unique();
            $table->string('username')->unique()->nullable();
            $table->boolean('status')->default(true);
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->integer('role')->default(3);
            $table->string('phone_number')->nullable();
            $table->string('secondary_phone_number')->nullable();
            $table->string('address')->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone_number')->nullable();
            $table->string('secondary_emergency_contact_name')->nullable();
            $table->string('secondary_emergency_contact_phone_number')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        \App\Models\User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => \Illuminate\Support\Facades\Hash::make('admin'),
            'role' => 1
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
