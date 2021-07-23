<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->string('sub_category_id', 64)->unique()->primary();
            $table->string('sub_category_category_id', 64);

            $table->string('sub_category_label');

            $table->timestamps();

            $table->foreign('sub_category_category_id')->references('category_id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sub_categories', function (Blueprint $table) {
            $table->dropForeign('sub_categories_sub_category_category_id_foreign');
        });
        Schema::dropIfExists('sub_categories');
    }
}
