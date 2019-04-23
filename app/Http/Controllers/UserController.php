<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Programme;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        User::All();
        if(Auth::user()){
            $user = Auth::user();
            return response()->json($user);
        }else{
            $user = false;
            return response()->json($user);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return User::create([
            'civilite' => $data['civilite'],
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => $data['role_id'],
            'cabinet' => $data['cabinet'],
            'titulaire' => $data['titulaire'],
            'carte' => $data['carte'],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Get all favorite posts by user
     *
     * @return Response
     */
    public function myFavorites()
    {
        $myFavorites = Auth::user()->favorites;
        $myFavoritesLots = Auth::user()->favoritesLots;

        $favoris = array();
        $programmes = array();
        $lots = array();
        foreach ($myFavoritesLots as $myFavoriteLot){

            foreach ($myFavorites as $myFavorite){

                if($myFavoriteLot->programme_id == $myFavorite->id){
                    if(!in_array($myFavorite, $programmes)){
                        $programmes[] = $myFavorite;
                    }
                    if(!in_array($myFavoriteLot, $lots)){
                        $lots[] = $myFavoriteLot;
                    }

                }else{
                    if(!in_array($myFavorite, $programmes)){
                        $prog = Programme::find($myFavoriteLot->programme_id);
                        $programmes[] = $prog;
                    }
                    if(!in_array($myFavoriteLot, $lots)){
                        $lots[] = $myFavoriteLot;
                    }
                }
                $favoris[] = array($programmes, $lots);
            }

        }


        return view('users.favorites', compact('myFavorites', 'myFavoritesLots', 'favoris'));
    }
}
