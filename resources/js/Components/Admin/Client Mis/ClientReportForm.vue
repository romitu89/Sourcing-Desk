<template>
   <form @submit.prevent="submitForm">
    <table class="input_form">

        <tr>
        <td><label>Select Location</label></td>
        <td>
          <select id="location" v-model="client.selectedLocation"  @blur="checkValidation('selectedLocation')" name="location">
            <option value="">Select Location</option>
            <option
              v-for="item in clientData"
              :key="item.location"
              :value="item.location"
            >
              {{ item.location }}
            </option></select
          ><br /><span v-if="errors.selectedLocation" class="error">{{
            errors.selectedLocation[0]
          }}</span>
        </td>
      </tr>

    <tr>
    <td ><label >Client Name</label></td>
    <td ><select id="client"  v-model="client.clientName"  @blur="checkValidation('clientName')"  name="client">
    <option value="">Select Client</option>
    <option
              v-for="item in clientData"
              :key="item.client_name"
              :value="item.client_name"
            >
              {{ item.client_name }}
            </option></select
          ><br /><span v-if="errors.clientName" class="error">{{
            errors.clientName[0]
          }}</span>
        </td>
      </tr>

    <tr>
    <td ><label >Business Unit</label></td>
    <td ><select id="business"  v-model.trim="client.businessName"  @blur="checkValidation('businessName')" name="business">
    <option value="">Select B-Unit</option>
    <option
              v-for="item in clientData"
              :key="item.business_unit_name"
              :value="item.business_unit_name"
            >
              {{ item.business_unit_name }}
            </option></select
          ><br /><span v-if="errors.businessName" class="error">{{
            errors.businessName[0]
          }}</span>
        </td>
      </tr>

    <tr>
    <td ><label >Select Matrix</label></td>
    <td ><select id="matrix"  v-model="client.selectedMatrix"  @blur="checkValidation('selectedMatrix')" name="matrix">
    <option value="">Select Matrix</option>
    <option value="requirements">Requirements</option>
    <option value="submission">Submission</option>
    <option value="Selection">Selection</option>
    <option value="Rejections">Rejections</option>
    <option value="Onboarded">Onboarded</option>
    <option value="Dropouts">Dropouts</option>
    <option value="Offboarded">Offboarded</option>
    </select><br>
    <span v-if="errors.selectedMatrix" class="error">{{ errors.selectedMatrix[0] }}</span>
    </td>
    </tr>

    <tr>
    <td ><label >From Date</label></td>
    <td ><input  v-model.trim="client.fromDate"  @blur="checkValidation('fromDate')" type="date" >
      <span v-if="errors.fromDate" class="error">{{ errors.fromDate[0] }}</span></td>
    </tr>

    <tr>
    <td ><label >To Date</label></td>
    <td ><input  v-model.trim="client.toDate"  @blur="checkValidation('toDate')" type="date" >
      <span v-if="errors.toDate" class="error">{{ errors.toDate[0] }}</span></td>
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
    name: 'ClientReportForm',

    data()
        {
            return{
                client: {
                    clientName:"",
                    businessName:"",
                    selectedLocation:"",
                    selectedMatrix:"",
                    fromDate:"",
                    toDate:"",
                },
                submitted:false,
                clientData:[],
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
        .get("/api/adminclient-report")
        .then((response) => {
          this.clientData = response.data.clients;
          console.log(this.clientData, "clientData");
        })
        .catch((error) => {
          console.log(error);
          this.errored = true;
        });
    },

    submitForm() {
      this.submitted = true;


      axios
        .post("/api/adminclient-report", this.client)
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
