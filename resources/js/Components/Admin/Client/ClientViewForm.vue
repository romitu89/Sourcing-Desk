<template>
    <div>
      <form @submit.prevent="submitForm">
        <table class="input_form">
          <tr>
            <td><label>Select Location</label></td>
            <td>
              <select v-model="client.selectedLocation" name="location">
                <option value="">Select Location</option>
                <option v-for="location in locations" :key="location" :value="location">{{ location }}</option>
              </select>
              <span v-if="errors.selectedLocation" class="error">{{ errors.selectedLocation[0] }}</span>
            </td>
          </tr>
          <tr>
            <td><label>Sub Location</label></td>
            <td>
              <select v-model="client.selectedSubLocation" name="subLocation">
                <option value="">Select Sub Location</option>
                <option v-for="subLocation in subLocations" :key="subLocation" :value="subLocation">{{ subLocation }}</option>
              </select>
              <span v-if="errors.selectedSubLocation" class="error">{{ errors.selectedSubLocation[0] }}</span>
            </td>
          </tr>
          <tr>
            <td></td>
            <td>
              <button class="submit_btn">Submit</button>
            </td>
          </tr>
        </table>
      </form>
      <div v-if="results">
        <responsive-table :results="results" :columns="columns"></responsive-table>
      </div>
    </div>
  </template>

  <script>
  import ResponsiveTable from '../../Shared Folder/ResponsiveTable.vue'
  import Swal from 'sweetalert2'
  import axios from 'axios'

  export default {
    name: 'ClientViewForm',
    components: { ResponsiveTable },
    data() {
      return {
        client: {
          selectedSubLocation: '',
          selectedLocation: '',
        },
        locations: [],
        subLocations: [],
        errors: {},
        results: [],
        columns: [
          { label: 'Client Name', key: 'client_name' },
          { label: 'Business Unit Name', key: 'business_unit_name' },
          { label: 'Sub Location', key: 'sub_location' },
          { label: 'Select Location', key: 'location' },
          { label: 'Account Manager', key: 'account_manager' },
          { label: 'Edit', key: 'edit' }
        ]
      };
    },
    methods: {
      userLocationApi() {
        axios.get('/api/adminclient-view')
    .then(response => {
      this.locations = response.data.locations
        .filter(location => location.location) // Filter out blank or null locations
        .map(location => location.location);

      this.subLocations = response.data.subLocations
        .filter(subLocation => subLocation.sub_location) // Filter out blank or null sub-locations
        .map(subLocation => subLocation.sub_location);
    })
      },
      submitForm() {
        axios.post('/api/adminclient-view', this.client)
          .then(response => {
            this.results = response.data.results;
            this.errors = {};
            Swal.fire({
              position: 'top-center',
              icon: 'success',
              title: 'Form submitted successfully',
              showConfirmButton: false,
              timer: 3000
            });
          })
          .catch(error => {
            console.error('Error submitting form:', error);
            this.errors = error.response.data.errors;
            Swal.fire('Form not submitted', '', 'error');
          });
      }
    },
    mounted() {
      this.userLocationApi();
    }
  }
  </script>
