<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->integer("category_id");
            $table->integer("sub_category_id")->nullable();
            $table->integer("district_id");
            $table->integer("sub_district_id")->nullable();
            $table->integer("user_id");
            $table->string("title_en");
            $table->string("title_bn");
            $table->string("description_en")->nullable();
            $table->string("description_bn");
            $table->string("tags_bn");
            $table->string("tags_en")->nullable();
            $table->integer("headline")->nullable();
            $table->integer("first_sectrion")->nullable();
            $table->integer("first_section_thumbnail")->nullable();
            $table->integer("big_thumbnail")->nullable();




            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
