<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('search3', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer("version")->default(1);

            $table->unsignedInteger("main_group_id");

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('search3_template', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("search3_id")->index();
            $table->integer("version");

            // form data
            $table->longText("search_form");
            $table->longText("table_result");

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create("search_group", function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('table_name');

            $table->text('meta_data')->nullable();

            $table->timestamps();
            $table->unique(['name', 'table_name']);
        });

        Schema::create("search_relation", function (Blueprint $table) {
            $table->unsignedInteger("base_group_id");
            $table->unsignedInteger("join_group_id");
            $table->tinyInteger('type')->default(0); // 0 => INNER JOIN - 1 => LEFT JOIN - 2 => RIGHT JOIN
            $table->text("condition");

            $table->unique(['base_group_id', 'join_group_id']);
        });

        Schema::create("search_group_field", function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("group_id");
            $table->string('field_name');
            $table->tinyInteger("type"); // 0 int, 1 string, 2

            $table->text('meta_data')->nullable();

            // unique thing...
            $table->unique(['group_id', 'field_name']);

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
        Schema::dropIfExists('search3');
        Schema::dropIfExists('search3_template');
        Schema::dropIfExists('search_group');
        Schema::dropIfExists('search_relation');
        Schema::dropIfExists('search_group_field');
    }
}
