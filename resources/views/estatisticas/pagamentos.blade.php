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
                                Clientes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('pagamentos.index') }}">
                                <span data-feather="shopping-cart"></span>
                                Pagamentos <span class="sr-only">(atual)</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
              


                <h2>Pagamentos mais utilizados</h2>
                <div  class="table-responsive">
                    <table id="tabela" class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Tipo de pagamento </th>
                                <th>Numero de utilizações</th>
                              
                            </tr>
                        </thead>

                        

                        <tbody>
                    
                        @foreach($tpagamentos as $pag)
                            <tr>
                                <td > 	{{$pag->tipo_pagamento}}</td>
                                <td > 	{{$pag->total}}</td>
                            </tr>
                         
                            @endforeach
                         
                          
                        </tbody>
                    </table>

                </div>
            </main>
        </div>
    </div>

    <!-- Principal JavaScript do Bootstrap
    ================================================== -->
    <!-- Foi colocado no final para a página carregar mais rápido -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script>
    window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>

    <!-- Ícones -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
    feather.replace()
    </script>

    <!-- Gráficos -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script>
    var ctx = document.getElementById("myChart");
    var data1 = document.getElementById("tabela").value;
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                data: data1,
                lineTension: 0,
                backgroundColor: 'transparent',
                borderColor: '#007bff',
                borderWidth: 4,
                pointBackgroundColor: '#007bff'
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            legend: {
                display: false,
            }
        }
    });
    </script>
</body>
@endsection