<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveUrlImageTitleAddressDescriptionAmountFromSlidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('slides', function (Blueprint $table) {
            $table->dropColumn('url');
            $table->dropColumn('image');
            $table->dropColumn('title');
            $table->dropColumn('address');
            $table->dropColumn('description');
            $table->dropColumn('amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('slides', function (Blueprint $table) {
            $table->string('url')->after('id');
            $table->string('image')->after('url');
            $table->string('title')->after('image');
            $table->text('address')->after('title');
            $table->text('description')->after('address');
            $table->string('amount')->after('description');
        });
    }
}
