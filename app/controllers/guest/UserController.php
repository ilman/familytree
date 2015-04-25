<?php

namespace Guest;

use BaseController;
use View;
use Auth;
use Redirect;
use Validator;
use Input;

class UserController extends BaseController {

	public function getLogin()
	{
		$data = array(
			'content' => 'guest/login',
		);
		return View::make($this->template, $data);
	}

	public function getLogout()
	{
		Auth::logout();
		return Redirect::to('login');
	}

	public function postLogin()
	{
		$rules = array(
			'email'    => 'required|min:5',
			'password' => 'required|alphaNum|min:6',
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('login')
				->withErrors($validator)
				->withInput(Input::except('password'));
		}

		$userdata = array(
			'email' 	=> Input::get('email'),
			'password' 	=> Input::get('password')
		);

		if (Auth::attempt($userdata)){
			return Redirect::to('member/silsilah');
		}
		else{
			return Redirect::to('login');
		}
	}

}
