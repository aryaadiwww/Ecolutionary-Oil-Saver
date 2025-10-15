<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRewardRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('reward_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('user_tlp', 20); // Changed to string with length similar to 'tlp' column
            $table->unsignedBigInteger('reward_id');
            $table->string('status')->default('pending');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // Removed the foreign key constraint on 'user_tlp'
            $table->foreign('reward_id')->references('id')->on('rewards')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reward_requests');
    }
}