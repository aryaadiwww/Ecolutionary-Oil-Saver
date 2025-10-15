<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('tlp');
            $table->string('password');
            $table->string('foto')->default('default.png');
            $table->boolean('is_admin')->default(0);
            $table->integer('points')->default(0);
            $table->integer('ml')->default(0);
            $table->string('warna')->nullable();
            $table->integer('tds')->default(0);
            $table->rememberToken();
            $table->timestamps();

            // Set id as primary key
            $table->primary('id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};