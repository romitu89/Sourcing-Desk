<template>
  <form @submit.prevent="submitForm">
    <table class="input_form">
      <tr>
        <td><label>Employee Name</label></td>
        <td>
          <input
            type="text"
            v-model="employee.empName"
            @blur="checkValidation()"
            placeholder="Employee Name"
          />
          <span v-if="errors.empName" class="error">{{ errors.empName[0] }}</span>
        </td>
      </tr>

      <tr>
        <td><label>User Name</label></td>
        <td>
          <input
            type="text"
            v-model="employee.userName"
            @blur="checkValidation()"
            placeholder="User Name"
          />
          <span v-if="errors.userName" class="error">{{ errors.userName[0] }}</span>
        </td>
      </tr>

      <tr>
        <td><label>Password</label></td>
        <td>
          <input
            type="text"
            v-model="employee.password"
            @blur="checkValidation()"
            placeholder="Password"
          />
          <span v-if="errors.password" class="error">{{ errors.password[0] }}</span>
        </td>
      </tr>

      <tr>
        <td><label>Confirm Password</label></td>
        <td>
          <input
            type="text"
            v-model="employee.cnfrmPassword"
            @blur="checkValidation()"
            placeholder="Confirm Password"
          />
          <span v-if="errors.cnfrmPassword" class="error">{{
            errors.cnfrmPassword[0]
          }}</span>
        </td>
      </tr>

      <tr>
        <td><label>Employee Id</label></td>
        <td>
          <input
            type="text"
            v-model="employee.empId"
            @blur="checkValidation()"
            placeholder="Employee Id"
          />
          <span v-if="errors.empId" class="error">{{ errors.empId[0] }}</span>
        </td>
      </tr>

      <tr>
        <td><label>Email Id</label></td>
        <td>
          <input
            type="text"
            v-model="employee.email"
            @blur="checkValidation()"
            placeholder="Email Id"
          />
          <span v-if="errors.email" class="error">{{ errors.email[0] }}</span>
        </td>
      </tr>

      <tr>
        <td><label>Mobile Number</label></td>
        <td>
          <input
            type="text"
            v-model="employee.mobile"
            @blur="checkValidation()"
            placeholder="Mobile Number"
          />
          <span v-if="errors.mobile" class="error">{{ errors.mobile[0] }}</span>
        </td>
      </tr>

      <tr>
        <td><label>Select Location</label></td>
        <td>
          <select
            id="location"
            v-model="employee.selectedLocation"
            @blur="checkValidation()"
            name="location"
          >
            <option value="">Select Location</option>
            <option
              v-for="item in userLocation"
              :key="item.country"
              :value="item.country"
            >
              {{ item.country }}
            </option></select
          ><br /><span v-if="errors.selectedLocation" class="error">{{
            errors.selectedLocation[0]
          }}</span>
        </td>
      </tr>

      <tr>
        <td><label>Role</label></td>
        <td>
          <select id="role" v-model="employee.role" @blur="checkValidation()" name="role">
            <option value="">Select Role</option>
            <option value="admin">Admin</option>
            <option value="editor">Editor</option>
            <option value="accountManager">Account-Manager</option>
            <option value="teamLead">Team-Lead</option>
            <option value="recruiter">Recruiter</option>
            <option value="hr-payroll">Hr-Payroll</option></select
          ><br /><span v-if="errors.role" class="error">{{ errors.role[0] }}</span>
        </td>
      </tr>

      <tr v-show="employee.role == 'recruiter'">
        <td><label>Reporting Manager</label></td>
        <td>
          <select
            id="amManager"
            v-model="employee.selectedReportAM"
            @blur="checkValidation()"
            name="amManager"
          >
            <option value="">Select Email ID</option>
            <option v-for="item in userAm" :key="item.email_id" :value="item.email_id">
              {{ item.email_id }}
            </option></select
          ><br /><span v-if="errors.selectedReportAM" class="error">{{
            errors.selectedReportAM[0]
          }}</span>
        </td>
      </tr>

      <tr v-show="employee.role == 'recruiter'">
        <td><label>Reporting Team Lead</label></td>
        <td>
          <select
            id="tlManager"
            v-model="employee.selectedReportTL"
            @blur="checkValidation()"
            name="tlManager"
          >
            <option value="">Select Email ID</option>
            <option v-for="item in userTl" :key="item.email_id" :value="item.email_id">
              {{ item.email_id }}
            </option></select
          ><br /><span v-if="errors.selectedReportTL" class="error">{{
            errors.selectedReportTL[0]
          }}</span>
        </td>
      </tr>

      <tr>
        <td><label>Department</label></td>
        <td>
          <select
            id="department"
            v-model="employee.department"
            @blur="checkValidation()"
            name="department"
          >
            <option value="">Select Department</option>
            <option value="hrStaffing">HR-Staffing</option>
            <option value="hrPayroll">HR-Payroll</option>
            <option value="sales">Sales</option>
            <option value="informationTechnology">Information Technology</option>
            <option value="others">Others</option></select
          ><br /><span v-if="errors.department" class="error">{{
            errors.department[0]
          }}</span>
        </td>
      </tr>

      <tr>
        <td><label>Date of Birth</label></td>
        <td>
          <input v-model="employee.dob" @blur="checkValidation()" type="date" />
          <span v-if="errors.dob" class="error">{{ errors.dob[0] }}</span>
        </td>
      </tr>

      <tr>
        <td></td>
        <td>
          <button @click="closePopup()" class="cancel_btn">Cancel</button>
          <button class="submit_btn">Submit</button>
        </td>
      </tr>
    </table>
  </form>
