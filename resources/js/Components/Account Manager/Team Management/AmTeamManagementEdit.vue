<template>
    <form @submit.prevent="submitForm">
      <table class="input_form">
        <tr>
          <td><label>Select Location</label></td>
          <td>
            <select id="location" v-model="teamManager.selectedLocation" @blur="checkValidation('selectedLocation')" name="location">
              <option value="">Select Location</option>
              <option
                v-for="item in userLocation"
                :key="item.location"
                :value="item.location"
              >
                {{ item.location }}
              </option></select
            ><br /><span v-if="errors.selectedLocation" class="error">{{
              errors.selectedLocation[0]
            }}</span>
          </td>
        </tr>

        <tr>
          <td><label>Job Type</label></td>
          <td>
            <select id="role" v-model="teamManager.jobType" @blur="checkValidation('jobType')" name="role">
              <option value="">Select Job</option>
              <option value="permanent">Permanent</option>
              <option value="contract">Contract</option>
              <option value="both">Both</option></select
            ><br /><span v-if="errors.jobType" class="error">{{ errors.jobType[0] }}</span>
          </td>
        </tr>

        <tr>
          <td><label>Select Team</label></td>
          <td>
            <multi-select
              :selectedTeam="teamManager.selectedTeam"
              :options="teams"
              @update:selected="updateSelectedOptions" @blur="checkValidation('selectedTeam')"
            >
            </multi-select>
            <span v-if="errors.selectedTeam" class="error">{{
              errors.selectedTeam[0]
            }}</span>
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
  import MultiSelect from "../../Shared Folder/MultiSelect.vue";

  export default {
    name: "AmTeamManagementEdit",
    mixins:[commonFunctionsMixin],
    props: {
        editId: {
            type: Number,
            default: null,
        },
    },

    components: {
      MultiSelect,
    },

    data() {
      return {
        teamManager: {
          selectedLocation: "",
          jobType: "",
          selectedTeam: [],
        },
        errors: {},
        userLocation: [],
        teams: [],
      };
    },
    methods: {
      closePopup() {
        this.$emit("closePopup");
      },


      userLocationApi() {
        axios
          .get("/api/amteam-create")
          .then((response) => {
            console.log(response.data.location, "response.data.location");
            this.userLocation = response.data.location;

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
          .post("/api/amteam-create", this.teamManager)
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
