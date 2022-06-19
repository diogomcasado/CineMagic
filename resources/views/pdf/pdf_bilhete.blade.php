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
                Bilhete id: #<br />
                <br />
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
                <br />
               
              </td>
            </tr>
          </table>
        </td>
      </tr>

      <tr class="heading">
        <td>Payment Method</td>

        <td>##</td>
      </tr>
      <tr class="heading">
        <td>Filme</td>

        <td>##</td>
      </tr>
      <tr class="heading">
        <td>Sala</td>

        <td>##</td>
      </tr>
      <tr class="heading">
        <td>Data</td>

        <td>##</td>
      </tr>
      <tr class="heading">
        <td>Hora</td>

        <td>##</td>
      </tr>
      <tr class="heading">
        <td>Lugar</td>

        <td>##</td>
      </tr>
    </table>
    <div>
        <title>Testing QR code</title>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script type="text/javascript">
            function generateBarCode()
            {
                var nric = $('#text').val();
                var url = 'https://api.qrserver.com/v1/create-qr-code/?data=' + nric + '&amp;size=50x50';
                $('#barcode').attr('src', url);
            }
        </script>
    </head>
    <body>
        
      <img id='barcode' 
            src="https://api.qrserver.com/v1/create-qr-code/?data=HelloWorld&amp;size=100x100" 
            alt="" 
            title="HELLO" 
            width="50" 
            height="50" />
          </div>
  </div>
</body>

</html>