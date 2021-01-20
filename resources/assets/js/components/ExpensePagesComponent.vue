<template>
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
              <div v-for="expensePage in expensePages">
                <tr height="50">
                  <td align="center">{{expensePage.amount}}</td>
                  <td align="center">{{expensePage.location}}</td>
                  <td align="center">{{expensePage.category.name}}</td>
                  <td align="center"height = 35>{{expensePage.date}}</td>
                </tr>
              </div>
            </table>
              <div align='center'>{{expensePages.links()}}</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    props: [
      'expensePages',
    ],
  }
</script>
