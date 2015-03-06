<?php

class ChatController extends BaseController {
		public function getIndex() {
				return View::make('index');
		}

		public function postAddReply() {

				$rules = array(
						'message'     => 'required|min:2'
				);
				$validation = Validator::make(['message' => e(Input::get('message'))], $rules);
				if (!$validation->passes()){
						return Response::json(['status' => 'error',
																	 'data' => $validation->errors()->toArray(),
																	 'message' => 'You have some validation errors']);
				} else {
						$post = ChatPost::create(['user_id' => Auth::user()->id, 'message' => e(Input::get('message'))]);
						$post->save();

						return Response::json(['id' =>  $post->id, 200]);
				}
		}

		public function postPosts() {
				$posts = ChatPost::orderBy('created_at','desc')->limit(10)->get();
				return View::make('partials/posts')->with('posts', $posts);
		}
}
