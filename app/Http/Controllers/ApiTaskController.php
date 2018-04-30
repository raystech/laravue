<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Procedure;

use Response;
use Faker;

class ApiTaskController extends Controller
{
	public function store(Request $request) {
		$faker = Faker\Factory::create();
	  $crud = new Procedure();
	  $crud->procedure_type = $faker->word;
	  $crud->procedure_name = $request->get('name');
	  $crud->save();

	  return response($crud->jsonSerialize());
	}

	public function index() {
		return response()->json(Procedure::orderBy('procedure_name')->get());
	}

	public function destroy($id) {
		Procedure::destroy($id);
	}
}
