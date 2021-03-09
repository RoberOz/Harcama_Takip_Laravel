<template>
  <div class="col" @updateComponents="update">
    <div class="panel panel-default">
      <div class="panel-body">
        <strong><p align="center">Yıllık Harcamalar</p></strong>
          <div class="container">
            <div class="row">
              <div v-for="year in years" class="col-3 col-sm-3">
                <div style="width:285px" align="center"><strong>{{year.value}}</strong>
                  <br>
                  <strong>
                    Senelik Toplam Harcama:
                    <div v-for="totalExpenseYear in totalExpenseYearly.data">
                      <div v-if="totalExpenseYear.year == year.value">
                        {{totalExpenseYear.totalExpense}}
                      </div>
                    </div>
                  </strong>
                  <br>
                  <br>
                  <div v-for="expenseListYear in expenseListYearly.data">
                    <div v-if="expenseListYear.year == year.value">
                      Ay:
                        {{selectMonthName(expenseListYear.month)}}<br>
                      Toplam harcama miktar:
                        {{expenseListYear.totalExpense}}<br>
                      Toplam harcama sayısı:
                        {{expenseListYear.times}}<br>
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
import axios from 'axios';

  export default {
    props:[
      'years'
    ],
    created() {
      this.$eventBus.$on('updateComponents', this.update);
    },
    data() {
      return {
        totalExpenseYearly:"",
        expenseListYearly:""
      }
    },
    mounted(){
       this.loadTotalExpenseYearly();
       this.loadExpenseListYearly();
    },
    methods:{
      loadTotalExpenseYearly(){
        axios.get('/api/v1/expenses/total-expense-yearly')
             .then((response) => {
               this.totalExpenseYearly = response.data;
             })
             .catch((error) => {
               console.log('Error: ', error);
             });
      },
      loadExpenseListYearly(){
        axios.get('/api/v1/expenses/expense-list-yearly')
             .then((response) => {
               this.expenseListYearly = response.data;
             })
             .catch((error) => {
               console.log('Error: ', error);
             });
      },
      update(){
        setTimeout(() => {
          this.loadExpenseListYearly();
          this.loadTotalExpenseYearly();
        }, 2000);
      },
      selectMonthName(data){
        var months = [ "","Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran",
           "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık" ];
        return months[data];
      },
    }
  }
</script>
