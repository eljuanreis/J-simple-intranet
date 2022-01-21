@extends('layouts.dashboard')

@section('conteudo')
<div class="card">
  <div class="card-header">
    Bem-vindo ao gerenciamento de usuário!
  </div>
  <div class="card-body">
    <h5 class="card-title">Lista dos usuários criados</h5>
    <a href="{{route('usuario.create.form')}}">Criar usuário</a>
    @if(Session::has('msg'))
    <h5>{{Session::get('msg')}}</h5>
    @endif
    <table width="100%;">
      <tr>
        <th>ID do Usuário</th>
        <th>CPF</th>
        <th>Nome</th>
        <th>E-mail</th>
        <th>Cargo</th>
        <th>Departamento</th>
        <th>Editar</th>
        <th>Apagar</th>
      </tr>
      @foreach ($usuarios as $user)
      <tr>
            <td>{{$user->id}}</td>
            <td class="cpf">{{$user->cpf}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->cargo}}</td>
            <td>{{$user->departamento->nome}}</td>
            <td>
              <a style="text-decoration: none;" href="{{route('usuario.update.form', ['id' => $user->id])}}"><ion-icon name="brush-outline"></ion-icon></button>
            </td>
            <td>
            <form action="{{route('usuario.delete', ['id' => $user->id])}}" method="POST">
              @method('delete')
              @csrf
              <button style="border: none;" type="submit"><ion-icon name="trash-outline"></ion-icon>
              </button>
            </form>
            </td>
      </tr>
      @endforeach

    </table>
  </div>
</div>

@endsection
