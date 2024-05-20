<template>
    <form @submit.prevent="submitForm">
      <table class="input_form">
        <tr>
          <td><label>Select Location</label></td>
          <td>
            <select v-model="tracker.selectedLocation" @change="fetchClients" @blur="checkValidation('selectedLocation')" name="location">
              <option value="">Select Location</option>
              <option v-for="item in userLocation" :key="item.location" :value="item.location">{{ item.location }}</option>
            </select><br>
            <span v-if="errors.selectedLocation" class="error">{{ errors.selectedLocation[0] }}</span>
          </td>
        </tr>

        <tr v-if="tracker.selectedLocation">
          <td><label>Client Name</label></td>
          <td>
            <select v-model="tracker.selectedClient" @change="fetchBusinessUnits" @blur="checkValidation('selectedClient')" name="client">
              <option value="">Select Client</option>
              <option v-for="client in clients" :key="client.client_name" :value="client.client_name">{{ client.client_name }}</option>
            </select><br>
            <span v-if="errors.selectedClient" class="error">{{ errors.selectedClient[0] }}</span>
          </td>
        </tr>

        <tr v-if="tracker.selectedClient">
          <td><label>Business Unit</label></td>
          <td>
            <select v-model="tracker.selectedBusiness" @change="fetchClientManagers" @blur="checkValidation('selectedBusiness')" name="business">
              <option value="">Select Unit</option>
              <option v-for="client in clients" :key="client.business_unit" :value="client.business_unit">{{ client.business_unit }}</option>
            </select><br>
            <span v-if="errors.selectedBusiness" class="error">{{ errors.selectedBusiness[0] }}</span>
          </td>
        </tr>

        <tr v-if="tracker.selectedBusiness">
          <td><label>Client Manager Name</label></td>
          <td>
            <select v-model="tracker.selectedManager" @blur="checkValidation('selectedManager')" name="manager">
              <option value="">Select Manager</option>
              <option v-for="client in clients" :key="client.client_manager_name" :value="client.client_manager_name">{{ client.client_manager_name }}</option>
            </select><br>
            <span v-if="errors.selectedManager" class="error">{{ errors.selectedManager[0] }}</span>
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

    <div v-if="results">
      <responsive-table :results="results" :columns="columns" :buttonAction="buttonAction">
      <template #edit="{ row }">
        <div>
          <button title="Edit" @click="editItem(row.id)">
            <font-awesome-icon :icon="['fas', 'pen-to-square']" />
          </button>
          <button title="Delete" @click="deleteItem(row.id)">
            <font-awesome-icon :icon="['fas', 'trash']" />
          </button>
        </div>
      </template>
      </responsive-table>
    </div>
  </template>

  <script>
  import { commonFunctionsMixin } from '../../../function.js';
import axios from 'axios';
import ResponsiveTable from '../../Shared Folder/ResponsiveTable.vue';

export default {
  name: 'AmTrackerView',
  mixins:[commonFunctionsMixin],
  components: {
    ResponsiveTable,
  },
  data() {
    return {
      buttonAction: false,
      tracker: {
        selectedLocation: '',
        selectedClient: '',
        selectedBusiness: '',
        selectedManager: '',
      },
      userLocation: [],
      clients: [],
      errors: {},
      results: [],
      columns: [
        { label: 'Client Name', key: 'client_name' },
        { label: 'Client Manager Name', key: 'client_manager_name' },
        { label: 'Business Unit', key: 'business_unit' },
        { label: 'Select Location', key: 'location' },
        { label: 'Edit', key: 'edit' },
      ],
      empNameProp:this.empName
    };
  },
  props:{
          empName:{
            type: String,
            default: "",
          },
        },
  methods: {
    closePopup() {
      this.$emit('closePopup');
    },
    editItem(id) {
      this.$emit("updateForm", id);
    },
    checkValidation(fieldName) {
      if (this.errors.hasOwnProperty(fieldName)) {
        delete this.errors[fieldName];
      }
    },
    fetchClients() {
      const selectedLocation = this.tracker.selectedLocation;
      if (selectedLocation) {
        // Fetch clients based on selected location
        this.clients = this.userLocation.filter(item => item.location === selectedLocation);
      } else {
        this.clients = [];
      }
      // Reset subsequent selections
      this.tracker.selectedClient = '';
      this.tracker.selectedBusiness = '';
      this.tracker.selectedManager = '';
    },
    fetchBusinessUnits() {
      const selectedClientName = this.tracker.selectedClient;
      if (selectedClientName) {
        // Filter clients to find the selected client
        const selectedClient = this.clients.find(client => client.client_name === selectedClientName);
        if (selectedClient) {
          // Set the business units based on the selected client
          this.clients = [selectedClient]; // Update clients array with selected client for consistency
        } else {
          this.clients = []; // No matching client found, clear the array
        }
      } else {
        this.clients = []; // Reset clients if no client is selected
      }
    },
    fetchClientManagers() {
      // Logic to fetch client managers based on selected business unit
    },
    userLocationApi() {
      axios.get('/api/amtracker-view')
        .then(response => {
          this.userLocation = response.data.client;
          console.log(this.userLocation); // Check the data in console
        })
        .catch(error => {
          console.error('Error fetching user location:', error);
          this.errored = true;
        });
    },
    resetForm() {
      this.tracker.selectedLocation = '';
      this.tracker.selectedClient = '';
      this.tracker.selectedBusiness = '';
      this.tracker.selectedManager = '';
      this.errors = {};
    },
    submitForm() {
      this.submitted = true;
      axios.post('/api/amtracker-view', this.tracker)
        .then(response => {
          this.results = response.data.results;
          if (Object.values(this.errors).length === 0) {
            this.buttonAction = true;
          }
        })
        .catch(error => {
          console.error('Error submitting form:', error.response.data.errors);
          this.errors = error.response.data.errors;
        });
      this.resetForm();
    },
    clearMessage(){
      this.empNameProp = ""

    },
    showSucess(){
      if(this.empNameProp!=""){
      Swal.fire({
              position: "top-center",
              icon: "success",
              title: "User "+this.empNameProp+" edited successfully",
              showConfirmButton: false,
              timer: 3000,
            });

    }
    },
},

  mounted() {
    this.userLocationApi();
  },
  watch: {
    empName(newVal){
            this.empNameProp = newVal
          },
    userLocation: {
      handler() {
        this.tracker.selectedLocation = ''; // Reset selected location
      },
      deep: true
    },
  },
};
</script>
