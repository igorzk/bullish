<?php

namespace App\Http\Controllers\Events;

use App\Http\Controllers\Controller;
use App\Http\Requests\Events\CreateBovConfirmationRequest;
use App\Models\Events\AccountEvent;
use App\Services\Events\AccountEventValidator;
use App\Services\Events\BovConfirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BovConfirmationsController extends Controller
{
    use HasEventFilter;

    public function __construct(protected BovConfirmation $bovConfirmation, protected AccountEventValidator $validator){}
    public function index(Request $request)
    {
        $portfolios = $this->getPortfoliosWithEvents();

        $buildFilter = AccountEvent::bovConfirmation()
            ->with(['custodyAccount.investor', 'custodyAccount.portfolio', 'custodyAccount.custodian']);

        $buildFilter = $this->filterEventsByDateAndPortfolio($request, $buildFilter);

        $confirmations = $buildFilter->paginate(8);

        return view('events.account.bov-confirmation.index', compact('confirmations', 'portfolios'));
    }

    public function create()
    {
        Gate::authorize('create-event');
        $props = $this->getEntitiesForFilter();

        return view('events.account.bov-confirmation.create', compact('props'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(CreateBovConfirmationRequest $request)
    {
        $validate = $this->validator->validate($request->input());
        $validateBov = $this->bovConfirmation->validate($request->input());
        if (is_bool($validate) && is_bool($validateBov) && $validate && $validateBov) {
            $event = new AccountEvent();
            $event->fill($request->input());
            $event->type = 'bov';
            $path = $request->file('confirmation_file')->store('confirmation_files');
            $event->body = [...$this->bovConfirmation->getBody($request->input()),
                'file_path' => $path];
            $event->save();
            return to_route('bov-confirmations.index')->with('status', 'nota incluída com sucesso');
        } else {
            $error = [];
            if (!is_bool($validate)) {
                $error = [ $validate ];
            }
            if (!is_bool($validateBov)) {
                $error = [ ...$error, $validateBov ];
            }

            return back()->withErrors($error);
        }
    }

    public function destroy($id)
    {
        Gate::authorize('create-event');

        $validation = $this->validator->validateDestruction($id);
        if($validation !== true) {
            return back()->withErrors($validation);
        } else {
            AccountEvent::destroy($id);
            return back()->with('status', 'Evento deletado com sucesso');
        }
    }
}
