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
  var moment = require('moment');
  export default {
    props: [
      'mostExpense'
    ],
  }
</script>
