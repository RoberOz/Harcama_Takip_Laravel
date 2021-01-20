<template>
  <div align="center">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-body">
          <strong><p align="center">Yıllık Harcamalar</p></strong>
            <div class="container">
              <div class="row">
                <div v-for="year in years">
                  <div class="col-1 col-sm-3"><strong>{{format_date(year)}}</strong>
                    <br>
                    <strong>
                      Senelik Toplam Harcama:
                      <div v-for="totalExpenseYear in totalExpenseYearly">
                        <div v-if="totalExpenseYear.year == format_date(year)">
                          {{$totalExpenseYear.totalExpense}}
                        </div>
                      </div>
                    </strong>
                    <br>
                    <br>
                    <div v-for="listData in listDatas">
                      <div v-if="listData.year == format_date(year)">
                        Ay:
                          {{listData.month}}<br>
                        Toplam harcama miktar:
                          {{$listData.totalExpense}}<br>
                        Toplam harcama sayısı:
                          {{$listData.times}}<br>
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
  </div>
</template>

<script>
  import moment from 'moment'
  export default {
    props: [
      'years',
      'totalExpenseYearly',
      'listDatas'
    ],
    methods: {
        format_date(value){
           if (value) {
             return moment(String(value)).format('YYYY')
            }
        },
     },
  }
</script>
