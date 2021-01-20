<template>
  <div class="col-md-5 col-md-offset-1">
    <div class="panel panel-default">
      <div class="panel-body">
        <strong><p align="center">Harcama Yerleri Tekrarı</p></strong>
          <div class="container">
            <div class="row">
              <div v-for="year in years">
                <div class="col-sm-2"><strong>{{format_date(year)}}</strong>
                  <br>
                  <div v-for="expenseLocationCount in expenseLocationCounts">
                    <div v-if="expenseLocationCount.year == format_date(year)">
                      {{(expenseLocationCount.location)}}
                      -
                      {{(expenseLocationCount.times)}}
                      <br>
                    </div>
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
      'expenseLocationCounts'
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
