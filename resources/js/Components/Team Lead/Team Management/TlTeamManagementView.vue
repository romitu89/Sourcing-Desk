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
    <template #edit="{ row }">
      <div>
        <button title="Edit" @click="editItem(row.id)">
          <font-awesome-icon :icon="['fas', 'pen-to-square']" />
        </button>
        <button title="Delete" @click="deleteItem(row.id)">
          <font-awesome-icon :icon="['fas', 'trash']" />
        </button>
      </div>
    </template>
  </responsive-table>
                </div>

</template>

<script>
import { commonFunctionsMixin } from '../../../function.js';
import axios from 'axios';
import ResponsiveTable from '../../Shared Folder/ResponsiveTable.vue'

  export default {
      name:'TlTeamManagementView',
      mixins:[commonFunctionsMixin],
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
      { label: "Edit", key: "edit" },

      // ... etc. for other columns
    ],
    empNameProp:this.empName
  };
},
props:{
  empName:{
    type: String,
    default: "",
  },
},
watch:{
empName(newVal){
  this.empNameProp = newVal
  }
},
methods: {
  closePopup() {
    this.$emit("closePopup");
  },

  editItem(id) {
    this.$emit("updateForm", id);
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
clearMessage(){
    this.empNameProp = ""

  },
  showSucess(){
    if(this.empNameProp!=""){
    Swal.fire({
            position: "top-center",
            icon: "success",
            title: "User "+this.empNameProp+" edited successfully",
            showConfirmButton: false,
            timer: 3000,
          });

  }
  },
},
mounted(){
this.userLocationApi()
this.showSucess();
 this.clearMessage();

},

  }
</script>
