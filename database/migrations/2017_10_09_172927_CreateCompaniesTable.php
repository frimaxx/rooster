<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
           $table->increments('id');
           $table->string('name');
           $table->string('city');
           $table->string('postal_code');
           $table->string('address');
           $table->string('logo')->nullable();
           $table->string('logo_small')->nullable();
           $table->string('primary_color')->default('6887ff')->length(7);
           $table->string('secondary_color')->default('fff')->length(7);
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
        Schema::drop('companies');
    }
}
