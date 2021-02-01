<template>
  <div class="col" @updateComponents="update">
    <div align="center">
      <div class="panel panel-default">
        <div class="panel-body">
          <strong><p align="center">En çok harcama yapılan ay</p></strong>
            <div v-if="mostExpense">
              <label>Ay: </label>
                {{selectMonthName(mostExpense.data.expenseMonth)}}
                <br>
              <label>Miktar: </label>
                {{mostExpense.data.totalExpense}}
            </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

  export default {
    created() {
      this.$eventBus.$on('updateComponents', this.update);
    },
    data() {
      return {
        mostExpense:""
      }
    },
    mounted(){
       this.loadMostExpense();
    },
    methods:{
      loadMostExpense(){
        axios.get('/api/most-expense')
             .then((response) => {
               this.mostExpense = response.data;
             })
             .catch((error) => {
               console.log('Error: ', error);
             });
      },
      update(){
        setTimeout(() => {
          this.loadMostExpense();
        }, 2000);
      },
      selectMonthName(data){
        var months = [ "","Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran",
           "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık" ];
        return months[data];
      }
    }
  }
</script>
