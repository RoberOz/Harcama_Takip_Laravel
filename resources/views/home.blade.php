<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Harcama Takip</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    </head>
    <body>
      <div id="app">

        <expense-create
          :categories="{{$categories}}"
        ></expense-create>

        <div class="container">
          <div class="row">
            <div class="col-sm">
              <most-expense
              ></most-expense>
            </div>
            <div class="col-sm">
              <recent-expense
              ></recent-expense>
            </div>
            <div class="col-sm">
              <least-expense
              ></least-expense>
            </div>
          </div>
        </div>

        <list-data
          :years="{{json_encode($years)}}"
        ></list-data>

        <div class="container">
          <div class="row">
            <div class="col-sm">
              <expense-location-counts
                :years="{{json_encode($years)}}"
              ></expense-location-counts>
            </div>
            <div class="col-sm">
              <current-month-expenses
              ></current-month-expenses>
            </div>
          </div>
        </div>

        <category-locations
          :categories="{{$categories}}"
        ></category-locations>

        <div>
          <expense-pages
          ></expense-pages>
        </div>

      </div>


    <script src="{{asset('js/app.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    </body>
</html>
