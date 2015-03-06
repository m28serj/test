<?php

class ChatPost extends Eloquent {
		protected $table = "chat_posts";
		protected $fillable = ['user_id', 'message'];

		public function user() {
				return $this->belongsTo('User', 'user_id');
		}
}