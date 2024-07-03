<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('slug', 100);
            $table->integer('parent_id')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->unsignedInteger('_lft')->nullable();
            $table->unsignedInteger('_rgt')->nullable();
            $table->index(['_lft', '_rgt', 'parent_id']);
            $table->timestamps();

            $table->unique(['name', 'parent_id']);
            $table->unique(['slug', 'parent_id']);
        });
    }

    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropIndex(['_lft', '_rgt', 'parent_id']);
            $table->dropUnique(['name', 'parent_id']);
            $table->dropUnique(['slug', 'parent_id']);
            $table->dropColumn(['_lft', '_rgt', 'parent_id']);
        });

        Schema::dropIfExists('categories');
    }
};
