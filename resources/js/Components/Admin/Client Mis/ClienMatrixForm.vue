<template>
     <form @submit.prevent="submitForm">
    <table class="input_form">

        <tr>
    <td ><label >Select Location</label></td>
    <td ><select id="location" v-model="client.selectedLocation" name="location">
    <option value="">Choose Location</option>
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
    <td ><select id="Client"  v-model.trim="client.clientName" name="Client">
    <option value="">Choose Client</option>
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
    <td ><select id="business"  v-model.trim="client.businessName"  name="business">
    <option value="">Choose B-Unit</option>
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
    <td ><select id="matrix"  v-model="client.matrix"  name="matrix">
    <option value="">Choose Matrix</option>
    <option value="requirements">Requirements</option>
    <option value="submission">Submission</option>
    <option value="Selection">Selection</option>
    <option value="Rejections">Rejections</option>
    <option value="Onboarded">Onboarded</option>
    <option value="Dropouts">Dropouts</option>
    <option value="Offboarded">Offboarded</option>
    </select><br>
    <span v-if="errors.matrix" class="error">{{ errors.matrix[0]}}</span>
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
export default {

    name:'ClienMatrixForm',

    data()
        {
            return{
                client: {
                    clientName:"",
                    businessName:"",
                    selectedLocation:"",
                    matrix:"",

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

          userLocationApi() {
      axios
        .get("/api/adminclient-matrix")
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
        .post("/api/adminclient-matrix", this.client)
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
