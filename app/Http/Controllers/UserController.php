<?php

namespace App\Http\Controllers;

use App\Dispositif;
use App\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Programme;
use App\PropertiesType;
use App\Lot;
use App\OptionRequests;


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
            $user = User::find(Auth::user()->id);
            return response()->json($user);
        }else{
            $user = false;
            return response()->json($user);
        }

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->username = $request->get('username');
        // $user->role_id = $request->get('role_id');
        $user->email = $request->get('email');
        $user->phone = $request->get('phone');
        $user->genre = $request->get('genre');
        $user->firstname = $request->get('firstname');
        $user->lastname = $request->get('lastname');
        $user->address = $request->get('address');
        $user->zipcode = $request->get('zipcode');
        $user->city = $request->get('city');
        $user->company = $request->get('company');
        $user->holder = $request->get('holder');
        $user->card = $request->get('card');
        $user->settings = $user->setLocaleAttribute('fr');
        $user->save();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
        return $user;
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
        $properties = Property::with('dispositifs', 'properties', 'services', 'features', 'favorites')
            //->where('parent', '=', NULL)
            ->whereHas('favorites', function ($query) {
                $query->where('user_id','=',Auth::user()->id);
            })
            ->orderBy('id', 'DESC')
            ->get();
        //dd($properties);

        $types = PropertiesType::all();

        return view('users.favorites', compact('properties', 'types'));

        $programmes = Programme::with('dispositifs', 'lots.optionRequests', 'lots.favorites')
            ->whereHas('lots.favorites', function ($query) {
                $query->where('user_id','=',Auth::user()->id);
            })
            ->orderBy('id', 'DESC')
            ->get();
        return view('users.favorites', compact('programmes'));
    }

    /**
     * Get all favorite posts by user
     *
     * @return Response
     */
    public function myBooks()
    {

        $myBooks = Auth::user()->books;
        $myBooksLots = Auth::user()->booksLots;

        $books = array();
        $programmes = array();
        $lots = array();
        foreach ($myBooksLots as $myBookLot){

            foreach ($myBooks as $myBook){

                if($myBookLot->programme_id == $myBook->id){
                    if(!in_array($myBook, $programmes)){
                        $programmes[] = $myBook;
                    }
                    if(!in_array($myBookLot, $lots)){
                        $lots[] = $myBookLot;
                    }

                }else{
                    if(!in_array($myBookLot, $programmes)){
                        $prog = Programme::find($myBookLot->programme_id);
                        $programmes[] = $prog;
                    }
                    if(!in_array($myBookLot, $lots)){
                        $lots[] = $myBookLot;
                    }
                }
                $books[] = array($programmes, $lots);
            }
        }
        return view('users.books', compact('myBooks', 'myBooksLots', 'books'));
    }

    /**
     * Get all favorite posts by user
     *
     * @return Response
     */
    public function myOptionRequests()
    {
        $programmes = Programme::with('dispositifs', 'lots.optionRequests', 'lots.favorites')
            ->whereHas('lots.optionRequests', function ($query) {
                $query->where('user_id','=',Auth::user()->id);
            })
            ->orderBy('id', 'DESC')
            ->get();
        return view('users.books', compact('programmes'));
    }
}
