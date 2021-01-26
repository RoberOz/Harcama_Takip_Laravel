<template>
  <div>
    <form v-on:submit.prevent="submitForm">
      <table align="center">
        <tr height="35">
          <td align="right" width = "140" ><label>Harcanan Miktar: </label></td>
          <td ><input type="text" name="amount" v-model="fields.amount" required></input></td>
        </tr>
        <tr height="35">
          <td align="right"><label>Harcanan Yer: </label></td>
          <td ><input type="text" name="location" v-model="fields.location" required></input></td>
        </tr>
        <tr height="35">
          <td align="right"><label>Bir Kategori Seçin: </label></td>
          <td >
            <select name="category_id" v-model="fields.category_id">
              <option value="" required>Seçim Yapınız</option>
              <option v-for="category in categories"
                      :value="category.id">{{category.name}}
              </option>
            </select>
          </td>
        </tr>
        <tr height="35">
          <td align="right" ><label>Tarih: </label></td>
          <td >
            <input type="date" name="date" min="2018-01-01" v-model="fields.date" required></input>
          </td>
        </tr>
        <tr height="35">
          <td  align="center" colspan="2"><button type="submit" @click="updateComponents()">Oluştur</button></td>
        </tr>
      </table>
    </form>
  </div>
</template>


<script>
import axios from "axios";
import Swal from 'sweetalert2';
Vue.prototype.$eventBus = new Vue();

  export default {
    props: [
      'categories'
    ],
    data() {
      return {
        fields: {
          amount:'',
          location:'',
          category_id:'',
          date:'',
        },
      }
    },
    methods:{
      submitForm(){
        axios.post('/api/store',this.fields)
             .then((response) => {
               this.fields = {};
               Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Your work has been saved',
                showConfirmButton: false,
                timer: 1500,
              });
             })
             .catch((error) => {
               console.log('Error');
             });
      },
      updateComponents(){
        this.$eventBus.$emit('updateComponents');
      }
    }
  }
</script>
