<template>
    <form @submit.prevent="submitForm">
      <table class="input_form">
        <tr>
          <td><label>Select Location</label></td>
          <td>
            <select id="location" v-model="employee.selectedLocation" @change="updateFilteredData" @blur="checkValidation('selectedLocation')" name="location">
              <option value="">Select Location</option>
              <option v-for="item in getUniqueValues(loginData, 'location')" :key="item" :value="item">{{ item }}</option>
            </select>
            <br>
            <span v-if="errors.selectedLocation" class="error">{{ errors.selectedLocation[0] }}</span>
          </td>
        </tr>
        <tr v-if="employee.selectedLocation">
          <td><label>Employee Email</label></td>
          <td>
            <select id="email" v-model="employee.selectedEmail" @change="resetFormFields('email')" @blur="checkValidation('selectedEmail')" name="email">
              <option value="">Select Email</option>
              <option v-for="item in filteredEmails" :key="item" :value="item">{{ item }}</option>
            </select>
            <br>
            <span v-if="errors.selectedEmail" class="error">{{ errors.selectedEmail[0] }}</span>
          </td>
        </tr>
        <tr v-if="employee.selectedEmail">
          <td><label>From Date</label></td>
          <td>
            <input type="date" v-model="employee.fromDate" @change="resetToDate" @blur="checkValidation('fromDate')">
            <span v-if="errors.fromDate" class="error">{{ errors.fromDate[0] }}</span>
          </td>
        </tr>
        <tr v-if="employee.fromDate">
          <td><label>To Date</label></td>
          <td>
            <input type="date" v-model="employee.toDate" :min="employee.fromDate" @blur="checkValidation('toDate')">
            <span v-if="errors.toDate" class="error">{{ errors.toDate[0] }}</span>
          </td>
        </tr>
        <tr>
          <td></td>
          <td>
            <button @click="closePopup()" class="cancel_btn">Cancel</button>
            <button type="submit" class="submit_btn">Submit</button>
          </td>
        </tr>
      </table>
    </form>
    <div v-if="results.length">
      <responsive-table :results="formattedResults" :columns="columns" :buttonAction="buttonAction"></responsive-table>
    </div>
  </template>

  <script>
  import Swal from 'sweetalert2';
  import { commonFunctionsMixin } from '../../../function.js';
  import ResponsiveTable from '../../Shared Folder/ResponsiveTable.vue';

  export default {
    name: 'UserLoginForm',
    mixins: [commonFunctionsMixin],
    components: {
      ResponsiveTable,
    },
    data() {
      return {
        employee: {
          selectedLocation: "",
          selectedEmail: "",
          fromDate: "",
          toDate: "",
        },
        buttonAction: false,
        loginData: [],
        results: [],
        errors: {},
        columns: [
          { label: 'Email ID', key: 'email_id' },
          { label: 'Location', key: 'location' },
          { label: 'Created At', key: 'formatted_created_at' },
          { label: 'Logout Time', key: 'formatted_logout_time' },
        ],
        filteredEmails: [],
      };
    },
    computed: {
      formattedResults() {
        return this.results.map((result) => ({
          ...result,
          formatted_created_at: this.formatDateTime(result.created_at),
          formatted_logout_time: this.formatDateTime(result.logout_time),
        }));
      },
    },
    methods: {
      closePopup() {
        this.$emit("closePopup");
      },
      checkValidation(fieldName) {
        if (this.errors[fieldName]) {
          delete this.errors[fieldName];
        }
      },
      resetFormFields(field) {
        switch (field) {
          case 'location':
            this.employee.selectedEmail = "";
            this.employee.fromDate = "";
            this.employee.toDate = "";
            break;
          case 'email':
            this.employee.fromDate = "";
            this.employee.toDate = "";
            break;
        }
      },
      resetToDate() {
        this.employee.toDate = "";
      },
      updateFilteredData() {
        this.filteredEmails = this.getUniqueValues(this.loginData.filter(item => item.location === this.employee.selectedLocation), 'email_id');
        this.resetFormFields('location');
      },
      getUniqueValues(data, key) {
        return [...new Set(data.map(item => item[key]))];
      },
      userLocationApi() {
        axios
          .get('/api/editoruser-login')
          .then(response => {
            this.loginData = response.data.login;
          })
          .catch(error => {
            console.error('Error fetching user locations:', error);
          });
      },
      submitForm() {
        axios.post('/api/editoruser-login', this.employee)
          .then(response => {
            this.results = response.data.results;
            this.errors = {};
            if (!Object.values(this.errors).length) {
              this.buttonAction = true;
              this.employee = {
                selectedLocation: "",
                selectedEmail: "",
                fromDate: "",
                toDate: "",
              };
            }
          })
          .catch(error => {
            this.errors = error.response.data.errors;
          });
      },
    },
    mounted() {
      this.userLocationApi();
    },
  };
  </script>

  <style scoped>
  /* Your component-specific styles */
  </style>
