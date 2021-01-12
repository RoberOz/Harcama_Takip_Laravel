<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Harcama Takip</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">


        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>



      <div style="background-color:lightblue">
          @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
          @endforeach
      </div>

      <form method="post" action="{{url('/process')}}">
        <table align="center">
          {{ csrf_field() }}
          <tr height="35">
            <td align="right" width = "140"><label>Harcanan Miktar: </label></td>
            <td ><input type="text" name="amount" value="{{old('amount')}}" required></input></td>
          </tr>
          <tr height="35">
            <td align="right"><label>Harcanan Yer: </label></td>
            <td ><input type="text" name="location" value="{{old('location')}}" required></input></td>
          </tr>
          <tr height="35">
            <td align="right"><label>Bir Kategori Seçin: </label></td>
            <td >
              <select name="category_id">
                <option value="" required>Seçim Yapınız</option>
                @foreach ($categories as $category)
                  <option value="{{$category->id}}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                @endforeach
              </select>
            </td>
          </tr>
          <tr height="35">
            <td align="right"><label>Tarih: </label></td>
            <td >
              <input type="date" name="date" value="{{old('date')}}" min="2020-01-01" required></input>
            </td>
          </tr>
          <tr height="35">
            <td  align="center" colspan="2"><button type="submit">Oluştur</button></td>
          </tr>
        </table>
      </form>

<br>
<br>
@if($mostExpense)
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-md-offset-0">
        <div class="panel panel-default">
          <div class="panel-body"><strong><p align="center">En çok harcama yapılan ay</p></strong></div>
            <div align="center">
              <label>Ay: </label>
                {{Carbon\Carbon::createFromFormat('m',$mostExpense->expenseMonth)->formatLocalized('%B')}}<br>
              <label>Miktar: </label>
                {{$mostExpense->totalExpense}}
            </div>
        </div>
      </div>
    </div>
  </div>
@endif

<br>
@if($leastExpense)
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-md-offset-0">
        <div class="panel panel-default">
          <div class="panel-body"><strong><p align="center">En az harcama yapılan ay</p></strong></div>
            <div align="center">
                <label>Ay: </label>
                  {{Carbon\Carbon::createFromFormat('m',$leastExpense->expenseMonth)->formatLocalized('%B')}}<br>
                <label>Miktar: </label>
                  {{$leastExpense->totalExpense}}
            </div>
        </div>
      </div>
    </div>
  </div>
@endif
<br>
@if($recentExpens)
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-md-offset-0">
        <div class="panel panel-default">
          <div class="panel-body"><strong><p align="center">Son yapılan harcama</p></strong></div>
            <div align="center">
                <label>Miktar: </label>
                  {{$recentExpens->amount}}<br>
                <label>Yer: </label>
                  {{$recentExpens->location}}<br>
                <label>Kategori: </label>
                  {{$recentExpens->category->name}}<br>
                <label>Tarih: </label>
                  {{$recentExpens->date}}
            </div>
        </div>
      </div>
    </div>
  </div>
@endif

<br>

    <div class="container">
      <div class="row">
        <div class="col-md-12 col-md-offset-0">
          <div class="panel panel-default">
            <div class="panel-body"><strong><p align="center">Bu ay yapılan harcamalar</p></strong></div>
              <table width=100%>
                <tr height="10">
                  <td align="center"><strong>-Miktar-</strong></td>
                  <td align="center"><strong>-Yer-</strong></td>
                  <td align="center"><strong>-Kategori-</strong></td>
                  <td align="center"><strong>-Tarih-</strong></td>
                </tr>
                  @foreach ($currentMonthExpenses as $currentMonthExpens)
                    <tr height="50">
                      <td align="center">{{$currentMonthExpens->amount}}</td>
                      <td align="center">{{$currentMonthExpens->location}}</td>
                      <td align="center">
                        {{$currentMonthExpens->category->name}}
                      </td>
                      <td align="center"height = 35>{{$currentMonthExpens->date}}</td>
                    </tr>
                  @endforeach
              </table>
          </div>
        </div>
      </div>
    </div>

<br>

    <div class="container">
      <div class="row">
        <div class="col-md-12 col-md-offset-0">
          <div class="panel panel-default">
            <div class="panel-body"><strong><p align="center">Tüm Harcamalar</p></strong></div>
              <table width=100%>
                <tr height="10">
                  <td align="center"><strong>-Miktar-</strong></td>
                  <td align="center"><strong>-Yer-</strong></td>
                  <td align="center"><strong>-Kategori-</strong></td>
                  <td align="center"><strong>-Tarih-</strong></td>
                </tr>
                @foreach ($expenses as $expense)
                  <tr height="50">
                    <td align="center">{{$expense->amount}}</td>
                    <td align="center">{{$expense->location}}</td>
                    <td align="center">
                      {{$expense->category->name}}
                    </td>
                    <td align="center"height = 35>{{$expense->date}}</td>
                  </tr>
                @endforeach
              </table>
                <div align='center'>{{$expenses->links()}}</div>
          </div>
        </div>
      </div>
    </div>
    </body>
</html>
