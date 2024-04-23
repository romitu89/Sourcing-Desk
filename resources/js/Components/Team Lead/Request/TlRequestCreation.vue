<template>
    <form  @submit.prevent="submitForm">
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
     <option v-for="item in client" :key='item.client_name' :value="item.client_name">{{ item.client_name }}</option>

     </select><br><span v-if="errors.selectedClient" class="error">{{errors.selectedClient[0]}}</span></td>
     </tr>

     <tr>
     <td ><label >Buisness Unit</label></td>
     <td ><select id="buisness" v-model="TlRequest.selectedBusiness" name="buisness">
     <option value="">Select Unit</option>
     <option v-for="item in client" :key='item.business_unit_name' :value="item.business_unit_name">{{ item.business_unit_name }}</option>

     </select><br><span v-if="errors.selectedBusiness" class="error">{{errors.selectedBusiness[0]}}</span></td>
     </tr>

     <tr>
     <td ><label >Select Location</label></td>
     <td ><select id="location" v-model="TlRequest.selectedLocation"  name="location">
     <option value="">Select Location</option>
     <option v-for="item in client" :key='item.location' :value="item.location">{{ item.location }}</option>

     </select><br><span v-if="errors.selectedLocation" class="error">{{errors.selectedLocation[0]}}</span></td>
     </tr>

     <tr>
     <td ><label >Client Manager Name</label></td>
     <td ><select id="buisness" v-model="TlRequest.clientManager" name="buisness">
     <option value="">Select Manager</option>
     <option v-for="item in client" :key='item.client_manager_name' :value="item.client_manager_name">{{ item.client_manager_name }}</option>

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
            <input
              type="file"
              ref="file"
              @change="handleFileChange"
              accept=".xls, .xlsx"
              name="file"
              placeholder="Upload"  
            /><br>
            <span v-if="errors.file" class="error">{{errors.file[0]}}</span>

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
import Swal from 'sweetalert2'
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
                    subject:'',
                    requestBody:'',
                    requirement:'',
                    jobType:'',
                    selectedClient:'',
                    selectedBusiness:'',
                    selectedLocation:'',
                    clientManager:'',
                    file: null,
                    selectedTeam:[],
                },
                
                    teamEmail:[],
                    client: [],
                    teams: [],
                    selectedTeam: [],
                    errors:{},
                };
        },

        methods:{
            closePopup() {
      this.$emit("closePopup");
    },
    handleFileChange() {
        console.log(this.$refs.file.files[0],"this.$refs.file")
        this.TlRequest.file = this.$refs.file.files[0]
        console.log(this.TlRequest.file,"this.TlRequest.file")
      },
userLocationApi()
{
axios
.get('/api/tlrequest-create')
.then(response => {
console.log(response.data, "data")

this.client = response.data.client
console.log(this.client, "client")

const teamEmail = response.data.teamEmail; // Corrected variable name to match your initial question

          teamEmail.forEach((tm) => {
            this.teams.push({
              label: tm.email, // Display email as the label
              value: tm.email, // Use team ID as the value
            });
          });
        })
        .catch((error) => {
          console.log(error);
          this.errored = true;
        });
    },

    updateSelectedOptions(newVal) {
      if (JSON.stringify(newVal) !== JSON.stringify(this.TlRequest.selectedTeam)) {
        this.TlRequest.selectedTeam = newVal;
      }
    },

submitForm() {
    this.submitted = true; // Set the submitted flag to true when attempting to submit the form
    // if (this.isFormValid) {

        axios.post('/api/tlrequest-create', this.TlRequest,
        {
    headers: {
        'Content-Type': 'multipart/form-data'
    }
  })
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
