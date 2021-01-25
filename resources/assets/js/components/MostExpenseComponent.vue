<template>
  <div class="col">
    <div align="center">
      <div class="panel panel-default">
        <div class="panel-body">
          <strong><p align="center">En çok harcama yapılan ay</p></strong>
            <div v-if="mostExpense">
              <label>Ay: </label>
                {{mostExpense.expenseMonth}}
                <br>
              <label>Miktar: </label>
                {{mostExpense.totalExpense}}
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
        mostExpense:[]
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
      }
    }
  }
</script>
