<template>
    <form @submit.prevent="submitForm">
     <table class="input_form">

     <tr>
     <td ><label >Select Country</label></td>
     <td ><select id="Country"  v-model="client.selectedLocation" @blur="checkValidation('selectedLocation')" name=" Country">
     <option value="">Select Country</option>
     <option
              v-for="item in userData"
              :key="item.country"
              :value="item.country"
            >
              {{ item.country }}
            </option></select
          ><br /><span v-if="errors.selectedLocation" class="error">{{ errors.selectedLocation[0] }}</span>
        </td>
      </tr>

     <tr>
     <td ><label >Select Duration</label></td>
     <td ><select id="Location"  v-model="client.selectedDuration" @blur="checkValidation('selectedDuration')" name="Select Location">
     <option value="">Select Duration</option>
     <option value="6">6 Months</option>
    <option value="1 year">1 Years</option>
    <option value="3 year">3 Years</option>
    <option value="5 years">5 Years</option>
    <option value="5 years">5 Years</option>
    <option value="more">More</option>
     </select><br>
     <span v-if="errors.selectedDuration" class="error">{{ errors.selectedDuration[0] }}</span></td>
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
     export default {
         name:'FilteredDatabaseForm',

         data()
        {
            return{
                client: {
                    selectedLocation:"",
                    selectedDuration:"",


                },
                submitted:false,
                userData:[],
                errors:{},

            };
        },


            methods:{
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
    userLocationApi() {
      axios
        .get("/api/adminProfile-updateRequest")
        .then((response) => {
          this.userData = response.data.location;
          console.log(this.userData, "userData");
        })
        .catch((error) => {
          console.log(error);
          this.errored = true;
        });
    },

    submitForm() {
      this.submitted = true;


      axios
        .post("/api/adminProfile-updateRequest", this.client)
        .then((response) => {
          this.errors = {};

          console.log("Form submitted:", response.data.results);
          if (Object.values(this.errors).length == 0) {
            this.buttonAction = true;
          }
          this.results = response.data.results;

          // Handle the response as needed
        })
        .catch((error) => {
          console.error("Error submitting form:", error.response.data.errors);
          this.errors = error.response.data.errors;
        });
    },
  },
  mounted() {
    this.userLocationApi();
  },
};
 </script>
