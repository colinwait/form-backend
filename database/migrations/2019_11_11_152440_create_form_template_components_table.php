<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormTemplateComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_template_components', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('template_id')->comment('模板id');
            $table->bigInteger('group_id')->default(0)->comment('分组id');
            $table->string('name')->comment('名称');
            $table->string('key')->comment('键值');
            $table->string('type')->default('text')->comment('类型');
            $table->integer('order')->default(0)->comment('排序');
            $table->unsignedTinyInteger('is_require')->default(0)->comment('是否必填');
            $table->string('placeholder')->default('')->comment('显示信息');
            $table->json('options')->nullable()->comment('选项信息');
            $table->integer('creator')->comment('创建人id')->default(0);
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
        Schema::dropIfExists('form_template_components');
    }
}
