<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('camp', 50);
            $table->string('body', 5000);
            $table->string('address', 100);
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('season_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('style_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
