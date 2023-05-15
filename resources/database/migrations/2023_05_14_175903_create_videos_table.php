<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Video\Models\VideoState;

class CreateVideosTable extends Migration {

    public function up() {
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->intOrBigIntBasedOnRelated('user_id', Schema::connection(null), 'users.id');
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('url')->nullable();
            $table->boolean('is_upload')->default(false);
            $table->string('service')->nullable();
            $table->string('service_id')->nullable();
            $table->text('excerpt')->nullable();
            $table->text('description')->nullable();
            $table->enum('state', VideoState::values())->nullable();
            $table->string('ext_title', 511)->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users');
        });
    }

    public function down() {
        //
    }

}
