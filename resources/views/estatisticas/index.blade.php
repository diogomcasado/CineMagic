@extends('layouts.app')

@section('content')



<!-- Estilos customizados para este template -->
<link href="estatisticas.css" rel="stylesheet">


<body>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('estatisticas.index') }}" >
                                <span data-feather="users"></span>
                                Clientes <span class="sr-only">(atual)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('pagamentos.index') }}">
                                <span data-feather="shopping-cart"></span>
                               Pagamentos
                            </a>
                        </li>
                      

                    </ul>
                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
              


                <h2>Listagem de valor total gasto por Clientes</h2>
                <div  class="table-responsive">
                    <table id="tabela" class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Cliente_id </th>
                                <th>Valor total gasto</th>
                              
                            </tr>
                        </thead>

                        

                        <tbody>
                        @foreach($recibos as $rec)
                            <tr>
                                <td > 	{{$rec->cliente_id}}</td>
                                <td > 	{{$rec->sum}}</td>
                            </tr>
                         
                            @endforeach
                            
                        </tbody>
                    </table>
                 

                </div>
            </main>
        </div>
    </div>

   
   

    <!-- Ícones -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
    feather.replace()
    </script>

    
</body>


@endsection