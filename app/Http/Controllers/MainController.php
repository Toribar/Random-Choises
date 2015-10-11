<?php

namespace App\Http\Controllers;

use Input;
use Session;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
	public function getIndex()
	{
		$questions = Session::get('questions', []);

		$chosenQuestions = Session::get('chosenQuestions', []);

		return view('main.index', compact('questions', 'chosenQuestions'));
	}
	public function postAdd()
	{
		$newQuestion = Input::get('newQuestion');

		if ($newQuestion)
		{
			Session::push('questions', $newQuestion);
		}


		return redirect('/');
	}

	public function postRandom()
	{
		$count = Input::get('count');

		Session::put('randomCount', $count);

		//1. Ispraznimo chosenQuestions array u session-u
		Session::forget('chosenQuestions');

		//2.Ucitamo sva pitanja iz session-a
		$questions = Session::get('questions', []);

		$chosenQuestions = [];

		$total = count($questions);

		if ($total == 0)
		{
			Session::flash('errorMessage', 'Desila se greska');

			return redirect('/');
		}

		//3.Napunimo session array chosenQuestions sa random pitanjima
		while ( count($chosenQuestions) < $count)
		{


			$randomIndex = rand() % $total;

			$chosenQuestion = $questions[$randomIndex];

			$chosenQuestions[$randomIndex] = $chosenQuestion;

		}
		Session::set('chosenQuestions', $chosenQuestions);

		return redirect('/');
	}
	public function getClear()
	{
		Session::flush();

		return redirect('/');

	}
}
