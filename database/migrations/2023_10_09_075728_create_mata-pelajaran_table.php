<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMataPelajaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::create('mata_pelajaran', function (Blueprint $table) {
        $table->uuid('id')->unique();
        $table->string('name');
        $table->string('nama_sekolah')->unique()->nullable();
        $table->uuid('admin_id',120)->nullable();
        $table->foreign('admin_id')->references('id')->on('admin')->onDelete('cascade');
        $table->string('photo_thumbnail')->default(null)->nullable();
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
        //
    }
}
