<?php

namespace App\Http\Controllers;

use App\Models\ScoreBoardUser;
use Illuminate\Http\Request;
use Validator;

class ScoreBoardUserController extends Controller
{
    /**
     * ScoreBoardUsers and details.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = ScoreBoardUser::get();
        if( $users->count() > 0 ) {
            return $users;
        } else {
            return ['error' => 'No users found'];
        }
    }

    /**
     * ScoreBoardUsers create.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'name'    => 'required',
            'age'     => 'required|numeric|min:1',
            'address' => 'required'
        ]);

        if( $validated->fails() ) {
            return [
                'error' => $validated->errors()
            ];
        } else {
            $user = new ScoreBoardUser;
            $user->name    = $request->name;
            $user->age     = $request->age;
            $user->address = $request->address;
            $user->points  = 0;
            $output = $user->save();
            if( $output ) {
                return [
                    'output'           => 'Score board user added',
                    'scoreBoardUserId' => $user->id
                ];
            } else {
                return [
                    'error' => 'Un-expected user added'
                ];
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ScoreBoardUser  $scoreBoardUser
     * @return \Illuminate\Http\Response
     */
    public function updateUserPoint( Request $request )
    {
        $messages = [
            'id.required' => "Selected user does not exists.",
            'id.exists' => "Selected user does not exists.",
            'isPlus.in' => "Un-expected input."
        ];
        $validated = Validator::make($request->all(), [
            'id'     => 'required|exists:App\Models\ScoreBoardUser,id',
            'isPlus' => 'required|in:1,0'
        ], $messages);

        if( $validated->fails() ) {
            return [
                'error' => $validated->errors()
            ];
        } else {
            $user = ScoreBoardUser::where([
                'id' => $request->id,
            ])->first();
            if( $request->isPlus == 1 ) { // add 1 point
                $user->points = $user->points + 1;
                $user->save();
                return [
                    'output' => 'User score added.'
                ];
            } else {
                $user->points = $user->points - 1;
                $user->save();
                return [
                    'output' => 'User score decremented.'
                ];
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $output = ScoreBoardUser::where([
            "id" => $id
        ])->delete();
        if( $output ) {
            return ['output' => 'User deleted'];
        } else {
            return ['error' => 'Un-expected error occur while deleting'];
        }
    }

}
