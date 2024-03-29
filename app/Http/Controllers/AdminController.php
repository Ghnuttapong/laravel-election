<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Models\User;
use App\Models\Voter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isAdmin');
    }

    public function recover(Request $request) {
        $restore = User::withTrashed()->where('id', $request->id)->restore();
        return back()->with('msg', 'Restored successful.');
    }

    public function recover_member() {
        $count_users = User::onlyTrashed()->count(); 
        $users = User::onlyTrashed()->paginate(6);
        return view('admin.recover', compact('count_users', 'users'));
    }

    public function voters()
    {
        $voters = Voter::where('disabled', 1)->paginate(10);
        return view('admin.voters', compact('voters'));
    }

    public function search_member(Request $request)
    {
        $search = $request->search;
        $users = User::where('name', 'LIKE', "%$search%" )->paginate(6);
        return view('admin.users', compact('users'));
    }

    public function search_voter(Request $request)
    {
        $score = Score::all();
        $count_voted = count($score);

        $users = User::all();
        $count_user = count($users);

        $search = $request->search;
        $users = User::where('name', 'LIKE', "%$search%" )->where('role', 2)->paginate(6);
        return view('admin.index', compact('users', 'count_voted', 'count_user'));
    }

    public function search_date(Request $request)
    {
        $score = Score::all();
        $count_voted = count($score);

        $users = User::all();
        $count_user = count($users);

        $voter = Voter::all();
        $count_voter = count($voter);

        $validated = $request->validate([
            'from' => 'required',
            'to' => 'required',
        ]);
        $from = $request->from;
        $to = $request->to;
        $voters = Voter::whereBetween('created_at', [$from, $to])->paginate(6);
        return view('admin.index', compact('voters', 'count_voted', 'count_user', 'count_voter'));
    }

    public function voter_approve($id)
    {
        $voter = Voter::find($id);
        $voter->disabled = 0;
        $user = User::find($voter->user_id);
        $user->role = 2;
        $user->save();
        $voter->save();
        return back()->with('msg', 'Approved.');
    }

    public function users()
    {
        $users = User::paginate(6);
        return view('admin.users', compact('users'));
    }

    public function index()
    {
        $score = Score::all();
        $count_voted = count($score);

        $users = User::all();
        $count_user = count($users);

        $voters = Voter::where('disabled', 0)->paginate(10);
        $count_voter = count($voters);

        $voters = Voter::paginate(5);
        return view('admin.index', compact('voters', 'count_voted', 'count_user', 'count_voter'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
        $search = $request->search;
        $users = User::where('name', 'link', "%{$search}%")->paginate(6);
        return view('admin.users', compact('users'));
    }

    public function show($id)
    {
        //
        $users = User::where('role', $id)->paginate(6);
        $role = $id;
        return view('admin.users', compact('users', 'role'));
    }

    public function edit($id)
    {
        //
    }

    // update user profile
    public function update(Request $request, $id)
    {
        //
        $validated = $request->validate([
            'name' => 'required',
            'password' => $request->password? 'min:6' : '',
            'role' => 'required',
        ]);

        if($request->password) {
            $validated['password'] = Hash::make($request->password);
        }else{
            unset($validated['password']); 
        }
        DB::table('users')
            ->where('id', $id)
            ->update($validated);
        return redirect('admin/users');
    }

    public function destroy($id)
    {
        //
        $user = User::find($id)->delete();
        return back()->with('msg', 'deleted successfull');
    }
}
