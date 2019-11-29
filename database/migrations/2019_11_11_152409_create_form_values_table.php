<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_values', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('template_id')->comment('模板id');
            $table->bigInteger('component_id')->comment('组件id');
            $table->bigInteger('form_id')->comment('表单id');
            $table->text('value')->nullable()->comment('表单值');
            $table->string('remark', 1000)->default('')->comment('备注');
            $table->integer('creator')->comment('创建人');
            $table->integer('created_at')->default(0);
            $table->integer('updated_at')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_values');
    }
}
