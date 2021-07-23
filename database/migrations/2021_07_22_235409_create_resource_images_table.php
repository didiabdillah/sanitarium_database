<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResourceImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resource_images', function (Blueprint $table) {
            $table->string('resource_image_id', 64)->unique()->primary();
            $table->string('resource_image_resource_id', 64);

            $table->string('resource_image_link');

            $table->boolean('resource_image_status')->default(true);

            $table->timestamps();

            $table->foreign('resource_image_resource_id')->references('resource_id')->on('resources')->onUpdate('cascade')->onDelete('cascade');
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
            $table->dropForeign('resources_resource_image_resource_id_foreign');
        });
        Schema::dropIfExists('resource_images');
    }
}
