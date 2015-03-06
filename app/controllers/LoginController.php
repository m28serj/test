<?php

class LoginController extends BaseController {

		public function login() {

				$username = e(trim(Input::get('username')));
				$password = e(Input::get('password'));

				$rules = array(
						'username'     => 'required|min:3',
						'password'     => 'required|min:6'
				);

				$validation = Validator::make(['username' => $username, 'password' => $password], $rules);
				if (!$validation->passes()){

						return Redirect::back()->withInput()->withErrors($validation->errors());
				} else {

						if (!Auth::attempt(['username' => $username, 'password' => $password])) {

								if (!count(User::where('username', '=', $username)->get())) {

										User::create(['username' => $username,
																	'password' => Hash::make($password)
																 ]);
										if(Auth::attempt(['username' => $username, 'password' => $password])){

												return Redirect::to('')->with('success', 'You have successfully registered and logged in');
										} else {
												return Redirect::back()->with('error', 'Registration error');
										}

								} else {
										return Redirect::back()->with('error', 'User already exists, try another username');
								}

								return Redirect::to('');

						} else {
								return Redirect::to('')->with('success', 'You have been successfully logged in');
						}
				}
		}

		public function logout() {

				Auth::logout();

				return Redirect::to('');
		}
}