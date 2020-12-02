<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apps', function (Blueprint $table) {
            $table->id();
            $table->text('name')->nullable();
            $table->string('category')->nullable();
            $table->string('rating')->nullable();
            $table->string('reviews')->nullable();
            $table->string('size')->nullable();
            $table->string('installs')->nullable();
            $table->string('type')->nullable();
            $table->string('price')->nullable();
            $table->string('content_range')->nullable();
            $table->string('genres')->nullable();
            $table->string('last_update')->nullable();
            $table->string('current_version')->nullable();
            $table->string('android_version')->nullable();
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
        Schema::dropIfExists('apps');
    }
}
