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
    <td ><label >Job Type</label></td>
    <td ><select id="role" v-model="tlTeamManagement.jobType" name="role">
    <option value="">Select Job</option>
    <option value="Admin">Admin</option>
    <option value="Team Lead">Team Lead</option>
    </select><br><span v-if="errors.jobType" class="error">{{errors.jobType[0]}}</span></td>
    </tr>

    <tr>
        <td><label>Select Team</label></td>
        <td>
          <!-- <multi-select :selectedTeam="employee.selectedTeam" :options="teams" @update:selected="updateSelectedOptions"></multi-select> -->

        </td>
      </tr>

      <tr>
         <td></td>
        <td> <button class="cancel_btn">Cancel</button>
         <button  class="submit_btn">Submit</button> </td>
     </tr>

     </table>

    </form>

 </template>

<script>
    export default {

        name:'TlTeamManagementCreate',

        data()
        {
            return{
                tlTeamManagement:{
                    selectedLocation:"",
                    jobType:"",
                },
                errors:{},
                userLocation: [],
            };
        },

        methods: {

userLocationApi()
{
axios
.get('/api/tlteam-create')
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

    axios.post('/api/tlteam-create', this.tlTeamManagement)
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
