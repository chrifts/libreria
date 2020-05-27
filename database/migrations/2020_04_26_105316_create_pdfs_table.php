<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePdfsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pdfs', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->bigInteger('author_id');
            $table->string('theme')->nullable();
            $table->string('description', 180)->nullable();
            $table->string('is_scanned')->nullable();
            $table->string('is_large_file');
            $table->string('internal_id')->unique();
            $table->string('path_to_folder')->nullable();
            $table->string('total_pages');
            $table->string('views')->default(0);
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
        Schema::dropIfExists('pdfs');
    }
}
