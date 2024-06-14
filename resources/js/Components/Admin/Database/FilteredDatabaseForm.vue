<template>
    <form @submit.prevent="submitForm">
      <table class="input_form">

        <!-- Select Country Field -->
        <tr>
          <td><label>Select Country</label></td>
          <td>
            <select
              id="location"
              v-model="client.selectedLocation"
              @change="handleCountryChange"
              @blur="checkValidation('selectedLocation')"
              name="Choose location"
            >
              <option value="">Select Country</option>
              <option
                v-for="item in userData"
                :key="item.country"
                :value="item.country"
              >
                {{ item.country }}
              </option>
            </select>
            <br />
            <span v-if="errors.selectedLocation" class="error">{{ errors.selectedLocation[0] }}</span>
          </td>
        </tr>

        <!-- Select Duration Field (Conditional Rendering) -->
        <tr v-if="client.selectedLocation">
          <td><label>Select Duration</label></td>
          <td>
            <select
              id="duration"
              v-model="client.SelectedDuration"
              @blur="checkValidation('SelectedDuration')"
              name="Choose duration"
            >
              <option value="">Select Duration</option>
              <option value="7">7 Days</option>
              <option value="15">15 Days</option>
              <option value="3">3 Months</option>
              <option value="6">6 Months</option>
              <option value="One">One Year</option>
              <option value="All">All</option>
            </select>
            <br />
            <span v-if="errors.SelectedDuration" class="error">{{ errors.SelectedDuration[0] }}</span>
          </td>
        </tr>

        <!-- Form Buttons -->
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
  import Swal from 'sweetalert2';
  import axios from 'axios';
  import { commonFunctionsMixin } from '../../../function.js';

  export default {
    name: 'FilteredDatabaseForm',
    mixins: [commonFunctionsMixin],
    data() {
      return {
        client: {
          selectedLocation: "",
          SelectedDuration: "",
        },
        submitted: false,
        userData: [],
        errors: {},
      };
    },
    methods: {
      closePopup() {
        this.$emit("closePopup");
      },
      userLocationApi() {
        axios
          .get("/api/adminDatabase-filteredData")
          .then((response) => {
            this.userData = response.data.location;
            console.log(this.userData, "userData");
          })
          .catch((error) => {
            console.log(error);
            this.errored = true;
          });
      },
      submitForm() {
        this.submitted = true;
        axios
          .post("/api/adminDatabase-filteredData", this.client)
          .then((response) => {
            this.errors = {};
            console.log("Form submitted:", response.data.results);
            if (Object.values(this.errors).length === 0) {
              this.buttonAction = true;
            }
            this.results = response.data.results;
            // Handle the response as needed
          })
          .catch((error) => {
            console.error("Error submitting form:", error.response.data.errors);
            this.errors = error.response.data.errors;
          });
      },
      checkValidation(fieldName) {
        if (this.errors.hasOwnProperty(fieldName)) {
          delete this.errors[fieldName];
        }
      },
      handleCountryChange() {
        // Reset fields when country changes
        this.client.SelectedDuration = "";
        this.errors = {};
      },
    },
    mounted() {
      this.userLocationApi();
    },
  };
  </script>
