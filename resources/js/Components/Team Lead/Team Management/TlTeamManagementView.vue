<template>
    <form @submit.prevent="submitForm">
     <table class="input_form">

        <tr>
     <td ><label >Select Location</label></td>
     <td ><select id="location" v-model="tlTeamManagement.selectedLocation" name="location">
     <option value="">Select Location</option>
     <option v-for="item in userLocation" :key='item.location' :value="item.location">{{ item.location }}</option>

     </select><br><span v-if="errors.selectedLocation" class="error">{{errors.selectedLocation[0]}}</span></td>
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

    export default {
        name:'TlTeamManagementView',

        components:{
      ResponsiveTable
    },

        data()
        {
            return{
                tlTeamManagement:{
                    selectedLocation:"",

                },
                errors:{},
                userLocation: [],
                results:[],
                columns: [
                    { label: 'Select Location', key: 'location' },
                    { label: 'Job Type', key: 'jobtype' },
          { label: 'Edit', key: 'edit' }


  // ... etc. for other columns
],
            };
        },

        methods: {

userLocationApi()
{
axios
.get('/api/tlteam-view')
.then(response => {
this.userLocation = response.data.locations
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

    axios.post('/api/tlteam-view', this.tlTeamManagement)
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
