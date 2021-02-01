@extends('layouts.app')

@section('content')
<div class="panel-body">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
</div>

<div>
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

  <expense-list-yearly
    :years="{{json_encode($years)}}"
  ></expense-list-yearly>

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

  <categories-group-by-location
    :categories="{{$categories}}"
  ></categories-group-by-location>

  <expense-pages
  ></expense-pages>
</div>


@endsection
