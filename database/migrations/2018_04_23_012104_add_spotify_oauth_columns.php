<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSpotifyOauthColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table)
          {
            $table->string('password')->nullable()->change();
            $table->string('spotify_token')->nullable();
            $table->string('spotify_refresh_token')->nullable();
            $table->string('name')->nullable()->change();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
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
