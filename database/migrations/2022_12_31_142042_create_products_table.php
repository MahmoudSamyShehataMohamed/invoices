<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{

    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name', 999);
            $table->text('description')->nullable();
            $table->unsignedBigInteger('section_id');
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');//ريفيرنس دى يعنى الفوريجن كى دا يوازى ايه الجدول التانى كله يعنى ال اى دى بتاع السيكشنز وكذلك اسم الجدول سيكشنز //لما الاب بتاعى يتحذف كل الشيلدرن يتحذفو
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('products');
    }
}
