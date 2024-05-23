<template>
    <form @submit.prevent="submitForm">
      <table class="input_form">

        <tr>
          <td><label>Client Name</label></td>
          <td>
            <select id="client" v-model="tlTracker.selectedClient" @blur="checkValidation('selectedClient')" name="client">
              <option value="">Select Client</option>
              <option v-for="item in uniqueClients" :key="item" :value="item">{{ item }}</option>
            </select><br>
            <span v-if="errors.selectedClient" class="error">{{errors.selectedClient[0]}}</span>
          </td>
        </tr>

        <tr>
          <td><label>Client Manager Name</label></td>
          <td>
            <select id="clientManager" v-model="tlTracker.clientManagerName" @blur="checkValidation('clientManagerName')" name="clientManager">
              <option value="">Select Manager</option>
              <option v-for="item in uniqueManagers" :key="item" :value="item">{{ item }}</option>
            </select><br>
            <span v-if="errors.clientManagerName" class="error">{{errors.clientManagerName[0]}}</span>
          </td>
        </tr>

        <tr>
          <td><label>Business Unit</label></td>
          <td>
            <select id="businessUnit" v-model="tlTracker.selectedBusiness" @blur="checkValidation('selectedBusiness')" name="businessUnit">
              <option value="">Select Unit</option>
              <option v-for="item in uniqueBusinessUnits" :key="item" :value="item">{{ item }}</option>
            </select><br>
            <span v-if="errors.selectedBusiness" class="error">{{errors.selectedBusiness[0]}}</span>
          </td>
        </tr>

        <tr>
          <td><label>Select Location</label></td>
          <td>
            <select id="location" v-model="tlTracker.selectedLocation" @blur="checkValidation('selectedLocation')" name="location">
              <option value="">Select Location</option>
              <option v-for="item in uniqueLocations" :key="item" :value="item">{{ item }}</option>
            </select><br>
            <span v-if="errors.selectedLocation" class="error">{{errors.selectedLocation[0]}}</span>
          </td>
        </tr>

        <tr>
          <td><label>Upload File</label></td>
          <td>
            <input type="file" @change="handleFileChange" accept=".xls, .xlsx" name="file" placeholder="Upload" @blur="checkValidation('file')" /><br>
            <span v-if="errors.file" class="error">{{errors.file[0]}}</span>
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
  import Swal from "sweetalert2";
  import axios from 'axios';

  export default {
    name: 'TlTrackerCreate',
    mixins: [commonFunctionsMixin],
    data() {
      return {
        tlTracker: {
          selectedClient: "",
          clientManagerName: "",
          file: null,
          selectedBusiness: "",
          selectedLocation: "",
        },
        userLocation: [],
        errors: [],
      };
    },
    computed: {
      uniqueClients() {
        const clients = this.userLocation.map(item => item.client_name);
        return [...new Set(clients)];
      },
      uniqueManagers() {
        const managers = this.userLocation.map(item => item.client_manager_name);
        return [...new Set(managers)];
      },
      uniqueBusinessUnits() {
        const units = this.userLocation.map(item => item.business_unit_name);
        return [...new Set(units)];
      },
      uniqueLocations() {
        const locations = this.userLocation.map(item => item.location);
        return [...new Set(locations)];
      }
    },
    methods: {
      closePopup() {
        this.$emit("closePopup");
      },
      checkValidation(fieldName) {
        if (this.errors.hasOwnProperty(fieldName)) {
          delete this.errors[fieldName];
        }
      },
      handleFileChange(event) {
        this.tlTracker.file = event.target.files[0];
      },
      userLocationApi() {
        axios
          .get("/api/tltracker-create")
          .then((response) => {
            console.log(response.data, "data");

            this.userLocation = response.data.client;
            console.log(this.userLocation, "client");
          })
          .catch((error) => {
            console.log(error);
            this.errored = true;
          });
      },
      submitForm() {
        let formData = new FormData();
        formData.append('selectedClient', this.tlTracker.selectedClient);
        formData.append('clientManagerName', this.tlTracker.clientManagerName);
        formData.append('selectedBusiness', this.tlTracker.selectedBusiness);
        formData.append('selectedLocation', this.tlTracker.selectedLocation);
        formData.append('file', this.tlTracker.file);

        axios
          .post("/api/tltracker-create", formData)
          .then((response) => {
            console.log("Form submitted:", response.data.message);
            if (response.data.message) {
              this.errors = {};

              Swal.fire({
                position: "top-center",
                icon: "success",
                title: "User created successfully",
                showConfirmButton: false,
                timer: 5000,
              });
            } else {
              Swal.fire("Form not Submitted");
            }
          })
          .catch((error) => {
            this.errors = error.response.data.errors;
          });
      },
    },
    mounted() {
      this.userLocationApi();
    },
  };
  </script>
