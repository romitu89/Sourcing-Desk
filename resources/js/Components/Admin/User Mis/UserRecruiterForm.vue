<template>
    <form @submit.prevent="submitForm">
   <table class="input_form">

       <tr>
   <td ><label >Employee Name</label></td>
   <td ><select id="client"  v-model.trim="client.name" name="Choose Location">
   <option value="">Choose Employee</option>
   <option
              v-for="item in userData"
              :key="item.employee_name"
              :value="item.employee_name"
            >
              {{ item.employee_name }}
            </option></select
          ><br /><span v-if="errors.employeeName" class="error">{{ errors.employeeName[0] }}</span>
        </td>
      </tr>

   <tr>
   <td ><label >Employee Email Id</label></td>
   <td ><select id="email"  v-model.trim="client.email" class="color_cell"  name="Choose Client">
   <option value="">Choose Email</option>
   <option value="India">India</option>
   <option value="usa">USA</option>
   </select><br>
   <span v-if="submitted && !validation.email" class="error">Email is required.</span></td>
   </tr>

   <tr>
   <td ><label >Select Matrix</label></td>
   <td ><select id="matrix"  v-model.trim="client.matrix"  name="matrix">
   <option value="">Choose Matrix</option>
   <option value="Requirements">Requirements</option>
   <option value="Submission">Submission</option>
   <option value="Selection">Selection</option>
   <option value="Rejections">Rejections</option>
   <option value="Onboarded">Onboarded</option>
   <option value="Dropouts">Dropouts</option>
   <option value="Offboarded">Offboarded</option>
   <option value="Daily Report">Daily Report</option>
   </select><br>
   <span v-if="submitted && !validation.matrix" class="error">Matrix is required.</span></td>
   </tr>

   <tr>
   <td ><label >From Date</label></td>
   <td ><input  v-model.trim="client.from"  type="date" >
       <span v-if="submitted && !validation.from" class="error">From Date is required.</span></td>
   </tr>

   <tr>
   <td ><label >To Date</label></td>
   <td ><input  v-model.trim="client.to"  type="date" >
       <span v-if="submitted && !validation.to" class="error">To Date is required.</span></td>
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
       name:'UserTeamLeadForm',

       data()
       {
           return{
               client: {
                employeeName:"",
                employeeEmail:"",
                selectedMatrix:"",
                fromDate:"",
                toDate:"",
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
    userLocationApi() {
      axios
        .get("/api/adminuserMis-recruiter")
        .then((response) => {
          this.userData = response.data.User;
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
        .post("/api/adminuserMis-recruiter", this.client)
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
