<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('用户id');
            $table->string('sex')->nullable()->comment('性别');
            $table->text('introduce')->nullable()->comment('一句话介绍');
            $table->text('domicile')->nullable()->comment('居住地');
            $table->text('industry')->nullable()->comment('行业');
            $table->text('career')->nullable()->comment('职业经历');
            $table->text('experience')->nullable()->comment('教育经历');
            $table->text('individual')->nullable()->comment('个人简介');
            $table->text('cover')->nullable()->comment('封面');
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
        Schema::dropIfExists('user_deatils');
    }
}
