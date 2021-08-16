<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertises', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('address');
            $table->string('amount');
            $table->string('image');
            $table->string('floor');
            $table->integer('year');
            $table->tinyInteger('storeroom');
            $table->tinyInteger('balcony');
            $table->tinyInteger('area');
            $table->tinyInteger('room');
            $table->tinyInteger('parking');
            $table->enum('toilet', ['ایرانی', 'فرنگی', 'ایرانی و فرنگی']);
            $table->string('tag');
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('sell_status');
            $table->tinyInteger('type');
            $table->foreignId('cat_id')->constrained('categories', 'id')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('user_id')->constrained('users', 'id')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->tinyInteger('approved')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertises');
    }
}
