<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_users', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('website');
            #          هذا العمود ساقوم بربطه مع جدول اليوزرز
            #            هو عمود غريب نابع لعمود في جدول اخر
            $table->integer('user_id')->unsigned();
            $table->string('gender');
            $table->longText('bio');
            # تحديد العمود الاجنبي وانه يتبع العمود ؟ في جدول ؟
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade');
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
        Schema::dropIfExists('profile_users');
    }
}
