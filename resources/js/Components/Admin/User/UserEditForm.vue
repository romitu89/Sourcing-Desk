<template>
  <form @submit.prevent="submitForm">
    <table class="input_form">
      <tr>
        <td><label>Employee Name</label></td>
        <td>
          <input
            type="text"
            v-model="employee.empName"
            @blur="checkValidation('empName')"
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
            @blur="checkValidation('userName')"
            placeholder="User Name"
          />
          <span v-if="errors.userName" class="error">{{ errors.userName[0] }}</span>
        </td>
      </tr>

      <tr>
        <td><label>Password</label></td>
        <td>
          <input
            type="password"
            v-model="employee.password"
            @blur="checkValidation('password')"
            placeholder="Password"
          />
          <span v-if="errors.password" class="error">{{ errors.password[0] }}</span>
        </td>
      </tr>

      <tr>
        <td><label>Confirm Password</label></td>
        <td>
          <input
            type="password"
            v-model="employee.cnfrmPassword"
            @blur="checkValidation('cnfrmPassword')"
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
            @blur="checkValidation('empId')"
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
            @blur="checkValidation('email')"
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
            @blur="checkValidation('mobile')"
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
            @blur="checkValidation('selectedLocation')"
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
          <select
            id="role"
            v-model="employee.role"
            @blur="checkValidation('role')"
            name="role"
          >
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

      <tr v-show="employee.role == 'recruiter' || employee.role == 'teamLead'">
        <td><label>Reporting Manager</label></td>
        <td>
          <select
            id="amManager"
            v-model="employee.selectedReportAM"
            @blur="checkValidation('selectedReportAM')"
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
            @blur="checkValidation('selectedReportAM')"
            name="tlManager"
          >
            <option value="">Select Email ID</option>
            <option v-for="item in userTl" :key="item.email_id" :value="item.email_id">
              {{ item.email_id }}
            </option></select
          ><br /><span v-if="errors.selectedReportAM" class="error">{{
            errors.selectedReportAM[0]
          }}</span>
        </td>
      </tr>

      <tr>
        <td><label>Department</label></td>
        <td>
          <select
            id="department"
            v-model="employee.department"
            @blur="checkValidation('department')"
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
          <input v-model="employee.dob" @blur="checkValidation('dob')" type="date" />
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
  props: {
    editId: {
      type: Number,
      default: null,
    },
  },

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
    };
  },

  methods: {
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
    getUserDetails() {
      axios
        .get("/api/adminuser-edit/" + this.editId)
        .then((response) => {
          console.log(response.data.user, "data");
          this.editEmployee = response.data.user;
          this.employee.empName = this.editEmployee.employee_name;
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
        })
        .catch((error) => {
          console.log(error);
          this.errored = true;
        });
    },
    userLocationApi() {
      axios
        .get("/api/adminuser-create")
        .then((response) => {
          this.userLocation = response.data.locations;
          this.userAm = response.data.userAm;
          this.userTl = response.data.userTl;
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
      this.submitted = true;
      axios
        .post("/api/adminuser-create", this.employee)
        .then((response) => {
          if (response.data.message) {
            this.resetForm();
            this.errors = {};
            Swal.fire({
              position: "top-center",
              icon: "success",
              title: "User created successfully",
              showConfirmButton: false,
              timer: 3000,
            });
          }
        })
        .catch((error) => {
          console.error(error.response.data.errors);
          this.errors = error.response.data.errors;
        });
    },
  },

  mounted() {
    this.userLocationApi();
    this.getUserDetails();
  },
};
</script>
