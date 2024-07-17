<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDownloadLinksHasTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('download_links_has_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('download_links_id');
            $table->string('type');
            $table->timestamps();

            $table->foreign('download_links_id')->references('id')->on('download_links')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('download_links_has_types');
    }
}
