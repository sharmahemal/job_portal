<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblUserPost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_user_post', function (Blueprint $table) {
            $table->integer('post_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('resume_id')->unsigned();
            $table->integer('salary')->unsigned()->default(0);
            $table->timestamps();
            $table->primary(['company_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_user_post');
    }
}
