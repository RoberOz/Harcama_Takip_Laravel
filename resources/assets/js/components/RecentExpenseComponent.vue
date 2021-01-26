<template>
  <div class="col" @updateComponents="update">
    <div align="center">
      <div class="panel panel-default">
        <div class="panel-body">
          <strong><p align="center">Son yapılan harcama</p></strong>
            <div v-if="recentExpense">
              <label>Miktar: </label>
                {{recentExpense.amount}}<br>
              <label>Yer: </label>
                {{recentExpense.location}}<br>
              <label>Kategori: </label>
                {{recentExpense.category.name}}<br>
              <label>Tarih: </label>
                {{recentExpense.date}}
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
        recentExpense:""
      }
    },
    mounted(){
       this.loadRecentExpense();
    },
    methods:{
      loadRecentExpense(){
        axios.get('/api/recent-expense')
             .then((response) => {
               this.recentExpense = response.data;
             })
             .catch((error) => {
               console.log('Error: ', error);
             });
      },
      update(){
        setTimeout(() => {
          this.loadRecentExpense();
        }, 2000);
      },
    }
  }
</script>
