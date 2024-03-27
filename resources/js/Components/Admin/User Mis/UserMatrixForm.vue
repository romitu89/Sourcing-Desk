<template>
    <form @submit.prevent="submitForm">
    <table class="input_form">

        <tr>
   <td ><label >Employee Name</label></td>
   <td ><select id="employee"  v-model="client.employeeName"  @blur="checkValidation('employeeName')" name="employee">
   <option value="">Select Employee</option>
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
   <td ><select id="email"  v-model.trim="client.employeeEmail"  @blur="checkValidation('employeeEmail')" name="Choose Client">
   <option value="">Select Email</option>
   <option
              v-for="item in userData"
              :key="item.email_id"
              :value="item.email_id"
            >
              {{ item.email_id }}
            </option></select
          ><br /><span v-if="errors.employeeEmail" class="error">{{ errors.employeeEmail[0] }}</span>
        </td>
      </tr>

    <tr>
    <td ><label >Select Matrix</label></td>
    <td ><select id="matrix"  v-model="client.selectedMatrix"  @blur="checkValidation('selectedMatrix')" name="matrix">
    <option value="">Select Matrix</option>
    <option value="Selections-Skill">Selections-Skill</option>
                            <option value="Rejections-Skill">Rejections-Skill</option>
    </select><br>
    <span v-if="errors.selectedMatrix" class="error">{{ errors.selectedMatrix[0] }}</span></td>
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
        name:'UserMatrixForm',

        data()
       {
           return{
               client: {
                employeeName:"",
                employeeEmail:"",
                selectedMatrix:"",

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
        .get("/api/adminuserMis-userMatrix")
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
        .post("/api/adminuserMis-userMatrix", this.client)
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
