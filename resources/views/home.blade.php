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
        
      </div>


<br>
<br>

<div class="container">
  <div class="row row-cols-3">

    <div class="col">
      <div align="center">
        <div class="panel panel-default">
          <div class="panel-body">
            <strong><p align="center">En çok harcama yapılan ay</strong></p>
            @if($mostExpense)
              <label>Ay: </label>
                {{Carbon\Carbon::createFromFormat('m',$mostExpense->expenseMonth)->formatLocalized('%B')}}<br>
              <label>Miktar: </label>
                {{$mostExpense->totalExpense}}
            @endif
          </div>
        </div>
      </div>
    </div>

    <div class="col">
      <div align="center">
        <div class="panel panel-default">
          <div class="panel-body">
            <strong><p align="center">Son yapılan harcama</strong></p>
            @if($recentExpens)
              <label>Miktar: </label>
                {{$recentExpens->amount}}<br>
              <label>Yer: </label>
                {{$recentExpens->location}}<br>
              <label>Kategori: </label>
                {{$recentExpens->category->name}}<br>
              <label>Tarih: </label>
                {{$recentExpens->date}}
            @endif
          </div>
        </div>
      </div>
    </div>

    <div class="col">
      <div align="center">
        <div class="panel panel-default">
          <div class="panel-body">
            <strong><p align="center">En az harcama yapılan ay</strong></p>
            @if($leastExpense)
              <label>Ay: </label>
                {{Carbon\Carbon::createFromFormat('m',$leastExpense->expenseMonth)->formatLocalized('%B')}}<br>
              <label>Miktar: </label>
                {{$leastExpense->totalExpense}}
            @endif
          </div>
        </div>
      </div>
    </div>

  </div>
</div>


  <div align="center">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-body">
          <strong><p align="center">Yıllık Harcamalar</strong></p>
            <div class="container">
              <div class="row">
                @foreach ($years as $year)
                  <div class="col-1 col-sm-3"><strong>{{$year->format("Y")}}</strong>
                    <br>
                    <strong>
                      Senelik Toplam Harcama:
                      @foreach ($totalExpenseYearly as $totalExpenseYear)
                        @if ($totalExpenseYear->year == $year->format("Y"))
                          {{$totalExpenseYear->totalExpense}}
                        @endif
                      @endforeach
                    </strong>
                    <br>
                    <br>
                    @foreach ($listDatas as $listData)
                      @if ($listData->year == $year->format("Y"))
                        Ay:
                          {{Carbon\Carbon::createFromFormat('m',$listData->month)->formatLocalized('%B')}}<br>
                        Toplam harcama miktar:
                          {{$listData->totalExpense}}<br>
                        Toplam harcama sayısı:
                          {{$listData->times}}<br>
                          <br>
                      @endif
                    @endforeach
                    <br>
                  </div>
                @endforeach
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>

<br>

  <div class="col-md-5 col-md-offset-1">
    <div class="panel panel-default">
      <div class="panel-body">
        <strong><p align="center">Harcama Yerleri Tekrarı</strong></p>
          <div class="container">
            <div class="row">
              @foreach ($years as $year)
                <div class="col-sm-2"><strong>{{$year->format("Y")}}</strong>
                  <br>
                  @foreach ($expenseLocationCounts as $expenseLocationCount)
                    @if ($expenseLocationCount->year == $year->format("Y"))
                      {{($expenseLocationCount->location)}}
                      -
                      {{($expenseLocationCount->times)}}
                      <br>
                    @endif
                  @endforeach
                </div>
              @endforeach
            </div>
          </div>
      </div>
    </div>
  </div>

<br>

    <div class="container">
      <div class="row">
        <div class="col-md-12 col-md-offset-2">
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

  <div class="col-md-10 col-md-offset-1" align="center">
    <div class="panel panel-default">
      <div class="panel-body">
        <strong><p align="center">Kategorilere göre harcama yerleri</strong></p>
          <div class="container">
            <div class="row">
              @foreach ($categories as $category)
                <div class="col-1 col-sm-3"><strong>-{{$category->name}}-</strong>
                  @foreach ($categoryLocations as $categoryLocation)
                    @if ($categoryLocation->category_id == $category->id)
                      <br>
                      {{($categoryLocation->location)}}
                    @endif
                  @endforeach
                </div>
              @endforeach
            </div>
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
                @foreach ($expensePages as $expensePage)
                  <tr height="50">
                    <td align="center">{{$expensePage->amount}}</td>
                    <td align="center">{{$expensePage->location}}</td>
                    <td align="center">
                      {{$expensePage->category->name}}
                    </td>
                    <td align="center"height = 35>{{$expensePage->date}}</td>
                  </tr>
                @endforeach
              </table>
                <div align='center'>{{$expensePages->links()}}</div>
          </div>
        </div>
      </div>
    </div>

    <script src="{{asset('js/app.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    </body>
</html>
