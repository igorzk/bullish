<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustodyAccount\CustodyAccountCreateRequest;
use App\Http\Requests\CustodyAccount\CustodyAccountUpdateRequest;
use App\Models\Accounts\CustodyAccount;
use App\Models\Entities\Custodian;
use App\Models\Entities\Investor;
use App\Models\Entities\Portfolio;
use Illuminate\Support\Facades\Gate;

class CustodyAccountController extends Controller
{
    public function index()
    {
        $accounts = CustodyAccount::with(['custodian', 'investor', 'portfolio', 'accountEvents'])
            ->get();
        return view('custody-account.index', compact('accounts'));
    }

    public function create()
    {
        Gate::authorize('create-account');
        $custodians = Custodian::all();
        $investors = Investor::all();
        $portfolios = Portfolio::all();
        return view('custody-account.create',
            compact('custodians', 'investors', 'portfolios'));
    }

    public function store(CustodyAccountCreateRequest $request)
    {
        Gate::authorize('create-account');
        CustodyAccount::create($request->input());
        return to_route('custody.index')
            ->with('status', 'Conta de custódia criada com sucesso');
    }

    public function edit(CustodyAccount $account)
    {
        Gate::authorize('create-account');
        $custodians = Custodian::all();
        return view('custody-account.edit',
            compact('custodians', 'account'));
    }

    public function update(CustodyAccountUpdateRequest $request, CustodyAccount $account)
    {
        $input = $request->only(['nickname', 'account_identifier', 'custodian_id']);
        $account->update($input);
        return to_route('custody.index')
            ->with('status', 'Conta atualizada com sucesso');
    }

    public function destroy(CustodyAccount $account)
    {
        Gate::authorize('create-account');
        if ($account->accountEvents->count() == 0) {
            $account->delete();
            return back()->with('status', 'Conta de custódia deletada com sucesso');
        } else {
            return back()->withErrors('Não é possível deletar conta com movimentação');
        }
    }
}
