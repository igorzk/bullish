<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\EditPermissionsRequest;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class UserPermissionController extends Controller
{
    public function index()
    {
        Gate::authorize('manage-users');

        $users = User::with('permissions')->approved()
            ->paginate(8, ['id', 'name', 'email', 'approved']);
        $permissions = Permission::all();

        return view('user.permissions', compact("users", "permissions"));

    }
    public function store(EditPermissionsRequest $request, User $user)
    {
        $newPerms = $request->perms;
        $oldPerms = $user->permissions->pluck('id')->toArray();

        if ($newPerms == null) {
            $deletePerms = $oldPerms;
        } else {
            $deletePerms = array_diff($oldPerms, $newPerms);
        }

        if ($newPerms == null)
        {
            $createPerms = [];
        } else {
            $createPerms = array_diff($newPerms, $oldPerms);
        }

        $adminPermissionId = Permission::query()
            ->where('name', 'admin')->get('id')->first()->id;

        if (in_array($adminPermissionId, $deletePerms) and User::admin()->count() <= 1) {
            return back()->withErrors(
                "Não é possível retirar única permissão de administrador do sistema");
        }

        if (count($deletePerms) > 0) {
            $user->permissions()->detach($deletePerms);
        }

        if (count($createPerms) > 0) {
            $user->permissions()->attach($createPerms);
        }

        $status = (count($deletePerms) > 0 or count($createPerms) > 0) ? "
            Permissões alteradas com sucesso" : "Não houve alterações nas permissões";

        return back()->with('status', $status);
    }
}
