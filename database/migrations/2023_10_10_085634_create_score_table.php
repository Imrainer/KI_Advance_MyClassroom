<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('score', function (Blueprint $table) {
            $table->uuid('id')->unique();
             $table->string('score')->nullable();
             $table->string('comment')->nullable();
             $table->uuid('submission_id',120)->nullable();
             $table->foreign('submission_id')->references('id')->on('submission')->onDelete('cascade');
            $table->uuid('admin_id',120)->nullable();
            $table->foreign('admin_id')->references('id')->on('admin')->onDelete('cascade');
            $table->uuid('user_id',120)->nullable();
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
            $table->rememberToken();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('score');
    }
}
