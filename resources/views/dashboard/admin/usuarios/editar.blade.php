@extends('layouts.dashboard')

@section('conteudo')
<div class="card">
  <div class="card-header">
    Bem-vindo ao gerenciamento do usuário: {{$user->name}}
  </div>
  <div class="card-body">
    <h5 class="card-title">Você pode editar o '{{$user->name}}' preenchendo as informações abaixo:</h5>


    <form action="{{route('usuario.update', ['id' => $user->id])}}" method="post" id="editarUser">
      @csrf
      @method('put')
      <div class="form-group" id="form-group">

        <label for="name">CPF do Usuário</label>
        <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Digite o CPF do usuário"
        value="{{$user->cpf}}"
        >

        <label for="name">Nome do Usuário</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Digite o nome do usuário"
        value="{{$user->name}}">

        <label for="name">E-mail do Usuário</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Digite o e-mail do usuário"
        value="{{$user->email}}">
   
        <label for="name">Nova Senha do Usuário</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Digite a senha do usuário">

        <hr>
        <label for="departamento">Selecione um Departamento para o Usuário: </label>
        <select name="departamento">
          @foreach ($departamentos as $dep)
              @if($dep->id == $user->departamento_id)
                <option value="{{$dep->id}}" selected>{{$dep->nome}}</option>
              @else
                <option value="{{$dep->id}}">{{$dep->nome}}</option>
              @endif
          @endforeach
        </select>
        <br><br>
        <label for="cargo">Selecione um Cargo para o Usuário: </label>
        <select name="cargo">
          @if ($user->cargo == 'membro')
            <option value="membro" selected>Membro</option>
          @else
            <option value="admin" selected>Admin</option>
          @endif
        </select>
        <hr>
        <small id="emailHelp" class="form-text text-muted">Preencha os dados com cautela.</small>
      </div>
      <h3 id="saidaResult"></h3>
      <button type="submit" class="btn btn-primary">Atualizar</button>

    </form>
    
  </div>
</div>
@endsection

@section('ajax')
<script>
  var form = $("#editarUser");

  //quando submeterem o form
  form.submit(function(event) {
      event.preventDefault(); //cancelar evento padrão
      ajax(); //realizar a validação
  });

//função para ajax
  function ajax(){
      //Dados da requisição
      data = form.serialize();
      url = form.attr('action');
      
      $.ajax({         
          type: "POST",
          url: url,
          data: data,
          dataType: 'json',
          success: function(dados) {
              console.log(data);
              requisicaoFinalizada(dados)
          },
          error: function(dados) {
              console.log(data);
              console.log(dados);
              requisicaoFinalizada(dados);
          }
      });
  }

//criando elemento de saída
  function requisicaoFinalizada(dados){
      let local = document.getElementById('form-group');
      let h3 = document.getElementById('saidaResult');
      if(h3){
          h3.textContent = dados['msg'];
      }else{
          h3 = document.createElement('h3');
          h3.textContent = dados['msg'];
          h3.setAttribute('id', 'saidaResult')
          local.appendChild(h3);
      }

      if(dados['msg'] == 'O departamento foi atualizado com sucesso!'){
        setTimeout(() => {
          window.alert('Iremos atualizar a página com as novas informações');
        }, 1000);
        setTimeout(() => {document.location.reload(true);}, 4000);
      }

  }
</script>
@endsection