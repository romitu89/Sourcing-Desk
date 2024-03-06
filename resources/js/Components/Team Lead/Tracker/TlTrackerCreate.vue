<template>
    <form @submit.prevent="submitForm">
     <table class="input_form">

        <tr>
     <td ><label >Client Name</label></td>
     <td ><select id="client" v-model="tlTracker.selectedClient" name="client">
     <option value="">Select Client</option>
     <option v-for="item in userLocation" :key='item.location' :value="item.location">{{ item.location }}</option>

     </select><span v-if="errors.selectedClient" class="error">{{errors.selectedClient[0]}}</span></td>
     </tr>

     <tr>
     <td ><label >Client Manager Name</label></td>
     <td ><select id="buisness" v-model="tlTracker.clientManagerName" name="buisness">
     <option value="">Select Manager</option>
     <!-- <option v-for="item in userLocation" :key='item.location' :value="item.location">{{ item.location }}</option> -->

     </select><span v-if="errors.clientManagerName" class="error">{{errors.clientManagerName[0]}}</span></td>
     </tr>

     <tr>
        <td><label>Upload File</label></td>
        <td>
          <input type="file" @change="handleFileChange" accept=".xls, .xlsx" name="file" placeholder="Upload"/>

          <span v-if="errors.file" class="error">{{errors.file[0]}}</span></td>
      </tr>

     <tr>
     <td ><label >Buisness Unit</label></td>
     <td ><select id="buisness" v-model="tlTracker.selectedBusiness" name="buisness">
     <option value="">Select Unit</option>
     <!-- <option v-for="item in userLocation" :key='item.location' :value="item.location">{{ item.location }}</option> -->

     </select><span v-if="errors.selectedBusiness" class="error">{{errors.selectedBusiness[0]}}</span></td>
     </tr>

     <tr>
     <td ><label >Select Location</label></td>
     <td ><select id="location" v-model="tlTracker.selectedLocation" name="location">
     <option value="">Select Location</option>
     <option v-for="item in userLocation" :key='item.location' :value="item.location">{{ item.location }}</option>

     </select><span v-if="errors.selectedLocation" class="error">{{errors.selectedLocation[0]}}</span></td>
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
        name:'TlTrackerCreate',

        data()
        {
            return{
                tlTracker:
                {
                selectedClient:"",
                clientManagerName:"",
                file:null,
                selectedBusiness:"",
                selectedLocation:"",
                },
                userLocation:[],
                tlTrackerData:[],
                errors:[],

            };
        },

        methods: {
            handleFileChange(event) {
        this.tlTracker.file = event.target.files[0];
      },

      userLocationApi() {
        axios
          .get("/api/tltracker-create")
          .then((response) => {
            console.log(response.data, "data");
            // console.log(response.data.location, "location")

            this.tlTrackerData = response.data.client;
            console.log(this.tlTrackerData, "client");
          })
          .catch((error) => {
            console.log(error);
            this.errored = true;
          });
      },

      submitForm() {
        this.submitted = true; // Set the submitted flag to true when attempting to submit the form
        let formData = new FormData();
        formData.append('selectedClient', this.tlTracker.selectedClient);
        formData.append('clientManagerName', this.tlTracker.clientManagerName);
        formData.append('selectedBusiness', this.tlTracker.selectedBusiness);
        formData.append('selectedLocation', this.tlTracker.selectedLocation);
        formData.append('file', this.tlTracker.file);

        axios
          .post("/api/tltracker-create", formData)
          .then((response) => {
            console.log("Form submitted:", response.data.message);
            if (response.data.message) {
              this.errors = {};

              Swal.fire({
                position: "top-center",
                icon: "success",
                title: "User created successfully",
                showConfirmButton: false,
                timer: 5000,
              });
            } else {
              Swal.fire("Form not Submitted");
            }

            // Handle the response as needed
          })
          .catch((error) => {

            this.errors = error.response.data.errors;

          });

        // You might want to reset the form and submitted flag here if needed
      },

        },

        mounted() {
      this.userLocationApi();
    },

    }
</script>
