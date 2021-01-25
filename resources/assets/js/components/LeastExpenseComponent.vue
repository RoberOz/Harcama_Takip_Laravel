<template>
  <div class="col">
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
      }
    }
  }
</script>
