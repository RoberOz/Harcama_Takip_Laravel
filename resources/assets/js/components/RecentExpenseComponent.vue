<template>
  <div class="col">
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
  export default {
    props: [
      'recentExpense'
    ],
  }
</script>
