<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBadanAmalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('badan_amals', function (Blueprint $table) {
            $table->id();
            $table->string('penanggung_jawab')->nullable();
            $table->string('name')->unique();
            $table->string('profileImage');
            $table->string('email');
            $table->text('description');
            $table->string('address');
            $table->integer('no_phone');
            $table->enum('status', ['approved', 'reject']);
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
        Schema::dropIfExists('badan_amals');
    }
}
