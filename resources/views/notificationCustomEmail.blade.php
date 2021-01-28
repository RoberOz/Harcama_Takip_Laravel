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
    <div>
      <table>
        <tr>
          <td>Yeni harcama oluşturuldu</td>
        </tr>
        <tr>
          <td>Harcama Miktarı: {{$expense->amount}}</td>
        <tr>
        </tr>
          <td>Harcama Yeri: {{$expense->location}}</td>
        <tr>
        <tr>
          <td>Harcama Tarihi: {{$expense->date}}</td>
        </tr>
        <tr>
          <td><a href="http://localhost:8000/">Siteye Git</a></td>
        </tr>
      </table>
    <div>
  </body>
</html>
