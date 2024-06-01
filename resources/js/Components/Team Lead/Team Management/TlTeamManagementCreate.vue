<template>
    <form @submit.prevent="submitForm">
      <table class="input_form">
        <tr>
          <td><label>Select Location</label></td>
          <td>
            <select
              id="location"
              v-model="teamManager.selectedLocation"
              @blur="checkValidation('selectedLocation')"
              name="location"
            >
              <option value="">Select Location</option>
              <option
                v-for="item in getUniqueValues(userLocation, 'location')"
                :key="item"
                :value="item"
              >
                {{ item }}
              </option>
            </select>
            <br />
            <span v-if="errors.selectedLocation" class="error">{{ errors.selectedLocation[0] }}</span>
          </td>
        </tr>

        <!-- Conditional rendering for Client Name based on the selection of Location -->
        <tr v-if="teamManager.selectedLocation">
          <td><label>Client Name</label></td>
          <td>
            <select
              id="name"
              v-model="teamManager.clientName"
              @blur="checkValidation('clientName')"
              name="name"
            >
              <option value="">Select Client</option>
              <option
                v-for="item in getUniqueValues(client, 'client_name')"
                :key="item"
                :value="item"
              >
                {{ item }}
              </option>
            </select>
            <br />
            <span v-if="errors.clientName" class="error">{{ errors.clientName[0] }}</span>
          </td>
        </tr>

        <!-- Conditional rendering for Job Type based on the selection of Client Name -->
        <tr v-if="teamManager.clientName">
          <td><label>Job Type</label></td>
          <td>
            <select
              id="role"
              v-model="teamManager.jobType"
              @blur="checkValidation('jobType')"
              name="role"
            >
              <option value="">Select Job</option>
              <option value="permanent">Permanent</option>
              <option value="contract">Contract</option>
              <option value="both">Both</option>
            </select>
            <br />
            <span v-if="errors.jobType" class="error">{{ errors.jobType[0] }}</span>
          </td>
        </tr>

        <!-- Conditional rendering for Select Team based on the selection of Job Type -->
        <tr v-if="teamManager.jobType">
          <td><label>Select Team</label></td>
          <td>
            <multi-select
              :selectedTeam="teamManager.selectedTeam"
              :options="teams"
              @update:selected="updateSelectedOptions"
              @blur="checkValidation('selectedTeam')"
            >
            </multi-select>
            <span v-if="errors.selectedTeam" class="error">{{ errors.selectedTeam[0] }}</span>
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
  import Swal from 'sweetalert2'
  import MultiSelect from "../../Shared Folder/MultiSelect.vue";
  import { commonFunctionsMixin } from "../../../function.js";

  export default {
    name: "TlTeamManagementCreate",
    mixins: [commonFunctionsMixin],
    components: {
      MultiSelect,
    },
    data() {
      return {
        teamManager: {
          selectedLocation: "",
          jobType: "",
          clientName: "",
          selectedTeam: [],
        },
        errors: {},
        userLocation: [],
        client: [],
        teams: [],
      };
    },
    methods: {
      closePopup() {
        this.$emit("closePopup");
      },
      userLocationApi() {
        axios
          .get("/api/tlteam-create")
          .then((response) => {
            console.log(response.data.location, "response.data.location");
            this.userLocation = response.data.location;
            this.client = response.data.client;
            const teamEmail = response.data.teamEmail; // Corrected variable name to match your initial question
            teamEmail.forEach((tm) => {
              this.teams.push({
                label: tm.email_id, // Display email as the label
                value: tm.email_id, // Use team ID as the value
              });
            });
          })
          .catch((error) => {
            console.log(error);
            this.errored = true;
          });
      },
      updateSelectedOptions(newVal) {
        if (JSON.stringify(newVal) !== JSON.stringify(this.teamManager.selectedTeam)) {
          this.teamManager.selectedTeam = newVal;
        }
      },
      submitForm() {
        this.submitted = true; // Set the submitted flag to true when attempting to submit the form
        // if (this.isFormValid) {
        axios
          .post("/api/tlteam-create", this.teamManager)
          .then((response) => {
            console.log("Form submitted:", response.data.message);
            if (response.data.message) {
              this.errors = {};
              Swal.fire({
                position: "top-center",
                icon: "success",
                title: "Team created successfully",
                showConfirmButton: false,
                timer: 3000,
              });
            } else {
              Swal.fire("Form not Submitted");
            }
            // Handle the response as needed
          })
          .catch((error) => {
            if (error.response) {
              console.error("Error submitting form:", error.response.data.errors);
              this.errors = error.response.data.errors;
              console.log(this.errors, "error");
            }
          });
      },
    },
    mounted() {
      this.userLocationApi();
    },
  };
  </script>
