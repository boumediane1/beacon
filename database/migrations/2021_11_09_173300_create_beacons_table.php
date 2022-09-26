<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeaconsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beacons', function (Blueprint $table) {
            $table->id();
            $table->string('uin')->unique();
            $table->string('serial_number_manufacturer')->unique()->nullable();
            $table->string('serial_number_sar')->unique()->nullable();
            $table->date('registration_date');
            $table->date('expiration_date');
            $table->string('tac')->nullable();
            $table->foreignId('status_id')->constrained()->cascadeOnDelete();
            $table->foreignId('registration_status_id')->constrained()->cascadeOnDelete();
            $table->foreignId('manufacturer_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('type_id')->constrained()->cascadeOnDelete();
            $table->foreignId('model_id')->nullable()->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beacons');
    }
}
