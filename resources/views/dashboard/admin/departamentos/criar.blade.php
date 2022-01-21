@extends('layouts.dashboard')

@section('conteudo')
<div class="card">
  <div class="card-header">
    Bem-vindo ao gerenciamento de departamento!
  </div>
  <div class="card-body">
    <h5 class="card-title">Você pode criar um departamento preenchendo as informações abaixo:</h5>

    <form action="{{route('departamento.create')}}" method="post" id="criarDep">
      @csrf

      <div class="form-group" id="form-group">
        <label for="depnome">Nome do departamento</label>
        <input type="text" class="form-control" id="depnome" name="nome" placeholder="Digite o nome do departamento">
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
  var form = $("#criarDep");

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