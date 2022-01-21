<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Departamento;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session as FacadesSession;


class UserController extends Controller
{

    //Lista todos os usuários
    public function index()
    {
        $usuarios = User::all();
        return view('dashboard.admin.usuarios.index', ['usuarios' => $usuarios]);
    }

  //Exibe o formulário de criação de user
  public function formCreate()
  {
      $departamentos = Departamento::all();
      return view('dashboard.admin.usuarios.criar', ['departamentos' => $departamentos]);
  }

  //Cria o User
  public function criarUser(Request $request)
  {
      //Validação do nome
      $regras = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:6', 'confirmed'],
        'cargo' => ['required', Rule::in(['admin', 'membro'])],
        'departamento' => ['exists:departamentos,id']
      ];

      $feedback = ['required' => 'O campo ":attribute" precisa ser preenchido!',
      'min' => 'O campo ":attribute" precisa ter menos caracteres',
      'max' => 'O campo  ":attribute"  pode ter mais caracteres',
      'email.unique' => 'Já existe um usuário com esse e-mail',
      'password.confirmed' => 'A confirmação de senha está incorreta',
      'departamento.exists' => 'O departamento não existe',
      ];

      $validacao = Validator::make($request->all(), $regras, $feedback);

      //retornando erro caso não passe na validacao
      if($validacao->fails()){
          return response()->json(["msg" => $validacao->errors()->first(), 400]);
      }

      //Validação de cpf
        // Extrai somente os números
        $cpf = preg_replace( '/[^0-9]/is', '', $request->get('cpf') );
            
        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return response()->json(["msg" =>'O CPF informado tem menos de 11 digitos', 400]);
        }
        
        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return response()->json(["msg" =>'O CPF informado não é válido', 400]);
        }

        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return response()->json(["msg" =>'O CPF informado não é válido', 400]);
            }
        }

      //Caso passe na validacao instancia um objeto de User
      $usuario = new User();
      $usuario->cpf = $request->get('cpf');
      $usuario->name = $request->get('name');
      $usuario->email = $request->get('email');
      $usuario->password = bcrypt($request->get('password'));
      $usuario->cargo = $request->get('cargo');
      $usuario->departamento_id = $request->get('departamento');
      $usuario->save();

      return response()->json(['msg' => 'O usuário foi criado com sucesso!']);
  }

  //Exibe o formulário de edição de user
  public function formEdit($id)
  {
      $user = User::find($id);
      $departamentos = Departamento::all();
      return view('dashboard.admin.usuarios.editar', ['user' => $user, 'departamentos' => $departamentos]);
  }

  //Edita o user
  public function editarUser(Request $request, $id)
  {
  
     //Validação do nome
     $regras = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255'],
        'password' => ['confirmed'],
        'cargo' => ['required', Rule::in(['admin', 'membro'])],
        'departamento' => ['exists:departamentos,id']
      ];

      $feedback = ['required' => 'O campo ":attribute" precisa ser preenchido!',
      'min' => 'O campo ":attribute" precisa ter mais caracteres',
      'max' => 'O campo  ":attribute"  pode ter mais caracteres',
      'email.unique' => 'Já existe um usuário com esse e-mail',
      'password.confirmed' => 'A confirmação de senha está incorreta',
      'departamento.exists' => 'O departamento não existe',
      ];

      $validacao = Validator::make($request->all(), $regras, $feedback);

      //retornando erro caso não passe na validacao
      if($validacao->fails()){
          return response()->json(["msg" => $validacao->errors()->first(), 400]);
      }

      //Caso passe na validacao instancia um objeto de User
      $usuario = User::find($id);
      $usuario->name = $request->get('name');
      $usuario->email = $request->get('email');
      //Se tiver alteração na senha (testar)
      if($request->get('password') != null){
        $usuario->password = bcrypt($request->get('password'));
      }
      $usuario->cargo = $request->get('cargo');
      $usuario->departamento_id = $request->get('departamento');
      $usuario->update();

      return response()->json(['msg' => 'O usuário foi atualizado com sucesso!']);

  }

  public function delete($id)
  {
      //Verificando se User realmente existe
      //<--! VERIFICAR SE TEM USUÁRIOS ASSOCIADOS EM BREVE 
      $user = User::find($id);
      if($user){
          $user->delete();
      }

      FacadesSession::flash('msg', 'O usuário "'.$user->name.'" foi deletado com sucesso!'); 

      return redirect()->route('usuario');
  }
}
