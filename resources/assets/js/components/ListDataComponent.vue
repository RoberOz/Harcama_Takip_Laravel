<template>
  <div class="col">
    <div class="panel panel-default">
      <div class="panel-body">
        <strong><p align="center">Yıllık Harcamalar</p></strong>
          <div class="container">
            <div class="row">
              <div  v-for="year in years">
                <div class="col-15 col-sm-15" style="width:285px" align="center"><strong>{{year.value}}</strong>
                  <br>
                  <strong>
                    Senelik Toplam Harcama:
                    <div v-for="totalExpenseYear in totalExpenseYearly">
                      <div v-if="totalExpenseYear.year == year.value">
                        {{totalExpenseYear.totalExpense}}
                      </div>
                    </div>
                  </strong>
                  <br>
                  <br>
                  <div v-for="listData in listDatas">
                    <div v-if="listData.year == year.value">
                      Ay:
                        {{listData.month}}<br>
                      Toplam harcama miktar:
                        {{listData.totalExpense}}<br>
                      Toplam harcama sayısı:
                        {{listData.times}}<br>
                        <br>
                    </div>
                  </div>
                  <br>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    props: [
      'years',
      'totalExpenseYearly',
      'listDatas'
    ],
  }
</script>
