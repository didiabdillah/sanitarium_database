<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->string('resource_id', 64)->unique()->primary();

            $table->string('resource_category_id', 64)->nullable();
            $table->string('resource_sub_category_id', 64)->nullable();
            $table->string('resource_source')->nullable();
            $table->string('resource_author')->nullable();

            $table->string('resource_label');

            $table->text('resource_desc')->nullable();

            $table->enum('resource_status', ['note', 'post', 'backup', 'fail'])->default('note');

            $table->timestamps();

            $table->foreign('resource_category_id')->references('category_id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('resource_sub_category_id')->references('sub_category_id')->on('sub_categories')->onUpdate('cascade')->onDelete('cascade');
            // $table->foreign('resource_source_id')->references('source_id')->on('sources')->onUpdate('cascade')->onDelete('cascade');
            // $table->foreign('resource_author_id')->references('author_id')->on('authors')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('resources', function (Blueprint $table) {
            $table->dropForeign('resources_resource_category_id_foreign');
            $table->dropForeign('resources_resource_sub_category_id_foreign');
            // $table->dropForeign('resources_resource_source_id_foreign');
            // $table->dropForeign('resources_resource_author_id_foreign');
        });
        Schema::dropIfExists('resources');
    }
}
