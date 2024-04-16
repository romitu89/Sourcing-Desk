<template>
    <form @submit.prevent="submitForm">
     <table class="input_form">

        <tr>
     <td ><label >Select Location</label></td>
     <td ><select id="location" v-model="teamManager.selectedLocation" @blur="checkValidation('selectedLocation')" name="location">
     <option value="">Select Location</option>
     <option v-for="item in userLocation" :key='item.location' :value="item.location">{{ item.location }}</option>

     </select><br><span v-if="errors.selectedLocation" class="error">{{errors.selectedLocation[0]}}</span></td>
     </tr>

     <tr>
        <td></td>
       <td> <button @click="closePopup()" class="cancel_btn">Cancel</button>
        <button class="submit_btn">Submit</button> </td>
    </tr>

     </table>

    </form>

    <div v-if="results">
                    <responsive-table :results="results" :columns="columns" :buttonAction="buttonAction">


                      <!-- <template #edit="{ row }">
                        <Link

                          >Edit</Link
                        >
                      </template> -->
                    </responsive-table>
                  </div>

 </template>

<script>
import axios from 'axios';
import ResponsiveTable from '../../Shared Folder/ResponsiveTable.vue'

    export default {
        name:'AmTeamManagementView',
        components:{
      ResponsiveTable,
      },

        data() {
    return {
        buttonAction: false,
      teamManager:{
      selectedLocation:'',

      },
      errors:{},
      userLocation: [],
      results: [],
      columns: [
        { label: "Location", key: "location" },
        { label: "Job Type", key: "job_type" },
        { label: "Team Members", key: "team_members" },

        // ... etc. for other columns
      ],

    };
  },
  methods: {
    closePopup() {
      this.$emit("closePopup");
    },
    checkValidation(fieldName) {
      let dataError = Object.values(this.errors);
      if (dataError.length > 1) {
        this.submitForm();
      } else {
        if (this.errors.hasOwnProperty(fieldName)) {
          delete this.errors[fieldName];
        }
      }
    },

userLocationApi()
{
axios
.get('/api/amteam-view')
.then(response => {
this.userLocation = response.data.teamData
console.log(this.userLocation,"response.data.teamData" )
})
.catch(error => {
console.log(error)
this.errored = true
})

},


submitForm() {
this.submitted = true; // Set the submitted flag to true when attempting to submit the form
// if (this.isFormValid) {

    axios.post('/api/amteam-view', this.teamManager)
.then((response) => {
  this.errors={};
  if (Object.values(this.errors).length == 0) {
            this.buttonAction = true;
          }
          this.results = response.data.results;

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
