<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPostTable extends Migration
{
    /**
     *
     * im so sorry i changed the name midway through so it looks bad
     *
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_upload_user', function (Blueprint $table) {

            $table->increments('id');

            # `user_id` and `post_id` will be foreign keys-> have to be unsigned
            #  field names here correspond to the tables they will connect...
            # `user_id` will reference `users' and `post_id` will reference the `tags` table.
            $table->BigInteger('user_id')->unsigned();
            $table->integer('image_upload_id')->unsigned();

            # Make foreign keys
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('image_upload_id')->references('id')->on('image_uploads');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('image_upload_user');
    }
}
