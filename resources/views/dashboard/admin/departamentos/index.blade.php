@extends('layouts.dashboard')

@section('conteudo')
<div class="card">
  <div class="card-header">
    Bem-vindo ao gerenciamento de departamento!
  </div>
  <div class="card-body">
    <h5 class="card-title">Lista dos departamentos criados</h5>
    <a href="{{route('departamento.create.form')}}">Criar departamentos</a>
    @if(Session::has('msg'))
    <h5>{{Session::get('msg')}}</h5>
    @endif
    <table width="100%;">
      <tr>
        <th>ID do Departamento</th>
        <th>Nome</th>
        <th>Editar</th>
        <th>Apagar</th>
      </tr>
      @foreach ($departamentos as $departamento)
      <tr>
            <td>{{$departamento->id}}</td>
            <td>{{$departamento->nome}}</td>
            <td>
              <a style="text-decoration: none;" href="{{route('departamento.update.form', ['id' => $departamento->id])}}"><ion-icon name="brush-outline"></ion-icon></button>
            </td>
            <td>
            <form action="{{route('departamento.delete', ['id' => $departamento->id])}}" method="POST">
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