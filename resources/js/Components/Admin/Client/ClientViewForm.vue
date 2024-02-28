<template>
<form @submit.prevent="submitForm">
    <table class="input_form">

        <tr>
    <td ><label >Select Location</label></td>
    <td ><select id="location" v-model="client.selectedLocation" name="location">
    <option value="">Select Location</option>
    <option v-for="item in clientLocation" :key='item.location' :value="item.location">{{ item.location }}</option>

    </select><span v-if="errors.selectedLocation" class="error">{{errors.selectedLocation[0]}}</span></td>
    </tr>


    <tr>
    <td ><label >Sub Location</label></td>
    <td ><input type="text" v-model="client.selectedSubLocation" placeholder="Sub Location">

        <span v-if="errors.selectedSubLocation" class="error">{{errors.selectedSubLocation[0]}}</span></td>
    </tr>

    <tr>
        <td></td>
       <td>
        <button  class="submit_btn">Submit</button> </td>
    </tr>
</table>
</form>

<div v-if="results">
                    <responsive-table :results="results" :columns="columns">


                      <!-- <template #edit="{ row }">
                        <Link

                          >Edit</Link
                        >
                      </template> -->
                    </responsive-table>
                  </div>

</template>

<script>
import ResponsiveTable from '../../Shared Folder/ResponsiveTable.vue'

import Swal from 'sweetalert2'

export default {
    name:'ClientViewForm',

    components:{
      ResponsiveTable
    },

    data()
        {
            return{
                client: {

                    selectedSubLocation:"",
                    selectedLocation:"",

                },
                clientLocation:[],
                userLocation:[],
                errors:{},
                results:[],

                columns: [
  { label: 'Client Name', key: 'client_name' },
  { label: 'Business Unit Name', key: 'business_unit_name' },
  { label: 'Sub Location', key: 'sub_location' },
  { label: 'Select Location', key: 'location' },
  { label: 'Account Manager', key: 'account_manager' },

  { label: 'Edit', key: 'edit' },


  // ... etc. for other columns
],
            };
        },


        methods: {

userLocationApi()
{
axios
.get('/api/adminclient-view')
.then(response => {
this.clientLocation = response.data.locations

console.log(this.loginData)
})
.catch(error => {
console.log(error)
this.errored = true
})

},


submitForm() {
    this.submitted = true; // Set the submitted flag to true when attempting to submit the form
    // if (this.isFormValid) {

        axios.post('/api/adminclient-view', this.client)
  .then(response => {
      console.log('Form submitted:', response.data.results);
      this.results = response.data.results;
      if(response.data.results){
        this.errors={};

         Swal.fire({
            position: "top-center",
            icon: "success",
            // title: "Login successfully",
            showConfirmButton: false,
            timer: 3000
            });

      }
      else{
        Swal.fire("Form not Submitted");
      }

      // Handle the response as needed
   })
  .catch(error => {
    //   console.error('Error submitting form:', error.response.data.errors);
      this.errors= error.response.data.errors;
   });
},
},
mounted(){
this.userLocationApi()

}

}

</script>

