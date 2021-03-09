<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="csrf-token" content="{{ csrf_token() }}">

      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
  </head>

  <body>
    <div id="app">

      <div class="container">
        <div align="center">
          <div class="panel panel-default">
            <div class="panel-body">
              <table>
                <tr>
                  <strong style="font-family:Arial">Yeni harcama oluşturuldu</strong>
                </tr>
                <tr>
                  <td style="font-family:Arial">Harcama Miktarı: {{$expense->amount}}</td>
                <tr>
                </tr>
                  <td style="font-family:Arial">Harcama Yeri: {{$expense->location}}</td>
                <tr>
                <tr>
                  <td style="font-family:Arial">Harcama Tarihi: {{$expense->date}}</td>
                </tr>
                <tr>
                  <td  align="center" colspan="2"><a href="http://localhost:8000/">Siteye Git</a></td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>

    <div>
  </body>
</html>
