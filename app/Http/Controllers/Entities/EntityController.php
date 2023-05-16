<?php

namespace App\Http\Controllers\Entities;

use App\Http\Controllers\Controller;
use App\Http\Requests\Entity\CreateEntityRequest;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

abstract class EntityController extends Controller
{
    abstract protected function getModel(): string;

    protected function getModelName(): string
    {
        return Str::lower(class_basename($this->getModel()));
    }

    public function index()
    {
        $class = $this->getModel();
        $modelName = $this->getModelName();
        $entityCollection = $class::with('custodyAccounts')->get();

        return view("entities.{$modelName}.index", compact("entityCollection"));
    }

    public function create()
    {
        Gate::authorize('create-entity');
        $modelName = $this->getModelName();
        return view("entities.{$modelName}.create");
    }

    public function store(CreateEntityRequest $request)
    {
        Gate::authorize('create-entity');
        try {
            $entity = $this->getModel()::create($request->all());
            $entity->save();
            return redirect()->action([get_class($this), 'index'])
                    ->with('status', 'Criada entidade: ' . $entity->nickname);
        } catch(QueryException $exception) {
            $alreadyExists = $this->getModel()::query()
                ->where('nickname', Str::lower($request->nickname))->count() > 0;
            if ($alreadyExists) {
                $status = "já existe entidade cadastrada com o nome $request->nickname";
            } else {
                $status = "algum erro ocorreu ao cadastrar $request->nickname";
            };
            return back()->withErrors($status);
        }
    }

    public function update(CreateEntityRequest $request, int $id)
    {
        Gate::authorize('create-entity');
        $entitiy = $this->getModel()::find($id)->update($request->all());
        return
            redirect()->action([get_class($this), 'index'])
                ->with('status', 'apelido atualizado com sucess');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        Gate::authorize('create-entity');
        $class = $this->getModel();
        $entity = $class::with('custodyAccounts')->find($id);
        if ($entity->custodyAccounts->count() == 0) {
            $entity->delete();
            return back()->with('status', "Deletado com sucesso");
        } else {
            return back()->withErrors('Entidade já possui conta associada');
        }
    }
}
