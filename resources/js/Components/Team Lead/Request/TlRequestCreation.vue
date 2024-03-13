<template>
    <form @submit.prevent="submitForm">
     <table class="input_form">

        <tr>
    <td ><label >Subject Line</label></td>
    <td ><input type="text" v-model="TlRequest.subject" placeholder="Subject Line" >
        <span v-if="errors.subject" class="error">{{errors.subject[0]}}</span></td>
    </tr>

    <tr>
    <td ><label >Request Body</label></td>
    <td ><input type="text" v-model="TlRequest.requestBody" placeholder="Request Body" >
        <span v-if="errors.requestBody" class="error">{{errors.requestBody[0]}}</span></td>
    </tr>

        <tr>
    <td ><label >Requirement Name</label></td>
    <td ><input type="text" v-model="TlRequest.requirement" placeholder="Requirement Name" >
        <span v-if="errors.requirement" class="error">{{errors.requirement[0]}}</span></td>
    </tr>

        <tr>
    <td ><label >Job Type</label></td>
    <td ><select id="role" v-model="TlRequest.jobType" name="role">
    <option value="">Select Job</option>
    <option value="permanent">Permanent</option>
    <option value="contract">Contract</option>
    </select><br><span v-if="errors.jobType" class="error">{{errors.jobType[0]}}</span></td>
    </tr>

        <tr>
     <td ><label >Client Name</label></td>
     <td ><select id="client" v-model="TlRequest.selectedClient" name="client">
     <option value="">Select Client</option>
     <!-- <option v-for="item in userLocation" :key='item.location' :value="item.location">{{ item.location }}</option> -->

     </select><br><span v-if="errors.selectedClient" class="error">{{errors.selectedClient[0]}}</span></td>
     </tr>

     <tr>
     <td ><label >Buisness Unit</label></td>
     <td ><select id="buisness" v-model="TlRequest.selectedBusiness" name="buisness">
     <option value="">Select Unit</option>
     <!-- <option v-for="item in userLocation" :key='item.location' :value="item.location">{{ item.location }}</option> -->

     </select><br><span v-if="errors.selectedBusiness" class="error">{{errors.selectedBusiness[0]}}</span></td>
     </tr>

     <tr>
     <td ><label >Select Location</label></td>
     <td ><select id="location" v-model="TlRequest.selectedLocation"  name="location">
     <option value="">Select Location</option>
     <option v-for="item in userLocation" :key='item.location' :value="item.location">{{ item.location }}</option>

     </select><br><span v-if="errors.selectedLocation" class="error">{{errors.selectedLocation[0]}}</span></td>
     </tr>

     <tr>
     <td ><label >Client Manager Name</label></td>
     <td ><select id="buisness" v-model="TlRequest.clientManager" name="buisness">
     <option value="">Select Manager</option>
     <!-- <option v-for="item in userLocation" :key='item.location' :value="item.location">{{ item.location }}</option> -->

     </select><br><span v-if="errors.clientManager" class="error">{{errors.clientManager[0]}}</span></td>
     </tr>

     <tr>
        <td><label>Select Team</label></td>
        <td>
            <multi-select :selectedTeam="selectedTeam" :options="teams" @update:selected="updateSelectedOptions"></multi-select>

            <span v-if="errors.selectedTeam" class="error">{{errors.selectedTeam[0]}}</span></td>
      </tr>


     <tr>
        <td><label>Upload File</label></td>
        <td>
          <input type="file" @change="handleFileChange" accept=".xls, .xlsx" name="file" placeholder="Upload"/>

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
import MultiSelect from '../../Shared Folder/MultiSelect.vue';

    export default {
        name:'TlRequestCreation',

        components: {
    MultiSelect,
  },

        data()
        {
            return{
                TlRequest:{
                subject:"",
                requestBody:"",
                requirement:"",
                jobType:"",
                selectedClient:"",
                clientManager:"",
                selectedBusiness:"",
                selectedLocation:"",
                selectedTeam:"",
                },
                userLocation:[],
                errors:{},
                teams: [],
                selectedTeam: [],

            };
        },

        methods:{

userLocationApi()
{
axios
.get('/api/amrequest-create')
.then(response => {
console.log(response.data, "data")
// console.log(response.data.location, "location")

this.userLocation = response.data
console.log(this.userLocation, "location")
})
.catch(error => {
console.log(error)
this.errored = true
})

},

submitForm() {
    this.submitted = true; // Set the submitted flag to true when attempting to submit the form
    // if (this.isFormValid) {

        axios.post('/api/amrequest-create', this.amRequest)
  .then(response => {
      console.log('Form submitted:', response.data.message);
      if(response.data.message){
        this.errors={};

         Swal.fire({
            position: "top-center",
            icon: "success",
            title: "User created successfully",
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

// You might want to reset the form and submitted flag here if needed

    },
},

mounted(){
this.userLocationApi()

}

    }
</script>
