<template>
  <div class="col" style="width:530px">
    <div class="panel panel-default">
      <div class="panel-body">
        <strong><p align="center">Harcama Yerleri Tekrarı</p></strong>
          <div class="container">
            <div class="row" style="width: 475px;">
              <div v-for="year in years">
                <div class="col-15 col-sm-15" style="width:105px" align="center"><strong>{{year.value}}</strong>
                  <br>
                  <div v-for="expenseLocationCount in expenseLocationCounts">
                    <div v-if="expenseLocationCount.year == year.value">
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
  export default {
    props: [
      'years'
    ],
    data() {
      return {
        expenseLocationCounts:[]
      }
    },
    mounted(){
       this.loadExpenseLocationCounts();
    },
    methods:{
      loadExpenseLocationCounts(){
        axios.get('/api/expense-location-counts')
             .then((response) => {
               this.expenseLocationCounts = response.data;
             })
             .catch((error) => {
               console.log('Error: ', error);
             });
      }
    }
  }
</script>
