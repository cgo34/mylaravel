<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Programme;
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Compatibility with Model binding.
        $id = $id instanceof Model ? $id->{$id->getKeyName()} : $id;

        $data = call_user_func([$dataType->model_name, 'findOrFail'], $id);
        dd($data);
        // Check permission
        $this->authorize('edit', $data);

        if (!Auth::user()->hasPermission('edit_roles')) {
            unset($request['role_id']);
        }

        // Validate fields with ajax
        $val = $this->validateBread($request->all(), $dataType->editRows);


        if ($val->fails()) {
            return response()->json(['errors' => $val->messages()]);
        }

        if (!$request->ajax()) {
            $this->insertUpdateData($request, $slug, $dataType->editRows, $data);

            event(new BreadDataUpdated($dataType, $data));

            return back()
                ->with([
                    'message'    => __('voyager.generic.successfully_updated')." {$dataType->display_name_singular}",
                    'alert-type' => 'success',
                ]);
        }
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
        $user = Auth::user();
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
                        if($myFavoriteLot->isBooked()){
                            $lots[] = array($myFavoriteLot, 'booked');
                        }

                    }
                }
                $favoris[] = array($programmes, $lots);
            }

        }


        return view('users.favorites', compact('myFavorites', 'myFavoritesLots', 'favoris'));
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
        $myBooks = Auth::user()->books;
        $myBooksLots = Auth::user()->booksLots;
        $myOptionRequests = Auth::user()->optionRequests;
        //dd($myOptionRequests);
        $optionRequests = array();
        $programmes = array();
        $lots = array();
        foreach ($myOptionRequests as $myOptionRequest){

            foreach ($myBooks as $myBook){

                if($myOptionRequest->programme_id == $myBook->id){
                    if(!in_array($myBook, $programmes)){
                        $programmes[] = $myBook;
                    }
                    if(!in_array($myOptionRequest, $lots)){
                        $lots[] = $myOptionRequest;
                    }

                }else{
                    if(!in_array($myOptionRequest, $programmes)){
                        $prog = Programme::find($myOptionRequest->programme_id);
                        $programmes[] = $prog;
                    }
                    if(!in_array($myOptionRequest, $lots)){
                        $lots[] = $myOptionRequest;
                    }
                }
                $optionRequests[] = array($programmes, $lots);
            }

        }



        return view('users.books', compact('myBooks', 'myOptionRequests', 'optionRequests'));
    }
}
