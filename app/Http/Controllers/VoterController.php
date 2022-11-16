<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Voter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoterController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth'); 
       $this->middleware('isVoter'); 
    }


    public function search_voter(Request $request)
    {
        $voters = Voter::where('disabled', 0)->paginate(10);


        $search = $request->search;
        $users = User::where('name', 'LIKE', "%$search%" )->where('role', 2)->paginate(6);
        return view('voter.index', compact('users'));
    }

    public function score() {
        //
        $user = User::find(Auth::user()->id);
        return view('voter.score', compact('user'));
    }

    public function index()
    {
        //
        $voters = Voter::where('disabled', 0)->paginate(10);
        return view('voter.index', compact('voters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $validated = $request->validate([
            'number' => 'required | unique:voter',
            'policy' => 'required | min: 10',
        ]);

        
        array_push($validated, ['user_id' => Auth::user()->id]);
        $voter = new Voter();
        $voter->user_id = Auth::user()->id;
        $voter->policy = $request->policy;
        $voter->number = $request->number;
        $voter->save();
        return back()->with('msg', 'Apply to elector successfully');
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
        $validated = $request->validate([
            'policy' => 'required | min: 10',
        ]);

        $voter = Voter::find($id);
        $voter->policy = $validated['policy'];
        $voter->save();
        return back();
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
}
