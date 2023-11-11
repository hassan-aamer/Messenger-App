<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use TijsVerkoyen\CssToInlineStyles\Css\Rule\Rule;


class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $user=Auth::user();
        $conversations = $user->conversations()->findOrFail($id);
        return $conversations->messages()->paginate();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,$id)
    {
        $request->validate([
            'message'=>['required','string'],
            'conversation_id' => [
                Rule::requiredIf(function () use ($request) {
                    return !$request->input('user_id');
                }),
                'integer',
                'exists:conversations,id',
            ],
            

            'user_id'=>[
                Rule::requiredIf(function() use($request){
                    return !$request->input('conversation_id');
                }),
                'integer',
                'exists:users,id'],
        ]);
        
        $user=Auth::user();
        $conversations_id=$request->post('conversations_id');
        $user_id=$request->post('user_id');

        if($conversations_id)
        {
            $conversations = $user->conversations()->findOrFail($conversations_id);
        }

        $message=
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
