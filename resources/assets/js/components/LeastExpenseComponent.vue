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
  export default {
    props: [
      'leastExpense'
    ],
  }
</script>
