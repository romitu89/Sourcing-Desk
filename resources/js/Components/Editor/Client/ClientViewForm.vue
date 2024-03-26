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
              </select><br>
              <span v-if="errors.selectedLocation" class="error">{{ errors.selectedLocation[0] }}</span>
            </td>
          </tr>
          <tr>
            <td><label>Sub Location</label></td>
            <td>
              <select v-model="client.selectedSubLocation" name="subLocation">
                <option value="">Select Sub Location</option>
                <option v-for="subLocation in subLocations" :key="subLocation" :value="subLocation">{{ subLocation }}</option>
              </select><br>
              <span v-if="errors.selectedSubLocation" class="error">{{ errors.selectedSubLocation[0] }}</span>
            </td>
          </tr>
          <tr>
        <td></td>
       <td> <button @click="closePopup()" class="cancel_btn">Cancel</button>
        <button class="submit_btn">Submit</button> </td>
    </tr>
        </table>
      </form>
      <div v-if="results">
        <responsive-table :results="results" :columns="columns" :buttonAction="buttonAction"></responsive-table>
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
        buttonAction: false,
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
          { label: 'Client Manager', key: 'client_manager_name' },
          { label: 'Client Email ID', key: 'client_manager_email' },
          { label: 'Edit', key: 'edit' }
        ]
      };
    },
    methods: {
        closePopup() {
      this.$emit("closePopup");
    },
      userLocationApi() {
        axios.get('/api/editorclient-view')
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
        axios.post('/api/editorclient-view', this.client)
          .then(response => {
            this.results = response.data.results;
            this.errors = {};
            if (Object.values(this.errors).length == 0) {
            this.buttonAction = true;
          }
          this.results = response.data.results;

          })
          .catch(error => {
            console.error('Error submitting form:', error);
            this.errors = error.response.data.errors;

          });
      }
    },
    mounted() {
      this.userLocationApi();
    }
  }
  </script>
