<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Juan, and Bootstrap contributors">
    <title>{{config('app.name');}}</title>
    

    <!-- Bootstrap core CSS -->
    <link href="{{asset('css/assets/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    
    <!-- Custom styles for this template -->
    <link href="{{asset('css/dashboard.css')}}" rel="stylesheet">
  </head>
  <body>
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow"
style="background: linear-gradient(90deg, #040305, #261d26, #4a303f, #734352, #9d595f, #c47266, #e69169, #ffb56b);  "
>
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">J-Simple Intranet</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="{{route('user.dashboard')}}">
              <ion-icon name="home-outline"></ion-icon>              
              Dashboard
            </a>
          </li>

          @if(Auth::user()->cargo == "admin")
          <li class="nav-item">
            <a class="nav-link" href="{{route('departamento')}}">
              <ion-icon name="copy-outline"></ion-icon>
                Departamentos
            </a>
          </li> 
          
          <li class="nav-item">
            <a class="nav-link" href="{{route('usuario')}}">
              <ion-icon name="people-outline"></ion-icon>
                Usuários
            </a>
          </li> 
          @endif
          
          <li class="nav-item">
            <a class="nav-link" href="{{route('user.perfil')}}">
              <ion-icon name="construct-outline"></ion-icon>
                 Opções da sua conta
            </a>
          </li>

          <li class="nav-item">
            <form action="{{route('logout')}}" method="post">
            @csrf
            <a class="nav-link" type="submit">
              <span data-feather="users"></span>
              <button type="submit" style="border:none;"> Sair </button>
            </a>
          </form>
          </li>
        </ul>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      @yield('conteudo')
    </main>
  </div>
</div>


    <script src="{{asset('css/assets/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>  
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    @yield('ajax');
  </body>
</html>
