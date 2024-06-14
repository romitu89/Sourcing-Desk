<template>
    <form @submit.prevent="submitForm">
      <table class="input_form">
        <tr>
          <td><label>Employee Name</label></td>
          <td>
            <select
              id="employeeName"
              v-model="client.employeeName"
              @change="filterEmailData"
              @blur="checkValidation('employeeName')"
              name="employeeName"
            >
              <option value="">Select Employee</option>
              <option v-for="item in uniqueEmployeeNames" :key="item" :value="item">
                {{ item }}
              </option>
            </select>
            <br />
            <span v-if="errors.employeeName" class="error">{{ errors.employeeName[0] }}</span>
          </td>
        </tr>

        <tr v-if="client.employeeName">
          <td><label>Employee Email Id</label></td>
          <td>
            <select
              id="email"
              v-model="client.employeeEmail"
              @blur="checkValidation('employeeEmail')"
              name="Choose Client"
            >
              <option value="">Select Email</option>
              <option v-for="item in filteredEmails" :key="item.email_id" :value="item.email_id">
                {{ item.email_id }}
              </option>
            </select>
            <br />
            <span v-if="errors.employeeEmail" class="error">{{ errors.employeeEmail[0] }}</span>
          </td>
        </tr>

        <tr v-if="client.employeeEmail">
          <td><label>Select Matrix</label></td>
          <td>
            <select
              id="matrix"
              v-model="client.selectedMatrix"
              @blur="checkValidation('selectedMatrix')"
              name="matrix"
            >
              <option value="">Select Matrix</option>
              <option value="Requirements">Requirements</option>
              <option value="Submission">Submission</option>
              <option value="Selection">Selection</option>
              <option value="Rejections">Rejections</option>
              <option value="Onboarded">Onboarded</option>
              <option value="Dropouts">Dropouts</option>
              <option value="Offboarded">Offboarded</option>
              <option value="Daily Report">Daily Report</option>
            </select>
            <br />
            <span v-if="errors.selectedMatrix" class="error">{{ errors.selectedMatrix[0] }}</span>
          </td>
        </tr>

        <tr v-if="client.selectedMatrix">
          <td><label>From Date</label></td>
          <td>
            <input v-model.trim="client.fromDate" @blur="checkValidation('fromDate')" type="date" />
            <span v-if="errors.fromDate" class="error">{{ errors.fromDate[0] }}</span>
          </td>
        </tr>

        <tr v-if="client.fromDate">
          <td><label>To Date</label></td>
          <td>
            <input v-model.trim="client.toDate" @blur="checkValidation('toDate')" type="date" />
            <span v-if="errors.toDate" class="error">{{ errors.toDate[0] }}</span>
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
import { commonFunctionsMixin } from '../../../function.js';
import Swal from 'sweetalert2';
import axios from 'axios';

export default {
  name: 'UserTeamLeadForm',
  mixins: [commonFunctionsMixin],
  data() {
    return {
      client: {
        employeeName: "",
        employeeEmail: "",
        selectedMatrix: "",
        fromDate: "",
        toDate: "",
      },
      submitted: false,
      userData: [],
      filteredEmails: [],
      errors: {},
    };
  },
  computed: {
    uniqueEmployeeNames() {
      const employeeNames = this.userData.map(item => item.employee_name);
      return [...new Set(employeeNames)];
    },
  },
  watch: {
    'client.employeeName'() {
      this.resetFormFields('employeeName');
      this.filterEmailData();
    },
    'client.employeeEmail'() {
      this.resetFormFields('employeeEmail');
    },
    'client.selectedMatrix'() {
      this.resetFormFields('selectedMatrix');
    },
  },
  methods: {
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
    filterEmailData() {
      this.filteredEmails = this.userData.filter(
        item => item.employee_name === this.client.employeeName
      );
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

          Swal.fire({
            position: "top-center",
            icon: "success",
            title: "Form submitted successfully",
            showConfirmButton: false,
            timer: 3000,
          });

          // Handle the response as needed
        })
        .catch((error) => {
          console.error("Error submitting form:", error.response.data.errors);
          this.errors = error.response.data.errors;
        });
    },
    checkValidation(fieldName) {
      if (this.errors.hasOwnProperty(fieldName)) {
        delete this.errors[fieldName];
      }
    },
    resetFormFields(level) {
      const resetMap = {
        employeeName: ['employeeEmail', 'selectedMatrix', 'fromDate', 'toDate'],
        employeeEmail: ['selectedMatrix', 'fromDate', 'toDate'],
        selectedMatrix: ['fromDate', 'toDate'],
      };
      resetMap[level].forEach(field => {
        this.client[field] = "";
      });
      this.errors = {};
    }
  },
  mounted() {
    this.userLocationApi();
  },
};
</script>
