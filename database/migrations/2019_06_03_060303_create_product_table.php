<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code',50)->unique();//khong cho phep cot ma san pham trung nhau
            $table->string('name');
            $table->string('slug');
            $table->decimal('price',18,0)->default(0);//mac dinh la 0 neu khong co gia tri
            $table->tinyInteger('featured')->unsigned();//kieu khong dau
            $table->tinyInteger('state')->unsigned();
            $table->text('info')->nullable();
            $table->text('describe')->nullable();//cho phep null
            $table->string('img');
//Tao khoa ngoai lien ket den khoa chinh cua bang category
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('category')->onDelete('cascade');//ondelete cho phep xoa danh muc cha va ca san pham con
//Tao 2 cot create_at va update_at kieu timestamp cho phep null             
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
        Schema::dropIfExists('product');
    }
}
