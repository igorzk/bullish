<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ApproveUserController extends Controller
{

    public function index()
    {

        Gate::authorize('manage-users');

        $users = User::with('permissions')
            ->where('approved', false)
            ->paginate(8, ['id', 'name', 'email', 'approved']);
        return view('user.approve', compact("users"));

    }

    public function store(Request $request)
    {
        /* @var User $user */

        Gate::authorize('manage-users');

        $user = User::find($request->id);
        if (! $user->approved)
        {
            $user->approved = true;
            $user->save();
            return back()->with('status', "Usuário $user->name aprovado");
        } else {
            return back()->withErrors('Usuário já aprovado');
        }
    }
}
