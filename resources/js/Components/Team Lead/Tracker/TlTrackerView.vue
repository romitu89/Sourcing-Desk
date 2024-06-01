<template>
    <form @submit.prevent="submitForm">
      <table class="input_form">

        <tr>
          <td><label>Select Location</label></td>
          <td>
            <select id="location" v-model="TlTracker.selectedLocation" @blur="checkValidation('selectedLocation')" name="location">
              <option value="">Select Location</option>
              <option v-for="item in getUniqueValues(userLocation, 'location')" :key="item" :value="item">{{ item }}</option>
            </select>
            <br>
            <span v-if="errors.selectedLocation" class="error">{{ errors.selectedLocation[0] }}</span>
          </td>
        </tr>

        <tr v-if="TlTracker.selectedLocation">
          <td><label>Client Name</label></td>
          <td>
            <select id="client" v-model="TlTracker.selectedClient" @blur="checkValidation('selectedClient')" name="client">
              <option value="">Select Client</option>
              <option v-for="item in userLocation" :key="item.client_name" :value="item.client_name">{{ item.client_name }}</option>
            </select>
            <br>
            <span v-if="errors.selectedClient" class="error">{{ errors.selectedClient[0] }}</span>
          </td>
        </tr>

        <tr v-if="TlTracker.selectedClient">
          <td><label>Business Unit</label></td>
          <td>
            <select id="business" v-model="TlTracker.selectedBusiness" @blur="checkValidation('selectedBusiness')" name="business">
              <option value="">Select Unit</option>
              <option v-for="item in userLocation" :key="item.business_unit" :value="item.business_unit">{{ item.business_unit }}</option>
            </select>
            <br>
            <span v-if="errors.selectedBusiness" class="error">{{ errors.selectedBusiness[0] }}</span>
          </td>
        </tr>

        <tr v-if="TlTracker.selectedBusiness">
          <td><label>Client Manager Name</label></td>
          <td>
            <select id="manager" v-model="TlTracker.selectedManager" @blur="checkValidation('selectedManager')" name="manager">
              <option value="">Select Manager</option>
              <option v-for="item in userLocation" :key="item.client_manager_name" :value="item.client_manager_name">{{ item.client_manager_name }}</option>
            </select>
            <br>
            <span v-if="errors.selectedManager" class="error">{{ errors.selectedManager[0] }}</span>
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
  import ResponsiveTable from '../../Shared Folder/ResponsiveTable.vue';
  import axios from 'axios';

  export default {
    name: 'TlTrackerView',
    mixins: [commonFunctionsMixin],
    components: {
      ResponsiveTable,
    },
    data() {
      return {
        buttonAction: false,
        TlTracker: {
          selectedLocation: '',
          selectedClient: '',
          selectedBusiness: '',
          selectedManager: '',
        },
        userLocation: [],
        errors: {},
        results: [],
        columns: [
          { label: 'Client Name', key: 'client_name' },
          { label: 'Client Manager Name', key: 'client_manager_name' },
          { label: 'Business Unit Name', key: 'business_unit' },
          { label: 'Select Location', key: 'location' },
          { label: 'Edit', key: 'edit' }
          // Add other columns here
        ],
        empNameProp: this.empName,
      };
    },
    props: {
      empName: {
        type: String,
        default: '',
      },
    },
    watch: {
      empName(newVal) {
        this.empNameProp = newVal;
      },
    },
    methods: {
      closePopup() {
        this.$emit('closePopup');
      },
      editItem(id) {
        this.$emit('updateForm', id);
      },
      userLocationApi() {
        axios
          .get('/api/tltracker-view')
          .then((response) => {
            this.userLocation = response.data.client;
            console.log(this.userLocation);
          })
          .catch((error) => {
            console.error('Error fetching user location:', error);
            this.errored = true;
          });
      },
      submitForm() {
        this.submitted = true;
        axios
          .post('/api/tltracker-view', this.TlTracker)
          .then((response) => {
            this.results = response.data.results;
            this.errors = {};
            if (Object.values(this.errors).length === 0) {
              this.buttonAction = true;
            }
          })
          .catch((error) => {
            console.error('Error submitting form:', error.response.data.errors);
            this.errors = error.response.data.errors;
          });
      },
      clearMessage() {
        this.empNameProp = '';
      },
      showSuccess() {
        if (this.empNameProp !== '') {
          Swal.fire({
            position: 'top-center',
            icon: 'success',
            title: 'User ' + this.empNameProp + ' edited successfully',
            showConfirmButton: false,
            timer: 3000,
          });
        }
      },
    },
    mounted() {
      this.userLocationApi();
      this.showSuccess();
      this.clearMessage();
    },
  };
  </script>
