<template>
  <div class="col-md-5 col-md-offset-1" align="center">
    <div class="panel panel-default">
      <div class="panel-body">
        <strong><p align="center">Kategorilere göre harcama yerleri</p></strong>
          <div class="container" style="width: 510px">
            <div class="row">
              <div class="col-4 col-sm-4" v-for="category in categories">
                <div><strong>-{{category.name}}-</strong>
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
