<template>
  <div class="container" @updateComponents="update">
    <div class="row">
      <div class="col-md-12 col-md-offset-0">
        <div class="panel panel-default">
          <div class="panel-body"><strong><p align="center">Tüm Harcamalar</p></strong></div>
              <tr height="10">
                <td align="center" style="width: 150px"><strong>-Miktar-</strong></td>
                <td align="center" style="width: 150px"><strong>-Yer-</strong></td>
                <td align="center" style="width: 150px"><strong>-Kategori-</strong></td>
                <td align="center" style="width: 150px"><strong>-Tarih-</strong></td>
              </tr>
              <div v-for="expensePage in expensePages">
                <tr height="50">
                  <td align="center" style="width: 150px">{{expensePage.amount}}</td>
                  <td align="center" style="width: 150px">{{expensePage.location}}</td>
                  <td align="center" style="width: 150px">{{expensePage.category_name}}</td>
                  <td align="center" style="width: 150px">{{expensePage.date}}</td>
                </tr>
              </div>
              <div align='center'>links</div>
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
        expensePages:[],
      }
    },
    mounted(){
       this.loadExpensePages();
    },
    methods:{
      loadExpensePages(){
        axios.get('/api/expense-pages')
             .then((response) => {
               this.expensePages = response.data;
             })
             .catch((error) => {
               console.log('Error: ', error);
             });
      },
      update(){
        setTimeout(() => {
          this.loadExpensePages();
        }, 2000);
      },
    },
  }
</script>
