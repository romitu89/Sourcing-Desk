<template>
    <div>
      <form @submit.prevent="submitForm">
        <table class="input_form">
          <tr>
            <td><label>Select Location</label></td>
            <td>
              <select v-model="client.selectedLocation" @change="updateFilteredSubLocations" @blur="checkValidation('selectedLocation')" name="location">
                <option value="">Select Location</option>
                <option v-for="location in uniqueLocations" :key="location" :value="location">{{ location }}</option>
              </select><br>
              <span v-if="errors.selectedLocation" class="error">{{ errors.selectedLocation[0] }}</span>
            </td>
          </tr>
          <tr v-if="client.selectedLocation">
            <td><label>Sub Location</label></td>
            <td>
              <select v-model="client.selectedSubLocation" @blur="checkValidation('selectedSubLocation')" name="subLocation">
                <option value="">Select Sub Location</option>
                <option v-for="subLocation in filteredSubLocations" :key="subLocation" :value="subLocation">{{ subLocation }}</option>
              </select><br>
              <span v-if="errors.selectedSubLocation" class="error">{{ errors.selectedSubLocation[0] }}</span>
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
      <div v-if="results.length">
        <responsive-table :results="results" :columns="columns" :buttonAction="buttonAction">
          <template #edit="{ row }">
            <div>
              <button title="Edit" @click="editItem(row.client_id)">
                <font-awesome-icon :icon="['fas', 'pen-to-square']" />
              </button>
              <button title="Delete" @click="deleteItem(row.client_id)">
                <font-awesome-icon :icon="['fas', 'trash']" />
              </button>
            </div>
          </template>
        </responsive-table>
      </div>
    </div>
  </template>

  <script>
  import { commonFunctionsMixin } from '../../../function.js';
  import ResponsiveTable from '../../Shared Folder/ResponsiveTable.vue';
  import Swal from 'sweetalert2';
  import axios from 'axios';

  export default {
    name: 'ClientViewForm',
    mixins: [commonFunctionsMixin],
    components: { ResponsiveTable },
    data() {
      return {
        buttonAction: false,
        client: {
          selectedSubLocation: '',
          selectedLocation: '',
        },
        locations: [],
        subLocations: [],
        filteredSubLocations: [],
        uniqueLocations: [],
        errors: {},
        results: [],
        columns: [
          { label: 'Client Name', key: 'client_name' },
          { label: 'Business Unit Name', key: 'business_unit_name' },
          { label: 'Sub Location', key: 'sub_location' },
          { label: 'Select Location', key: 'location' },
          { label: 'Client Manager', key: 'client_manager_name' },
          { label: 'Client Manager Email ID', key: 'client_manager_email' },
          { label: 'Edit', key: 'edit' },
        ],
      };
    },
    props: {
      empName: {
        type: String,
        default: '',
      },
    },
    methods: {
      closePopup() {
        this.$emit('closePopup');
      },
      checkValidation(fieldName) {
        if (this.errors[fieldName]) {
          delete this.errors[fieldName];
        }
      },
      updateFilteredSubLocations() {
        this.filteredSubLocations = this.subLocations
          .filter((subLocation) => subLocation.location === this.client.selectedLocation)
          .map((subLocation) => subLocation.sub_location);
        this.client.selectedSubLocation = '';
        this.checkValidation('selectedLocation');
      },
      userLocationApi() {
        axios
          .get('/api/editorclient-view')
          .then((response) => {
            const locationData = response.data.locations;

            // Extract unique locations
            this.uniqueLocations = [...new Set(locationData.map((loc) => loc.location))];

            // Extract sub-locations
            this.subLocations = locationData;
          })
          .catch((error) => {
            console.error('Error fetching locations:', error);
          });
      },
      submitForm() {
        axios
          .post('/api/editorclient-view', this.client)
          .then((response) => {
            this.results = response.data.results;
            this.errors = {};
            if (!Object.values(this.errors).length) {
              this.buttonAction = true;
              this.client = {
                selectedSubLocation: '',
                selectedLocation: '',
              };
            }
          })
          .catch((error) => {
            this.errors = error.response.data.errors;
          });
      },
      editItem(id) {
        this.$emit('updateForm', id);
        console.log(id, 'client view form');
      },
    },
    mounted() {
      this.userLocationApi();

      if (this.empName !== '') {
        Swal.fire({
          position: 'top-center',
          icon: 'success',
          title: `User ${this.empName} edited successfully`,
          showConfirmButton: false,
          timer: 3000,
        });
        this.$emit('editMessageUpdated');
      }
    },
  };
  </script>

  <style scoped>
  /* Your component-specific styles */
  </style>
