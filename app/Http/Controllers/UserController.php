<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $currentUserID = Auth::user()->id;
    
        $hobbyTerm = $request->input('hobby');
    
        $sentRequestUserIDs = DB::table('friend_requests')
            ->where('sender_id', '=', $currentUserID)
            ->pluck('receiver_id');
    
        $friendUserIDs = DB::table('friends')
            ->where('user_id', '=', $currentUserID)
            ->pluck('friend_id');
    
        $dataUser = User::whereNotIn('id', $sentRequestUserIDs)
            ->whereNotIn('id', $friendUserIDs)
            ->where('id', '!=', $currentUserID)
            ->when($hobbyTerm, function ($query, $hobbyTerm) {
                return $query->where('hobbies_field', 'like', '%' . $hobbyTerm . '%');
            })
            ->get();
    
        return view('home', compact('dataUser'));
    }
    


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
