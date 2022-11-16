<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Models\User;
use App\Models\Voter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use SebastianBergmann\Complexity\ComplexityCalculatingVisitor;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isAdmin');
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

        $validated = $request->validate([
            'from' => 'required',
            'to' => 'required',
        ]);
        $from = $request->from;
        $to = $request->to;
        $voters = Voter::whereBetween('created_at', [$from, $to])->paginate(6);
        return view('admin.index', compact('voters', 'count_voted', 'count_user'));
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

        $voters = Voter::paginate(5);
        return view('admin.index', compact('voters', 'count_voted', 'count_user'));
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
            'password' => 'required|min:6',
            'role' => 'required',
        ]);

        $validated['password'] = Hash::make($request->password);
        DB::table('users')
            ->where('id', $id)
            ->update($validated);
        return redirect('admin/users');
    }

    public function destroy($id)
    {
        //
        $date = date('Y-m-d H:i:s');
        $user = User::find($id);
        $user->deleted_at = $date;
        $user->save();
        return back()->with('msg', 'deleted successfull');
    }
}
