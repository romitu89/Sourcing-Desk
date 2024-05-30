<template>
  <form @submit.prevent="submitForm">
    <table class="input_form">
      <tr>
        <td><label>Select Location</label></td>
        <td>
          <select
            id="location"
            v-model="tracker.selectedLocation"
            @change="fetchClients"
            @blur="checkValidation('selectedLocation')"
            name="location"
          >
            <option value="">Select Location</option>
            <option v-for="item in uniqueLocations" :key="item" :value="item">
              {{ item }}
            </option></select
          ><br />
          <span v-if="errors.selectedLocation" class="error">{{
            errors.selectedLocation[0]
          }}</span>
        </td>
      </tr>

      <tr v-if="tracker.selectedLocation">
        <td><label>Client Name</label></td>
        <td>
          <select
            id="client"
            v-model="tracker.selectedClient"
            @change="fetchBusinessUnits"
            @blur="checkValidation('selectedClient')"
            name="client"
          >
            <option value="">Select Client</option>
            <option v-for="item in uniqueClients" :key="item" :value="item">
              {{ item }}
            </option></select
          ><br />
          <span v-if="errors.selectedClient" class="error">{{
            errors.selectedClient[0]
          }}</span>
        </td>
      </tr>

      <tr v-if="tracker.selectedClient">
        <td><label>Business Unit</label></td>
        <td>
          <select
            id="business"
            v-model="tracker.selectedBusiness"
            @blur="checkValidation('selectedBusiness')"
            name="business"
          >
            <option value="">Select Unit</option>
            <option v-for="item in uniqueBusinessUnits" :key="item" :value="item">
              {{ item }}
            </option></select
          ><br />
          <span v-if="errors.selectedBusiness" class="error">{{
            errors.selectedBusiness[0]
          }}</span>
        </td>
      </tr>

      <tr v-if="tracker.selectedClient">
        <td><label>Client Manager Name</label></td>
        <td>
          <input
            type="text"
            v-model="tracker.clientManagerName"
            @blur="checkValidation('clientManagerName')"
            placeholder="Client Manager Name"
          /><br />
          <span v-if="errors.clientManagerName" class="error">{{
            errors.clientManagerName[0]
          }}</span>
        </td>
      </tr>

      <tr>
        <td><label>Upload File</label></td>
        <td>
          <input
            type="file"
            @change="handleFileChange"
            accept=".xls, .xlsx"
            name="file"
            placeholder="Upload"
            @blur="checkValidation('file')"
          /><br />
          <span v-if="errors.file" class="error">{{ errors.file[0] }}</span>
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
</template>

<script>
import { commonFunctionsMixin } from "../../../function.js";
import Swal from "sweetalert2";
import axios from "axios";

export default {
  name: "AmTrackerCreate",
  mixins: [commonFunctionsMixin],
  data() {
    return {
      tracker: {
        selectedClient: "",
        clientManagerName: "",
        selectedBusiness: "",
        selectedLocation: "",
        file: null,
      },
      submitted: false,
      clientData: [],
      errors: {},
    };
  },
  computed: {
    uniqueLocations() {
      return [...new Set(this.clientData.map((item) => item.location))];
    },
    uniqueClients() {
      return [
        ...new Set(
          this.clientData
            .filter((item) => item.location === this.tracker.selectedLocation)
            .map((item) => item.client_name)
        ),
      ];
    },
    uniqueBusinessUnits() {
      return [
        ...new Set(
          this.clientData
            .filter((item) => item.client_name === this.tracker.selectedClient)
            .map((item) => item.business_unit_name)
        ),
      ];
    },
  },
  methods: {
    closePopup() {
      this.$emit("closePopup");
    },
    handleFileChange(event) {
      this.tracker.file = event.target.files[0];
    },
    userLocationApi() {
      axios
        .get("/api/amtracker-create")
        .then((response) => {
          this.clientData = response.data.client;
          console.log(this.clientData, "client");
        })
        .catch((error) => {
          console.log(error);
          this.errored = true;
        });
    },
    resetForm() {
      this.tracker.selectedClient = "";
      this.tracker.clientManagerName = "";
      this.tracker.selectedBusiness = "";
      this.tracker.selectedLocation = "";
      this.tracker.file = null;
    },
    checkValidation(fieldName) {
      if (this.errors.hasOwnProperty(fieldName)) {
        delete this.errors[fieldName];
      }
    },
    fetchClients() {
      this.tracker.selectedClient = "";
      this.tracker.selectedBusiness = "";
      this.tracker.clientManagerName = "";
    },
    fetchBusinessUnits() {
      this.tracker.selectedBusiness = "";
    },
    submitForm() {
      this.submitted = true; // Set the submitted flag to true when attempting to submit the form
      let formData = new FormData();
      formData.append("selectedClient", this.tracker.selectedClient);
      formData.append("clientManagerName", this.tracker.clientManagerName);
      formData.append("selectedBusiness", this.tracker.selectedBusiness);
      formData.append("selectedLocation", this.tracker.selectedLocation);
      formData.append("file", this.tracker.file);

      axios
        .post("/api/amtracker-create", formData)
        .then((response) => {
          console.log("Form submitted:", response.data.message);
          if (response.data.message) {
            this.errors = {};

            Swal.fire({
              position: "top-center",
              icon: "success",
              title: "Tracker created successfully",
              showConfirmButton: false,
              timer: 3000,
            });
            this.resetForm();
          } else {
            Swal.fire("Form not Submitted");
          }

          // Handle the response as needed
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });

      // You might want to reset the form and submitted flag here if needed
    },
  },
  mounted() {
    this.userLocationApi();
  },
};
</script>
