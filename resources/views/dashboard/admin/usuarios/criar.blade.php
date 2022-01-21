@extends('layouts.dashboard')

@section('conteudo')
<div class="card">
  <div class="card-header">
    Bem-vindo ao gerenciamento de usuário!
  </div>
  <div class="card-body">
    <h5 class="card-title">Você pode criar um usuário preenchendo as informações abaixo:</h5>

    <form action="{{route('usuario.create')}}" method="post" id="criarUser">
      @csrf

      <div class="form-group" id="form-group">

        <label for="name">CPF do Usuário</label>
        <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Digite o CPF do usuário">

        <label for="name">Nome do Usuário</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Digite o nome do usuário">

        <label for="name">E-mail do Usuário</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Digite o e-mail do usuário">
   
        <label for="name">Senha do Usuário</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Digite a senha do usuário">

        <label for="name">Confirmação de Senha do Usuário</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Digite novamente a senha do usuário">
        <hr>
        <label for="departamento">Selecione um Departamento para o Usuário: </label>
        <select name="departamento">
          @foreach ($departamentos as $dep)
              <option value="{{$dep->id}}">{{$dep->nome}}</option>
          @endforeach
        </select>
        <br><br>
        <label for="cargo">Selecione um Cargo para o Usuário: </label>
        <select name="cargo">
            <option value="membro" selected>Membro</option>
            <option value="admin">Admin</option>
        </select>
        <hr>
        <small id="emailHelp" class="form-text text-muted">Preencha os dados com cautela.</small>
      </div>
      <h3 id="saidaResult"></h3>
      <button type="submit" class="btn btn-primary">Cadastrar</button>

    </form>
    
  </div>
</div>
@endsection

@section('ajax')
<script>
  var form = $("#criarUser");

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
            console.log('erro');
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
  }
</script>
@endsection