<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResourceLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resource_links', function (Blueprint $table) {
            $table->string('resource_link_id', 64)->unique()->primary();
            $table->string('resource_link_resource_id', 64);

            $table->string('resource_link_url');

            $table->boolean('resource_link_status')->default(true);

            $table->timestamps();

            $table->foreign('resource_link_resource_id')->references('resource_id')->on('resources')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('resource_links', function (Blueprint $table) {
            $table->dropForeign('resource_links_resource_link_resource_id_foreign');
        });
        Schema::dropIfExists('resource_links');
    }
}
