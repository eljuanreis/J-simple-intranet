<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Juan and Bootstrap contributors">
    <title>{{config('app.name');}}</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('css/assets/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    
    <!-- Custom styles for this template -->
    <link href="{{asset("css/assets/login.css")}}" rel="stylesheet">
  </head>

<body>

  <nav class="navbar navbar-expand-md navbar-dark bg-dark"
  style="background: linear-gradient(90deg, #040305, #261d26, #4a303f, #734352, #9d595f, #c47266, #e69169, #ffb56b);  "
  >
    <div class="container-fluid">
      <a class="navbar-brand" href="#">{{config('app.name');}}</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Início</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('user.dashboard')}}">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled">Sobre-nós</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

<div class="body text-center">     
<div class="form-signin">
  <form method="POST" action="{{ route('login') }}">
    @csrf
    <img class="mb-4" src="https://cdn.pixabay.com/photo/2019/09/04/11/48/men-4451373_960_720.png" alt="" height="200" style="padding: 20px; background: white; border-radius: 20px;">
    <hr>
    <h1 class="h3 mb-3 fw-normal text-dark">Por favor, <span class="destaque">logue-se</span></h1>
    <p>
      {{$errors->first()}}
    </p>
    <div class="form-floating">
      <input type="email" class="form-control" id="email" placeholder="name@example.com" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
      <label for="floatingInput">E-mail</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
      <label for="floatingPassword">Sua senha</label>
    </div>

    <button class="w-100 btn btn-lg destaqueBotao" type="submit">Entrar</button>
    <p class="mt-5 mb-3 text-light">&copy; 2021</p>
  </form>
</div>
</div>
<footer>
  <nav class="navbar navbar-dark"
  style="background: linear-gradient(90deg, #040305, #261d26, #4a303f, #734352, #9d595f, #c47266, #e69169, #ffb56b);  "
  >
    <span class="navbar-text" style="padding-left: 10px;">
      Desenvolvido por Juan Reis - Processo Seletivo
    </span>
  </nav>
</footer>
<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
