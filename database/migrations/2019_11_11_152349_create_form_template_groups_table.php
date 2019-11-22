<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormTemplateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_template_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('template_id')->comment('模板id');
            $table->integer('order')->comment('排序');
            $table->string('name')->comment('分组名');
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
        Schema::dropIfExists('form_template_groups');
    }
}
