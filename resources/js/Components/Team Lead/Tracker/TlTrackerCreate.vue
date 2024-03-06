<template>
    <form @submit.prevent="submitForm">
      <table class="input_form">

        <tr>
          <td><label>Client Name</label></td>
          <td>
            <select id="client" v-model="tlTracker.selectedClient" name="client">
              <option value="">Select Client</option>
              <option v-for="item in userLocation" :key='item.client_name' :value="item.client_name">{{ item.client_name }}</option>
            </select>
            <span v-if="errors.selectedClient" class="error">{{errors.selectedClient[0]}}</span>
          </td>
        </tr>

        <tr>
          <td><label>Client Manager Name</label></td>
          <td>
            <select id="clientManager" v-model="tlTracker.clientManagerName" name="clientManager">
              <option value="">Select Manager</option>
              <option v-for="item in userLocation" :key='item.client_manager_name' :value="item.client_manager_name">{{ item.client_manager_name }}</option>
            </select>
            <span v-if="errors.clientManagerName" class="error">{{errors.clientManagerName[0]}}</span>
          </td>
        </tr>

        <tr>
          <td><label>Business Unit</label></td>
          <td>
            <select id="businessUnit" v-model="tlTracker.selectedBusiness" name="businessUnit">
              <option value="">Select Unit</option>
              <option v-for="item in userLocation" :key='item.business_unit_name' :value="item.business_unit_name">{{ item.business_unit_name }}</option>
            </select>
            <span v-if="errors.selectedBusiness" class="error">{{errors.selectedBusiness[0]}}</span>
          </td>
        </tr>

        <tr>
          <td><label>Select Location</label></td>
          <td>
            <select id="location" v-model="tlTracker.selectedLocation" name="location">
              <option value="">Select Location</option>
              <option v-for="item in userLocation" :key='item.location' :value="item.location">{{ item.location }}</option>
            </select>
            <span v-if="errors.selectedLocation" class="error">{{errors.selectedLocation[0]}}</span>
          </td>
        </tr>

        <tr>
          <td><label>Upload File</label></td>
          <td>
            <input type="file" @change="handleFileChange" accept=".xls, .xlsx" name="file" placeholder="Upload" />
            <span v-if="errors.file" class="error">{{errors.file[0]}}</span>
          </td>
        </tr>

        <tr>
          <td></td>
          <td>
            <button class="cancel_btn">Cancel</button>
            <button class="submit_btn">Submit</button>
          </td>
        </tr>

      </table>
    </form>
  </template>

  <script>
  import Swal from "sweetalert2";

  export default {
    name: 'TlTrackerCreate',

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
        tlTrackerData: [],
        errors: [],
      };
    },

    methods: {
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
        this.submitted = true;
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
