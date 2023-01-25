<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionsTable extends Migration
{

    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->string('section_name', 999);
            $table->text('description')->nullable();
            $table->string('created_by',999);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sections');
    }
}
