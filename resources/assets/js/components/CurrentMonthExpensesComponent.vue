<template>
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
                <div v-for="currentMonthExpens in currentMonthExpenses">
                  <tr height="50">
                    <td align="center">{{currentMonthExpens.amount}}</td>
                    <td align="center">{{currentMonthExpens.location}}</td>
                    <td align="center">{{currentMonthExpens.category.name}}</td>
                    <td align="center"height = 35>{{currentMonthExpens.date}}</td>
                  </tr>
                </div>
            </table>
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
