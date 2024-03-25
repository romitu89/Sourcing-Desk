<template>
    <form @submit.prevent="submitForm">
     <table class="input_form">

        <tr>
     <td ><label >Select Location</label></td>
     <td ><select id="location" v-model="teamManager.selectedLocation" name="location">
     <option value="">Select Location</option>
     <option v-for="item in userLocation" :key='item.location' :value="item.location">{{ item.location }}</option>

     </select><br><span v-if="errors.selectedLocation" class="error">{{errors.selectedLocation[0]}}</span></td>
     </tr>

     <tr>
    <td ><label >Job Type</label></td>
    <td ><select id="role" v-model="teamManager.jobType" name="role">
    <option value="">Select Job</option>
    <option value="permanent">Permanent</option>
    <option value="contract">Contract</option>
    <option value="both">Both</option>
    </select><br><span v-if="errors.jobType" class="error">{{errors.jobType[0]}}</span></td>
    </tr>

    <tr>
        <td><label>Select Team</label></td>
        <td>
          <multi-select :selectedTeam="selectedTeam" :options="teams" @update:selected="updateSelectedOptions"></multi-select>
        </td>
      </tr>
      <tr>
        <td></td>
       <td> <button @click="closePopup()" class="cancel_btn">Cancel</button>
        <button class="submit_btn">Submit</button> </td>
    </tr>

     </table>

    </form>

 </template>

<script>

import MultiSelect from '../../Shared Folder/MultiSelect.vue';

    export default {

        name:'AmTeamManagementCreate',

        components: {
            MultiSelect,
  },

  data() {
    return {
      teamManager:{
      selectedLocation:'',
      jobType:'',
      selectedTeam:'',
      },
      errors:{},
      userLocation: [],
      teams: [],
      selectedTeam: [],
    };
  },
  methods: {
    closePopup() {
      this.$emit("closePopup");
    },

userLocationApi()
{
axios
.get('/api/amteam-create')
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

    axios.post('/api/amteam-create', this.teamManager)
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
