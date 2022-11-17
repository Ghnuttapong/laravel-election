<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Models\User;
use App\Models\Voter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth'); 
    }

    public function search_voter(Request $request)
    {
        $voter = Voter::where('user_id', Auth::user()->id)->get();
        count($voter) > 0 ? $count_chk_voter = 1 : $count_chk_voter = 0;

        $voted = Score::where('user_id', Auth::user()->id)->get();
        count($voted)? $count_voted = 1 : $count_voted = 0;

        if($count_voted) {
            $score = Voter::find($voted[0]->voter_id);
        }else{
            $score = [];
        }

        session(['regis_voter' => $count_chk_voter]);


        $search = $request->search;
        $users = User::where('name', 'LIKE', "%$search%" )->where('role', 2)->paginate(6);
        return view('user.index', compact('score', 'users', 'count_voted'));
    }

    public function index()
    {
        //
        $voter = Voter::where('user_id', Auth::user()->id)->get();
        count($voter) > 0 ? $count_chk_voter = 1 : $count_chk_voter = 0;

        $voted = Score::where('user_id', Auth::user()->id)->get();
        count($voted)? $count_voted = 1 : $count_voted = 0;

        if($count_voted) {
            $score = Voter::find($voted[0]->voter_id);
        }else{
            $score = [];
        }
        $voters = Voter::where('disabled', 0)->paginate(10);

        
        session(['regis_voter' => $count_chk_voter]);

        return view('user.index', compact('score', 'voters', 'count_voted'));
    }

    public function create()
    {
        //
        return view('user.create');
    }

    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'policy' => 'required | min: 10',
        ]);


        $voter = new Voter;
        $voter->user_id = Auth::user()->id;
        $voter->policy = $request->policy;
        // set number
        $new_number = Voter::latest()->paginate(1);
        if($new_number[0] != null) {
            $number = $new_number[0]->number + 1;
            $voter->number = $number;
        }   
        // end set
        $voter->save();
        return $this->index();
    }

    public function show($id)
    {
        //
        $user = User::find($id);
        return view('user.edit', compact('user'));
    }

    public function edit($id)
    {
        //
        $user = User::find($id);
        return view('user.update', compact('user'));
    }

    public function update(Request $request, $id)
    {
        //
        $validated = $request->validate([
            'name' => 'required',
            'picture' => $request->picture? 'mimes:jpeg,png,gif|max:2048': '',
            'password' => $request->password? 'min:6':'',
        ]);

        /* file upload */
        if($request->picture) {
            $fileName = time().'.'.$request->picture->extension();  
            $request->picture->move(public_path('profiles'), $fileName);
            $validated['picture'] = $fileName;
        }else{
            unset($validated['picture']);
        }
   
        if($request->password) {
            $validated['password'] = Hash::make($request->password);
        }else{
            unset($validated['password']);
        }

        DB::table('users')
        ->where('id', $id)
        ->update($validated);
        return redirect()->back()->with('msg', 'Updated successfully.');
    }

    public function destroy($id)
    {
        //
    }
}
