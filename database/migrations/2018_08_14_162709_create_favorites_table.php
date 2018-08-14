<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('user_id');

            $table->unsignedInteger("favoriteable_id");
            $table->string("favoriteable_type");
            $table->index(["favoriteable_id", "favoriteable_type"]);

            $table->unique(['user_id', 'favoriteable_id', 'favoriteable_type',]);

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
        Schema::dropIfExists('favorites');
    }
}
