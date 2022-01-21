@extends('layouts.dashboard')

@section('conteudo')
<div class="card">
  <div class="card-header">
    Olá, {{Auth::user()->name}}
  </div>
  <div class="card-body">
    <h5 class="card-title">Você está em seu painel!</h5>
    <p class="card-text">O sistema identificou que seu nível de usuário é {{Auth::user()->cargo}}.</p>
    <p class="card-text">Você pode verificar as opções disponíveis no painel pelo menu ao lado.</p>
    
  </div>
</div>

@endsection