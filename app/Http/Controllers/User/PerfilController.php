<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PerfilController extends Controller
{
    public function index()
    {
        $usuario = User::find(Auth::user()->id);
        return view('dashboard.user.perfil', ['user' => $usuario]);
    }

    public function editarProprioPerfil(Request $request)
    {
     //Validação do nome
     $regras = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255'],
        'password' => ['confirmed']
      ];

      $feedback = ['required' => 'O campo ":attribute" precisa ser preenchido!',
      'min' => 'O campo ":attribute" precisa ter mais caracteres',
      'max' => 'O campo  ":attribute" pode ter mais caracteres',
      'email.unique' => 'Já existe um usuário com esse e-mail',
      'password.confirmed' => 'A confirmação de senha está incorreta',
      ];

      $validacao = Validator::make($request->all(), $regras, $feedback);

      //retornando erro caso não passe na validacao
      if($validacao->fails()){
          return response()->json(["msg" => $validacao->errors()->first(), 400]);
      }

      
      $usuario = User::find(Auth::user()->id);
      //Caso passe na validacao instancia um objeto de User
      $usuario->name = $request->get('name');

      //Se tiver alteração no email
      if($usuario->email != $request->get('email')){
            //Verificando se já há outro usuário com o mesmo e-mail
            $email = User::where('email', $request->get('email'));
            if($email->count() > 0){
                return response()->json(["msg" => 'Já existe um usuário com esse e-mail', 400]);
            }
        $usuario->email = $request->get('email');
      }

      //Se tiver alteração na senha (testar)
      if($request->get('password') != null){
        $usuario->password = bcrypt($request->get('password'));
      }
      $usuario->update();

      return response()->json(['msg' => 'Seu perfil foi atualizado com sucesso!']);
    }
}
