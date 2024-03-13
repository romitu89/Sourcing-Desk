<template>
    <form @submit.prevent="submitForm">
     <table class="input_form">
      
        <tr>
     <td ><label >Select Location</label></td>

     <td ><select id="location" v-model="TlTracker.selectedLocation" name="location">
     <option value="">Select Location</option>
     <option v-for="item in getUniqueValues(userLocation,'location')" :key='item' :value="item">{{ item}} </option>

     </select><br><span v-if="errors.selectedLocation" class="error">{{errors.selectedLocation[0]}}</span></td>
     </tr>

        <tr>
     <td ><label >Client Name</label></td>
     <td ><select id="client" v-model="TlTracker.selectedClient" name="client">
     <option value="">Select Client</option>
     <option v-for="item in userLocation" :key='item.client_name' :value="item.client_name">{{ item.client_name }}</option>

     </select><br><span v-if="errors.selectedClient" class="error">{{errors.selectedClient[0]}}</span></td>
     </tr>

     <tr>
     <td ><label >Buisness Unit</label></td>
     <td ><select id="buisness" v-model="TlTracker.selectedBusiness" name="buisness">
     <option value="">Select Unit</option>
     <option v-for="item in userLocation" :key='item.business_unit' :value="item.business_unit">{{ item.business_unit }}</option>

     </select><br><span v-if="errors.selectedBusiness" class="error">{{errors.selectedBusiness[0]}}</span></td>
     </tr>

     <tr>
     <td ><label >Client Manager Name</label></td>
     <td ><select id="buisness" v-model="TlTracker.selectedManager" name="buisness">
     <option value="">Select Manager</option>
     <option v-for="item in userLocation" :key='item.client_manager_name' :value="item.client_manager_name">{{ item.client_manager_name }}</option>

     </select><br><span v-if="errors.selectedManager" class="error">{{errors.selectedManager[0]}}</span></td>
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
import { commonFunctionsMixin } from '../../../function.js';
import ResponsiveTable from '../../Shared Folder/ResponsiveTable.vue'

    export default {
        name:'TlTrackerView',

        mixins:[commonFunctionsMixin],

        components:{
      ResponsiveTable,
    },

        data()
        {
            return{
                TlTracker:{
                selectedLocation:"",
                selectedClient:"",
                selectedBusiness:"",
                selectedManager:"",
                },
                userLocation:[],
                errors:[],
                results:[],
                columns: [
                    { label: 'Client Name', key: 'client_name' },
                    { label: 'Client Manager Name', key: 'client_manager_name' },
                    { label: 'Business Unit Name', key: 'business_unit' },
                    { label: 'Select Location', key: 'location' },
                    { label: 'Edit', key: 'edit' }


  // ... etc. for other columns
],
            };
        },

        methods: {

userLocationApi()
{
axios
.get('/api/tltracker-view')
.then(response => {
this.userLocation = response.data.client
console.log(this.userLocation)
})
.catch(error => {
console.log(error)
this.errored = true
})

},


submitForm() {
this.submitted = true; // Set the submitted flag to true when attempting to submit the form
// if (this.isFormValid) {

    axios.post('/api/tltracker-view', this.TlTracker)
.then(response => {
  console.log('Form submitted:', response.data.results);
  this.results = response.data.results;
  console.log(this.results,"results")

  this.errors={};


  // Handle the response as needed
})
.catch(error => {
  console.error('Error submitting form:', error.response.data.errors);
  this.errors= error.response.data.errors;
  console.log(this.errors, "error")
});
},
},

mounted(){
this.userLocationApi()

},

    }
</script>
