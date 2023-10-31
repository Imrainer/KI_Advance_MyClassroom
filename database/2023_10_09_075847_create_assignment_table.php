<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignment', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->string('title');
            $table->string('description')->unique()->nullable();
            $table->timestamp('due_date');
            $table->id('admin_id',120)->nullable();
            $table->foreign('admin_id')->references('id')->on('admin')->onDelete('cascade');
            $table->uuid('mata_pelajaran_id',120)->nullable();
            $table->foreign('mata_pelajaran_id')->references('id')->on('mata_pelajaran')->onDelete('cascade');
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
        Schema::dropIfExists('assignment');
    }
}
