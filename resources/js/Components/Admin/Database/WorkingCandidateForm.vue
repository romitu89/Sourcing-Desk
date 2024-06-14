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
              @change="showFromDateField"
              @blur="checkValidation('selectedLocation')"
              name="Choose Location"
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

        <!-- From Date Field -->
        <tr v-if="client.selectedLocation">
          <td><label>From Date</label></td>
          <td>
            <input
              v-model.trim="client.fromDate"
              @blur="checkValidation('fromDate')"
              type="date"
            />
            <span v-if="errors.fromDate" class="error">{{ errors.fromDate[0] }}</span>
          </td>
        </tr>

        <!-- To Date Field -->
        <tr v-if="client.fromDate">
          <td><label>To Date</label></td>
          <td>
            <input
              v-model.trim="client.toDate"
              @blur="checkValidation('toDate')"
              type="date"
            />
            <span v-if="errors.toDate" class="error">{{ errors.toDate[0] }}</span>
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

  export default {
    name: 'WorkingCandidateForm',

    data() {
      return {
        client: {
          selectedLocation: "",
          fromDate: "",
          toDate: "",
        },
        submitted: false,
        userData: [],
        errors: {},
        showFromDate: false,
        showToDate: false,
      };
    },

    methods: {
      closePopup() {
        this.$emit("closePopup");
      },

      userLocationApi() {
        axios
          .get("/api/adminDatabase-workingcandidate")
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
          .post("/api/adminDatabase-workingcandidate", this.client)
          .then((response) => {
            this.errors = {};

            console.log("Form submitted:", response.data.results);
            if (Object.values(this.errors).length === 0) {
              this.buttonAction = true;
            }
            this.results = response.data.results;

            // Handle the response as needed
            Swal.fire({
              position: "top-center",
              icon: "success",
              title: "Form submitted successfully",
              showConfirmButton: false,
              timer: 3000,
            });
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

      showFromDateField() {
        this.showFromDate = true;
      },

      showToDateField() {
        this.showToDate = true;
      },
    },

    mounted() {
      this.userLocationApi();
    },
  };
  </script>
