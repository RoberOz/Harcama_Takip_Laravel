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
                        {{selectMonthName(listData.month)}}<br>
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
        totalExpenseYearly:[],
        listDatas:[]
      }
    },
    mounted(){
       this.loadTotalExpenseYearly();
       this.loadListDatas();
    },
    methods:{
      loadTotalExpenseYearly(){
        axios.get('/api/total-expense-yearly')
             .then((response) => {
               this.totalExpenseYearly = response.data;
             })
             .catch((error) => {
               console.log('Error: ', error);
             });
      },
      loadListDatas(){
        axios.get('/api/list-datas')
             .then((response) => {
               this.listDatas = response.data;
             })
             .catch((error) => {
               console.log('Error: ', error);
             });
      },
      update(){
        setTimeout(() => {
          this.loadListDatas();
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