</template>

<script>
import Swal from "sweetalert2";

export default {
  name: "UserEditForm",

  data() {
    return {
      employee: {
        empName: "",
        userName: "",
        password: "",
        cnfrmPassword: "",
        empId: "",
        email: "",
        mobile: "",
        selectedLocation: "",
        role: "",
        selectedReportAM: "",
        selectedReportTL: "",
        department: "",
        dob: "",
      },
      submitted: false,
      userLocation: [],
      errors: {},
      userAm: [],
      userTl: [],
    };
  },

  computed: {
    isFormValid() {
      return Object.values(this.errors);
    },
  },

  methods: {
    closePopup() {
      this.$emit("closePopup");
    },
    checkValidation() {
      let submit = Object.values(this.errors);
      console.log(submit, "is form valid");
      if (this.isFormValid.length > 0) {
        // if(this.isFormValid.length!=0)
        // { this.submitForm() }
        this.submitForm();
      }
    },

    userLocationApi() {
      axios
        .get("/api/adminuser-create")
        .then((response) => {
          console.log(response.data.locations, "data");
          // console.log(response.data.location, "location")

          this.userLocation = response.data.locations;
          this.userAm = response.data.userAm;
          this.userTl = response.data.userTl;
          console.log(this.userLocation, "location");
        })
        .catch((error) => {
          console.log(error);
          this.errored = true;
        });
    },

    resetForm() {
      this.employee.empName = "";
      this.employee.userName = "";
      this.employee.password = "";
      this.employee.cnfrmPassword = "";
      this.employee.empId = "";
      this.employee.email = "";
      this.employee.mobile = "";
      this.employee.selectedLocation = "";
      this.employee.role = "";
      this.employee.department = "";
      this.employee.dob = "";
    },

    submitForm() {
      this.submitted = true; // Set the submitted flag to true when attempting to submit the form
      // if (this.isFormValid) {

      axios
        .post("/api/adminuser-create", this.employee)
        .then((response) => {
          console.log("Form submitted:", response.data.message);
          if (response.data.message) {
            this.errors = {};
            // if( Object.values(this.errors).length == 0)
            // {
            Swal.fire({
              position: "top-center",
              icon: "success",
              title: "User created successfully",
              showConfirmButton: false,
              timer: 3000,
            });
            this.resetForm();
            // }
          } else {
            Swal.fire("Form not Submitted");
          }

          // Handle the response as needed
        })
        .catch((error) => {
          //   console.error('Error submitting form:', error.response.data.errors);
          this.errors = error.response.data.errors;
          console.log(this.errors, "errors");
        });

      // You might want to reset the form and submitted flag here if needed
    },
  },

  mounted() {
    this.userLocationApi();
  },
};
</script>
