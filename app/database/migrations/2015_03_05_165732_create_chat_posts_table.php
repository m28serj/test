<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatPostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
		public function up() {
				Schema::create('chat_posts', function ($table) {
						$table->increments('id');
						$table->integer('user_id');
						$table->string('message');
						$table->nullableTimestamps();
				});
		}

		/**
		 * Reverse the migrations.
		 * @return void
		 */
		public function down() {
				Schema::dropTable('chat_posts');
		}

}
