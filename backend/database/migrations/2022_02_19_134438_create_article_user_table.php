<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class CreateArticleUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_user', function (Blueprint $table) {
            
            $table->unsignedBigInteger('id', true);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('article_id');
            // timestampと書いてしまうと、レコード挿入時、更新時に値が入らないので、DB::rawで直接書いてます
           
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->unique(['user_id', 'article_id']);
            // 論理削除を定義→deleted_atを自動生成
            // 外部キー制約 user_idはusersテーブルのidが存在するものしか入らない
            //$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            //$table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_reaction');
    }
}
