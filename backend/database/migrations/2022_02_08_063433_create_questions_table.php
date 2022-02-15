<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            // $table->id();
            
            // 外部キー制約があるのでunseined 🟡第二引数をtrueにすると自動で数が上がる、なくても同じ？
            $table->unsignedBigInteger('id', true);
            $table->unsignedBigInteger('user_id');
            $table->string('title',100);
            $table->longText('content');
            // timestampと書いてしまうと、レコード挿入時、更新時に値が入らないので、DB::rawで直接書いてます
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            // 論理削除を定義→deleted_atを自動生成
            $table->softDeletes();
            // 外部キー制約 user_idはusersテーブルのidが存在するものしか入らない
            $table->foreign('user_id')->references('id')->on('users');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
