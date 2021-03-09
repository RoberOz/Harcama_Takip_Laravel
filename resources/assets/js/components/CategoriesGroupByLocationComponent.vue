<template>
  <div class="col-md-5 col-md-offset-1" align="center" @updateComponents="update">
    <div class="panel panel-default">
      <div class="panel-body">
        <strong><p align="center">Kategorilere göre harcama yerleri</p></strong>
          <div class="container" style="width: 510px">
            <div class="row">
              <div class="col-4 col-sm-4" v-for="category in categories">
                <div><strong>-{{category.name}}-</strong>
                  <div v-for="categoryGroupByLocation in categoriesGroupByLocation.data">
                    <div v-if="categoryGroupByLocation.category_id == category.id">
                      <br>
                      {{categoryGroupByLocation.location}}
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
import axios from 'axios'

  export default {
    props:[
      'categories'
    ],
    created() {
      this.$eventBus.$on('updateComponents', this.update);
    },
    data() {
      return {
        categoriesGroupByLocation:[]
      }
    },
    mounted(){
       this.loadCategoriesGroupByLocation();
    },
    methods:{
      loadCategoriesGroupByLocation(){
        axios.get('/api/v1/expenses/categories-group-by-location')
             .then((response) => {
               this.categoriesGroupByLocation = response.data;
             })
             .catch((error) => {
               console.log('Error: ', error);
             });
      },
      update(){
        setTimeout(() => {
          this.loadCategoriesGroupByLocation();
        }, 2000);
      },
    }
  }
</script>
