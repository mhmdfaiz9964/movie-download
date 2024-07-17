<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDownloadLinksHasTypeHasLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('download_links_has_type_has_links', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('download_links_has_types_id');
            $table->string('url');
            $table->string('link_type'); // Added column
            $table->timestamps();

            // Specify a custom name for the foreign key constraint
            $table->foreign('download_links_has_types_id', 'dl_has_types_id_fk')
                  ->references('id')->on('download_links_has_types')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('download_links_has_type_has_links');
    }
}
