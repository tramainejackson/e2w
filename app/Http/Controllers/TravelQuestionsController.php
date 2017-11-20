<?php

namespace App\Http\Controllers;

use App\TravelQuestions;
use Illuminate\Http\Request;

class TravelQuestionsController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['store', 'create']);
    }
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.questions');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modals.questions');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $question = new TravelQuestions();
		
		$question->first_name = $request->first_name;
		$question->last_name = $request->last_name;
		$question->user_email = $request->question_text;
		$question->user_question = $request->question_text;
		
		if($question->save()) {
			return "<span>Question received. We will get back to you as soon as possible.</span>";
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Travel_Questions  $travel_Questions
     * @return \Illuminate\Http\Response
     */
    public function show(TravelQuestions $travelQuestions)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Travel_Questions  $travel_Questions
     * @return \Illuminate\Http\Response
     */
    public function edit(Travel_Questions $travel_Questions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Travel_Questions  $travel_Questions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Travel_Questions $travel_Questions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Travel_Questions  $travel_Questions
     * @return \Illuminate\Http\Response
     */
    public function destroy(Travel_Questions $travel_Questions)
    {
        //
    }
}
