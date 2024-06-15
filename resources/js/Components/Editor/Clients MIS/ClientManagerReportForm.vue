<template>
    <form @submit.prevent="submitForm">
      <table class="input_form">
        <!-- Location Selection -->
        <tr>
          <td><label>Select Location</label></td>
          <td>
            <select id="location" v-model="client.selectedLocation" @change="filterClientData" @blur="checkValidation('selectedLocation')" name="location">
              <option value="">Select Location</option>
              <option v-for="item in uniqueLocations" :key="item" :value="item">{{ item }}</option>
            </select>
            <br>
            <span v-if="errors.selectedLocation" class="error">{{ errors.selectedLocation[0] }}</span>
          </td>
        </tr>

        <!-- Client Name Selection -->
        <tr v-if="client.selectedLocation">
          <td><label>Client Name</label></td>
          <td>
            <select id="client" v-model="client.clientName" @change="filterBusinessUnits" @blur="checkValidation('clientName')" name="client">
              <option value="">Select Client</option>
              <option v-for="item in filteredClients" :key="item.client_name" :value="item.client_name">{{ item.client_name }}</option>
            </select>
            <br>
            <span v-if="errors.clientName" class="error">{{ errors.clientName[0] }}</span>
          </td>
        </tr>

        <!-- Business Unit Selection -->
        <tr v-if="client.clientName">
          <td><label>Business Unit</label></td>
          <td>
            <select id="business" v-model="client.businessName" @change="filterClientManagers" @blur="checkValidation('businessName')" name="business">
              <option value="">Select B-Unit</option>
              <option v-for="item in filteredBusinessUnits" :key="item.business_unit_name" :value="item.business_unit_name">{{ item.business_unit_name }}</option>
            </select>
            <br>
            <span v-if="errors.businessName" class="error">{{ errors.businessName[0] }}</span>
          </td>
        </tr>

        <!-- Client Manager Name Selection -->
        <tr v-if="client.businessName">
          <td><label>Client Manager Name</label></td>
          <td>
            <select id="manager" v-model="client.clientManager" @blur="checkValidation('clientManager')" name="manager">
              <option value="">Select Manager</option>
              <option v-for="item in filteredClientManagers" :key="item.client_manager_name" :value="item.client_manager_name">{{ item.client_manager_name }}</option>
            </select>
            <br>
            <span v-if="errors.clientManager" class="error">{{ errors.clientManager[0] }}</span>
          </td>
        </tr>

        <!-- Matrix Selection -->
        <tr v-if="client.clientManager">
          <td><label>Select Matrix</label></td>
          <td>
            <select id="matrix" v-model="client.matrix" @blur="checkValidation('matrix')" name="matrix">
              <option value="">Select Matrix</option>
              <option value="requirements">Requirements</option>
              <option value="submission">Submission</option>
              <option value="Selection">Selection</option>
              <option value="Rejections">Rejections</option>
              <option value="Onboarded">Onboarded</option>
              <option value="Dropouts">Dropouts</option>
              <option value="Offboarded">Offboarded</option>
            </select>
            <br>
            <span v-if="errors.matrix" class="error">{{ errors.matrix[0] }}</span>
          </td>
        </tr>

        <!-- From Date Selection -->
        <tr v-if="client.matrix">
          <td><label>From Date</label></td>
          <td>
            <input v-model="client.fromDate" @blur="checkValidation('fromDate')" type="date">
            <span v-if="errors.fromDate" class="error">{{ errors.fromDate[0] }}</span>
          </td>
        </tr>

        <!-- To Date Selection -->
        <tr v-if="client.fromDate">
          <td><label>To Date</label></td>
          <td>
            <input v-model="client.toDate" @blur="checkValidation('toDate')" type="date">
            <span v-if="errors.toDate" class="error">{{ errors.toDate[0] }}</span>
          </td>
        </tr>

        <!-- Submit and Cancel Buttons -->
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
  import axios from 'axios';
  import Swal from 'sweetalert2';
  import { commonFunctionsMixin } from '../../../function.js';

  export default {
    name: 'ClientManagerReportForm',
    mixins: [commonFunctionsMixin],
    data() {
      return {
        client: {
          clientName: "",
          businessName: "",
          selectedLocation: "",
          clientManager: "",
          matrix: "",
          fromDate: "",
          toDate: "",
        },
        submitted: false,
        clientMis: [],
        filteredClients: [],
        filteredBusinessUnits: [],
        filteredClientManagers: [],
        errors: {},
      };
    },
    computed: {
      uniqueLocations() {
        const locations = this.clientMis.map(item => item.location);
        return [...new Set(locations)];
      },
    },
    watch: {
      'client.selectedLocation'() {
        this.client.clientName = "";
        this.client.businessName = "";
        this.client.clientManager = "";
        this.client.matrix = "";
        this.client.fromDate = "";
        this.client.toDate = "";
        this.errors = {};
        this.filterClientData();
      },
      'client.clientName'() {
        this.client.businessName = "";
        this.client.clientManager = "";
        this.client.matrix = "";
        this.client.fromDate = "";
        this.client.toDate = "";
        this.errors = {};
        this.filterBusinessUnits();
      },
      'client.businessName'() {
        this.client.clientManager = "";
        this.client.matrix = "";
        this.client.fromDate = "";
        this.client.toDate = "";
        this.errors = {};
        this.filterClientManagers();
      },
      'client.clientManager'() {
        this.client.matrix = "";
        this.client.fromDate = "";
        this.client.toDate = "";
        this.errors = {};
      },
      'client.matrix'() {
        this.client.fromDate = "";
        this.client.toDate = "";
        this.errors = {};
      },
    },
    methods: {
      closePopup() {
        this.$emit("closePopup");
      },
      userLocationApi() {
        axios
          .get('/api/editorclient-managerreport')
          .then(response => {
            this.clientMis = response.data.clients;
          })
          .catch(error => {
            console.log(error);
            this.errored = true;
          });
      },
      filterClientData() {
        this.filteredClients = this.clientMis.filter(item => item.location === this.client.selectedLocation);
        this.filteredBusinessUnits = [];
        this.filteredClientManagers = [];
      },
      filterBusinessUnits() {
        this.filteredBusinessUnits = this.filteredClients.filter(item => item.client_name === this.client.clientName);
        this.filteredClientManagers = [];
      },
      filterClientManagers() {
        this.filteredClientManagers = this.filteredBusinessUnits.filter(item => item.business_unit_name === this.client.businessName);
      },
      submitForm() {
        this.submitted = true;
        axios.post('/api/editorclient-managerreport', this.client)
          .then(response => {
            this.errors = {};
            Swal.fire({
              position: "top-center",
              icon: "success",
              title: "Form submitted successfully",
              showConfirmButton: false,
              timer: 3000,
            });
          })
          .catch(error => {
            this.errors = error.response.data.errors;
          });
      },
      checkValidation(fieldName) {
        if (this.errors.hasOwnProperty(fieldName)) {
          delete this.errors[fieldName];
        }
      },
    },
    mounted() {
      this.userLocationApi();
    },
  };
  </script>
