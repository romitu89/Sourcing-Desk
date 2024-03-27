<template>
    <form @submit.prevent="submitForm">
     <table class="input_form">

     <tr>
     <td ><label >Select Country</label></td>
     <td ><select id="Location"  v-model="client.selectedLocation"  @blur="checkValidation('selectedLocation')" name="Select Location">
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
     <td ><select id="duration"  v-model="client.selectedDuration" @blur="checkValidation('selectedDuration')" name="Select duration">
     <option value="">Select Duration</option>
     <option value="5 year">5 Years</option>
    <option value="7 year">7 Years</option>
    <option value="10 year">10 Years</option>
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
        .get("/api/adminProfile-deletionRequest")
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
        .post("/api/adminProfile-deletionRequest", this.client)
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
