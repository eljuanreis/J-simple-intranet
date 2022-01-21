<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Departamento;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as FacadesSession;

class DepartamentoController extends Controller
{

    //Lista todos os deps
    public function index()
    {
        $departamentos = Departamento::all();
        return view('dashboard.admin.departamentos.index', ['departamentos' => $departamentos]);
    }

    //Exibe o formulário de criação de dep
    public function formCreate()
    {
        return view('dashboard.admin.departamentos.criar');
    }

    //Cria o departamento
    public function criarDep(Request $request)
    {
        //Validação do nome
        $regras = [
            'nome' => 'required|min:3|max:40|unique:departamentos',
        ];

        $feedback = ['required' => 'O campo nome precisa ser preenchido!',
        'nome.min' => 'O campo nome precisa ter no mínimo 3 caracteres',
        'nome.max' => 'O campo nome pode ter no máximo 4 caracteres',
        'nome.unique' => 'Já existe um departamento com esse nome'
        ];

        $validacao = Validator::make($request->all(), $regras, $feedback);

        //retornando erro caso não passe na validacao
        if($validacao->fails()){
            return response()->json(["msg" => $validacao->errors()->first(), 400]);
        }

        //Caso passe na validacao instancia um objeto de departamento
        $departamento = new Departamento();
        $departamento->nome = $request->get('nome');
        $departamento->save();

        return response()->json(['msg' => 'O departamento foi criado com sucesso!']);
    }

    //Exibe o formulário de edição de dep
    public function formEdit($id)
    {
        $dep = Departamento::find($id);
        return view('dashboard.admin.departamentos.editar', ['departamento' => $dep]);
    }

    //Edita o dep
    public function editarDep(Request $request, $id)
    {
        //Validação do nome
        $regras = [
            'nome' => 'required|min:3|max:40|unique:departamentos',
        ];

        $feedback = ['required' => 'O campo nome precisa ser preenchido!',
        'nome.min' => 'O campo nome precisa ter no mínimo 3 caracteres',
        'nome.max' => 'O campo nome pode ter no máximo 4 caracteres',
        'nome.unique' => 'Já existe um departamento com esse nome'
        ];

        $validacao = Validator::make($request->all(), $regras, $feedback);

        //retornando erro caso não passe na validacao
        if($validacao->fails()){
            return response()->json(["msg" => $validacao->errors()->first(), 400]);
        }

        //Caso passe na validacao instancia um objeto de departamento
        $departamento = Departamento::find($id);
        if($departamento){
            $departamento->nome = $request->get('nome');
            $departamento->update();
            return response()->json(['msg' => 'O departamento foi atualizado com sucesso!']);
        }else{
            return response()->json(["msg" => 'O departamento não existe', 400]);
        }

    }

    public function delete($id)
    {
        //Verificando se departamento realmente existe
        //<--! VERIFICAR SE TEM USUÁRIOS ASSOCIADOS EM BREVE 
        $dep = Departamento::find($id);
        $associdados = User::where('departamento_id', $id);
        if($associdados->count() > 0){
            FacadesSession::flash('msg', 'Não foi possível deletar, pois tem usuários associados a este departamento'); 
            return redirect()->route('departamento');
        }

        if($dep){
            $dep->delete();
        }

        FacadesSession::flash('msg', 'O departamento foi deletado com sucesso!'); 

        return redirect()->route('departamento');
    }
}
