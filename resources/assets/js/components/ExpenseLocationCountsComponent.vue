<template>
  <div class="col" style="width:530px" @updateComponents="update">
    <div class="panel panel-default">
      <div class="panel-body">
        <strong><p align="center">Harcama Yerleri Tekrarı</p></strong>
          <div class="container">
            <div class="row" style="width: 475px;">
              <div v-for="year in years" class="col-3 col-sm-3">
                <div style="width:105px" align="center"><strong>{{year.value}}</strong>
                  <br>
                  <div v-for="expenseLocationCount in expenseLocationCounts.data">
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
    created() {
      this.$eventBus.$on('updateComponents', this.update);
    },
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
        axios.get('/api/v1/expenses/expense-location-counts')
             .then((response) => {
               this.expenseLocationCounts = response.data;
             })
             .catch((error) => {
               console.log('Error: ', error);
             });
      },
      update(){
        setTimeout(() => {
          this.loadExpenseLocationCounts();
        }, 2000);
      },
    }
  }
</script>
