<template>
  <div class="col-md-10 col-md-offset-1" align="center">
    <div class="panel panel-default">
      <div class="panel-body">
        <strong><p align="center">Kategorilere göre harcama yerleri</p></strong>
          <div class="container">
            <div class="row">
              <div v-for="category in categories">
                <div class="col-1 col-sm-3"><strong>-{{category.name}}-</strong>
                  <div v-for="categoryLocation in categoryLocations">
                    <div v-if="categoryLocation.category_id == category.id">
                      <br>
                      {{categoryLocation.location}}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    props: [
      'categoryLocations',
      'categories'
    ],
  }
</script>
