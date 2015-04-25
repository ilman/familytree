<?php

namespace Member;

use BaseController;
use View;
use Auth;
use Redirect;
use Validator;
use Input;
use DB;
use Exception;

class SilsilahController extends BaseController {

	public function getIndex()
	{
		$result = DB::table('persons')->get();
		
		$data = array(
			'content' => 'member/silsilah',
			'result' => $result,
		);
		return View::make($this->template, $data);
	}

	private function validateForm($param='add')
	{
		$input = Input::all();

		$rules = array(
			'parent_id' => 'required',
			'name' => 'required',
		);

		if($param == 'edit'){
			$rules['id'] = 'required';
		}

		$validator = Validator::make($input, $rules);

		return $validator;
	}

	public function postAdd()
	{
		$validator = self::validateForm();
		if($validator->fails()){
			return Redirect::to('member/silsilah')
			->withErrors($validator)->withInput();
		}

		$family_id = (int) Input::get('family_id', 0);
		$parent_id = (int) Input::get('parent_id', 0);
		$child_id = (int) Input::get('child_id', 0);
		$name = Input::get('name', '');
		$order = (int) Input::get('order', 0);

		$data = array(
			'parent_id' => $parent_id,
			'name' => $name,
			'order' => $order,
		);

		if($family_id){
			$data['family_id'] = $family_id;
		}

		try{
			$person_id = DB::table('persons')->insertGetId($data);

			if(!$family_id){

				$data = array(
					'family_id' => $person_id,
				);

				DB::table('persons')->where('id', '=', $person_id)->update($data);
			}

			if(!$parent_id && $child_id){
				$data = array(
					'parent_id' => $person_id,
				);

				DB::table('persons')->where('id', '=', $child_id)->update($data);
			}

			echo 'success';

			//return Redirect::to('member/silsilah')->with('flash_success', 'messages.add_person_success');
		}
		catch(Exception $e){

			echo '<pre style="padding:10px; border:#ddd solid 1px; background:#eee; color:#999;">';
			print_r($e->getMessage());
			echo '</pre>';

			echo 'failed';
			//return Redirect::to('member/silsilah')->with('flash_error', 'messages.add_person_failed');
		}
	}

	public function postEdit()
	{
		$person_id = Input::get('id');
		$family_id = Input::get('family_id', 0);
		$parent_id = Input::get('parent_id', '');
		$name = Input::get('name', '');
		$order = Input::get('order', '0');

		$validator = self::validateForm('edit');
		if($validator->fails()){
			return Redirect::to('member/silsilah')
			->withErrors($validator)->withInput();
		}

		$data = array(
			'family_id' => $family_id,
			'parent_id' => $parent_id,
			'name' => $name,
			'order' => $order,
		);

		try{
			DB::table('persons')->where('id', '=', $person_id)->update($data);

			return Redirect::to('member/silsilah')->with('flash_success', 'messages.update_person_success');
		}
		catch(Exception $e){
			return Redirect::to('member/silsilah')->with('flash_error', 'messages.update_person_failed');
		}
	}

	public function postDelete()
	{
		$person_id = Input::get('person_id');

		try{
			DB::table('person')->where('id', '=', $person_id)->delete();

			return Redirect::to('member/silsilah')->with('flash_success', 'messages.delete_person_success');
		}
		catch(Exception $e){
			return Redirect::to('member/silsilah')->with('flash_error', 'messages.delete_person_failed');
		}
	}

}
