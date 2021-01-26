<template>
  <div class="col" @updateComponents="update">
    <div align="center">
      <div class="panel panel-default">
        <div class="panel-body">
          <strong><p align="center">En az harcama yapılan ay</p></strong>
            <div v-if="leastExpense">
              <label>Ay: </label>
                {{leastExpense.expenseMonth}}<br>
              <label>Miktar: </label>
                {{leastExpense.totalExpense}}
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
        leastExpense:[]
      }
    },
    mounted(){
       this.loadLeastExpense();
    },
    methods:{
      loadLeastExpense(){
        axios.get('/api/least-expense')
             .then((response) => {
               this.leastExpense = response.data;
             })
             .catch((error) => {
               console.log('Error: ', error);
             });
      },
      update(){
        setTimeout(() => {
          this.loadLeastExpense();
        }, 2000);
      },
    }
  }
</script>
