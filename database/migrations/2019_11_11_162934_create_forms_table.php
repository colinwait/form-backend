<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_forms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('表单名称');
            $table->bigInteger('category_id')->comment('分类id');
            $table->bigInteger('template_id')->comment('模板id');
            $table->string('introduction', 1000)->comment('简介');
            $table->integer('creator')->comment('创建人id')->default(0);
            $table->integer('created_at')->default(0);
            $table->integer('updated_at')->default(0);
            $table->integer('deleted_at')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_forms');
    }
}
