<template>
  <div class="container" style="width:530px">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-body"><strong><p align="center">Bu ay yapılan harcamalar</p></strong></div>
              <tr height="10">
                <td align="center" style="width:150px"><strong>-Miktar-</strong></td>
                <td align="center" style="width:150px"><strong>-Yer-</strong></td>
                <td align="center" style="width:150px"><strong>-Kategori-</strong></td>
                <td align="center" style="width:150px"><strong>-Tarih-</strong></td>
              </tr>
                <div v-for="currentMonthExpens in currentMonthExpenses">
                  <tr height="30">
                    <td align="center" style="width:150px">{{currentMonthExpens.amount}}</td>
                    <td align="center" style="width:150px">{{currentMonthExpens.location}}</td>
                    <td align="center" style="width:150px">{{currentMonthExpens.category.name}}</td>
                    <td align="center" style="width:150px">{{currentMonthExpens.date}}</td>
                  </tr>
                </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    props: [
      'currentMonthExpenses'
    ],
  }
</script>
