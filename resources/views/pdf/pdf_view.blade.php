<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />

  <link href="{{ asset('css/pdf.css') }}" rel="stylesheet">

</head>

<body>
  <div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
      <tr class="top">
        <td colspan="2">
          <table>
            <tr>
              <td class="title">
                <img src="https://getlogovector.com/wp-content/uploads/2020/12/malaysian-global-innovation-and-creativity-centre-magic-logo-vector.png" style="width: 100%; max-width: 300px" />
              </td>

              <td>
                Fatura #: {{$recibo->id}}<br />
                {{$recibo->data}}<br />
              </td>
            </tr>
          </table>
        </td>
      </tr>

      <tr class="information">
        <td colspan="2">
          <table>
            <tr>
              <td>
               CineMagic, Inc.<br />
               Leiria<br />
               
              </td>

              <td>
                {{$recibo->cliente->user->name}}<br />
                {{$recibo->cliente->user->email}}
              </td>
            </tr>
          </table>
        </td>
      </tr>

      <tr class="heading">
        <td>Payment Method</td>

        <td>##</td>
      </tr>

      <tr class="details">
        <td>{{$recibo->tipo_pagamento}}</td>

        <td>{{$recibo->preco_total}} €</td>
      </tr>

      <tr class="heading">
        <td>Item</td>

        <td>Price</td>
      </tr>
      @foreach($recibo->filmes as $filme)
      <tr class="item">
        <td>Filme: {{$filme->Titulo}}</td>

     
      </tr>
      @endforeach


      <tr class="total">
        <td></td>
        <td>Total: {{$recibo->preco_total_com_iva}} €</td>
      </tr>
    </table>
  </div>
</body>

</html>