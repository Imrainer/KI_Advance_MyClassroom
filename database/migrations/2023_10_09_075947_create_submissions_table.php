<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submission', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->uuid('assignment_id',120)->nullable();
            $table->foreign('assignment_id')->references('id')->on('assignment')->onDelete('cascade');
            $table->uuid('user_id',120)->nullable();
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
            $table->string('file_path')->default(null)->nullable();
            $table->string('link')->default(null)->nullable();
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
        Schema::dropIfExists('submission');
    }
}
