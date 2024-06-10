<template>
  <div>
    <form @submit.prevent="submitForm">
      <table class="input_form">
        <tr>
          <td><label>Select Location</label></td>
          <td>
            <select
              v-model="amSubmission.selectedLocation"
              @blur="checkValidation('selectedLocation')"
              name="location"
            >
              <option value="">Select Location</option>
              <option v-for="item in uniqueLocations" :key="item" :value="item">
                {{ item }}
              </option>
            </select>
            <br />
            <span v-if="errors.selectedLocation" class="error">{{
              errors.selectedLocation[0]
            }}</span>
          </td>
        </tr>
        <tr>
          <td></td>
          <td>
            <button @click="closePopup" class="cancel_btn">Cancel</button>
            <button class="submit_btn">Submit</button>
          </td>
        </tr>
      </table>
    </form>

    <responsive-table v-if="results.length" :data="results" :columns="columns" />
  </div>
</template>

<script>
import axios from "axios";
import { commonFunctionsMixin } from "../../../function.js";
import ResponsiveTable from "../../Shared Folder/ResponsiveTable.vue";

export default {
  name: "AmSubmissionRequest",
  mixins: [commonFunctionsMixin],
  components: {
    ResponsiveTable,
  },
  data() {
    return {
      buttonAction: false,
      amSubmission: {
        selectedLocation: "",
      },
      userLocation: [],
      location: [],
      errors: {},
      results: [],
      columns: [
        { label: "Client Name", key: "client_name" },
        { label: "Client Manager Name", key: "client_manager_name" },
        { label: "Business Unit", key: "business_unit" },
        { label: "Select Location", key: "location" },
        { label: "Edit", key: "edit" },
      ],
      empNameProp: this.empName,
    };
  },
  props: {
    empName: {
      type: String,
      default: "",
    },
  },
  computed: {
    uniqueLocations() {
      return [...new Set(this.userLocation.map((item) => item.location))];
    },
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
    userLocationApi() {
      axios
        .get("/api/submission-approve")
        .then((response) => {
          this.userLocation = response.data.location;
          console.log("Fetched user locations:", this.userLocation); // Log the fetched locations
        })
        .catch((error) => {
          console.error("Error fetching user location:", error);
        });
    },
    submitForm() {
      console.log("Submitting form with data:", this.amSubmission); // Log the form data being submitted
      axios
        .post("/api/submission-approve", this.amSubmission)
        .then((response) => {
          this.results = response.data.results;
          console.log("Submission results:", this.results); // Log the results
          if (Object.values(this.errors).length === 0) {
            this.buttonAction = true;
          }
        })
        .catch((error) => {
          console.error("Error submitting form:", error.response.data.errors);
          this.errors = error.response.data.errors;
        });
    },
  },
  mounted() {
    this.userLocationApi();
  },
  watch: {
    empName(newVal) {
      this.empNameProp = newVal;
    },
    userLocation: {
      handler() {
        this.amSubmission.selectedLocation = ""; // Reset selected location
      },
      deep: true,
    },
  },
};
</script>
