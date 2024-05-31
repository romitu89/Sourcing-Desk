<template>
    <form @submit.prevent="submitForm">
      <table class="input_form">
        <!-- Subject Line -->
        <tr>
          <td><label>Subject Line</label></td>
          <td>
            <input type="text" v-model="amRequest.subject" @blur="checkValidation('subject')" placeholder="Subject Line" />
            <span v-if="errors.subject" class="error">{{ errors.subject[0] }}</span>
          </td>
        </tr>

        <!-- Request Body -->
        <tr>
          <td><label>Request Body</label></td>
          <td>
            <input type="text" v-model="amRequest.requestBody" @blur="checkValidation('requestBody')" placeholder="Request Body" />
            <span v-if="errors.requestBody" class="error">{{ errors.requestBody[0] }}</span>
          </td>
        </tr>

        <!-- Requirement Name -->
        <tr>
          <td><label>Requirement Name</label></td>
          <td>
            <input type="text" v-model="amRequest.requirement" @blur="checkValidation('requirement')" placeholder="Requirement Name" />
            <span v-if="errors.requirement" class="error">{{ errors.requirement[0] }}</span>
          </td>
        </tr>

        <!-- Job Type -->
        <tr>
          <td><label>Job Type</label></td>
          <td>
            <select id="role" v-model="amRequest.jobType" @blur="checkValidation('jobType')" name="role">
              <option value="">Select Job</option>
              <option value="permanent">Permanent</option>
              <option value="contract">Contract</option>
            </select><br />
            <span v-if="errors.jobType" class="error">{{ errors.jobType[0] }}</span>
          </td>
        </tr>

        <!-- Select Location -->
        <tr v-if="amRequest.jobType">
          <td><label>Select Location</label></td>
          <td>
            <select id="location" v-model="amRequest.selectedLocation" @blur="checkValidation('selectedLocation')" name="location">
              <option value="">Select Location</option>
              <option v-for="location in uniqueLocations" :key="location" :value="location">{{ location }}</option>
            </select><br />
            <span v-if="errors.selectedLocation" class="error">{{ errors.selectedLocation[0] }}</span>
          </td>
        </tr>

        <!-- Client Name -->
        <tr v-if="amRequest.selectedLocation">
          <td><label>Client Name</label></td>
          <td>
            <select id="client" v-model="amRequest.selectedClient" @change="fetchBusinessUnits" @blur="checkValidation('selectedClient')" name="client">
              <option value="">Select Client</option>
              <option v-for="client in uniqueClients" :key="client" :value="client">{{ client }}</option>
            </select><br />
            <span v-if="errors.selectedClient" class="error">{{ errors.selectedClient[0] }}</span>
          </td>
        </tr>

        <!-- Business Unit -->
        <tr v-if="amRequest.selectedClient">
          <td><label>Business Unit</label></td>
          <td>
            <select id="business" v-model="amRequest.selectedBusiness" @change="fetchLocationsAndManagers" @blur="checkValidation('selectedBusiness')" name="business">
              <option value="">Select Unit</option>
              <option v-for="unit in uniqueBusinessUnits" :key="unit" :value="unit">{{ unit }}</option>
            </select><br />
            <span v-if="errors.selectedBusiness" class="error">{{ errors.selectedBusiness[0] }}</span>
          </td>
        </tr>

        <!-- Client Manager Name -->
        <tr v-if="amRequest.selectedBusiness">
          <td><label>Client Manager Name</label></td>
          <td>
            <select id="manager" v-model="amRequest.clientManager" @blur="checkValidation('clientManager')" name="manager">
              <option value="">Select Manager</option>
              <option v-for="manager in uniqueManagers" :key="manager" :value="manager">{{ manager }}</option>
            </select><br />
            <span v-if="errors.clientManager" class="error">{{ errors.clientManager[0] }}</span>
          </td>
        </tr>

        <!-- Select Team -->
        <tr v-if="amRequest.clientManager">
          <td><label>Select Team</label></td>
          <td>
            <multi-select :selectedTeam="amRequest.selectedTeam" :options="teams" @update:selected="updateSelectedOptions" @blur="checkValidation('selectedTeam')"></multi-select>
            <span v-if="errors.selectedTeam" class="error">{{ errors.selectedTeam[0] }}</span>
          </td>
        </tr>

        <!-- Upload File -->
        <tr v-if="amRequest.selectedTeam.length > 0">
          <td><label>Upload File</label></td>
          <td>
            <input type="file" ref="fileInput" @change="handleFileChange" accept=".xls, .xlsx" name="file" placeholder="Upload" /><br />
            <span v-if="errors.file" class="error">{{ errors.file[0] }}</span>
          </td>
        </tr>

        <!-- Buttons -->
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
  import MultiSelect from '../../Shared Folder/MultiSelect.vue';
  import axios from 'axios';

  export default {
    name: 'AmRequestCreation',
    mixins: [commonFunctionsMixin],
    components: {
      MultiSelect,
    },
    data() {
      return {
        amRequest: {
          subject: '',
          requestBody: '',
          requirement: '',
          jobType: '',
          selectedClient: '',
          selectedBusiness: '',
          selectedLocation: '',
          clientManager: '',
          file: null,
          selectedTeam: [],
        },
        client: [],
        teams: [],
        selectedTeam: [],
        errors: {},
      };
    },
    computed: {
      uniqueClients() {
        return [...new Set(this.client.map(item => item.client_name))];
      },
      uniqueBusinessUnits() {
        return [...new Set(this.client.map(item => item.business_unit_name))];
      },
      uniqueLocations() {
        return [...new Set(this.client.map(item => item.location))];
      },
      uniqueManagers() {
        return [...new Set(this.client.map(item => item.client_manager_name))];
      },
    },
    methods: {
      closePopup() {
        this.$emit('closePopup');
      },
      handleFileChange(event) {
        this.amRequest.file = event.target.files[0];
      },
      userLocationApi() {
        axios
          .get('/api/amrequest-create')
          .then(response => {
            console.log(response.data, 'data');
            this.client = response.data.client;
            console.log(this.client, 'client');

            const teamEmail = response.data.teamEmail;

            // Use a Set to filter out duplicates
            const uniqueEmails = new Set();
            teamEmail.forEach(tm => {
              if (!uniqueEmails.has(tm.email)) {
                uniqueEmails.add(tm.email);
                this.teams.push({
                  label: tm.email,
                  value: tm.email,
                });
              }
            });
          })
          .catch(error => {
            console.log(error);
            this.errored = true;
          });
      },
      fetchBusinessUnits() {
        // Logic to fetch business units based on selected client
        this.amRequest.selectedBusiness = '';
        this.amRequest.clientManager = '';
      },
      fetchLocationsAndManagers() {
        // Logic to fetch locations and managers based on selected business unit
        this.amRequest.clientManager = '';
      },
      updateSelectedOptions(newVal) {
        if (JSON.stringify(newVal) !== JSON.stringify(this.amRequest.selectedTeam)) {
          this.amRequest.selectedTeam = newVal;
        }
      },
      submitForm() {
        this.submitted = true;
        axios
          .post('/api/amrequest-create', this.amRequest)
          .then(response => {
            if (response.data.message) {
              this.errors = {};
              Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: 'Request created successfully',
                showConfirmButton: false,
                timer: 3000,
              });
            } else {
              Swal.fire('Form not Submitted');
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
