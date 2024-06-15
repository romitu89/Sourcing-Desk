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
            <select id="Client" v-model.trim="client.clientName" @change="filterBusinessUnits" @blur="checkValidation('clientName')" name="Client">
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
            <select id="business" v-model.trim="client.businessName" @blur="checkValidation('businessName')" name="business">
              <option value="">Select B-Unit</option>
              <option v-for="item in filteredBusinessUnits" :key="item.business_unit_name" :value="item.business_unit_name">{{ item.business_unit_name }}</option>
            </select>
            <br>
            <span v-if="errors.businessName" class="error">{{ errors.businessName[0] }}</span>
          </td>
        </tr>

        <!-- Matrix Selection -->
        <tr v-if="client.businessName">
          <td><label>Select Matrix</label></td>
          <td>
            <select id="matrix" v-model.trim="client.matrix" @blur="checkValidation('matrix')" name="matrix">
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
    name: 'ClienMatrixForm',
    mixins: [commonFunctionsMixin],
    data() {
      return {
        client: {
          clientName: "",
          businessName: "",
          selectedLocation: "",
          matrix: "",
        },
        submitted: false,
        clientMis: [],
        filteredClients: [],
        filteredBusinessUnits: [],
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
        this.client.matrix = "";
        this.errors = {};
        this.filterClientData();
      },
      'client.clientName'() {
        this.client.businessName = "";
        this.client.matrix = "";
        this.errors = {};
        this.filterBusinessUnits();
      },
      'client.businessName'() {
        this.client.matrix = "";
        this.errors = {};
      },
    },
    methods: {
      closePopup() {
        this.$emit("closePopup");
      },
      userLocationApi() {
        axios
          .get('/api/editorclient-matrix')
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
      },
      filterBusinessUnits() {
        this.filteredBusinessUnits = this.filteredClients.filter(item => item.client_name === this.client.clientName);
      },
      submitForm() {
        this.submitted = true;
        axios.post('/api/editorclient-matrix', this.client)
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
