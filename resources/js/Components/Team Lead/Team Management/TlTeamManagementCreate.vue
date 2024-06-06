<template>
    <form @submit.prevent="submitForm">
      <table class="input_form">
        <!-- Select Location -->
        <tr>
          <td><label>Select Location</label></td>
          <td>
            <select
              id="location"
              v-model="teamManager.selectedLocation"
              @change="fetchClients"
              @blur="checkValidation('selectedLocation')"
              name="location"
            >
              <option value="">Select Location</option>
              <option v-for="item in uniqueLocations" :key="item" :value="item">
                {{ item }}
              </option>
            </select>
            <br />
            <span v-if="errors.selectedLocation" class="error">{{ errors.selectedLocation[0] }}</span>
          </td>
        </tr>

        <!-- Client Name -->
        <tr v-if="teamManager.selectedLocation">
          <td><label>Client Name</label></td>
          <td>
            <select
              id="client"
              v-model="teamManager.clientName"
              @blur="checkValidation('clientName')"
              name="client"
            >
              <option value="">Select Client</option>
              <option v-for="item in uniqueClients" :key="item" :value="item">
                {{ item }}
              </option>
            </select>
            <br />
            <span v-if="errors.clientName" class="error">{{ errors.clientName[0] }}</span>
          </td>
        </tr>

        <!-- Job Type -->
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

        <!-- Select Team -->
        <tr v-if="teamManager.jobType">
          <td><label>Select Team</label></td>
          <td>
            <multi-select
              :selectedTeam="teamManager.selectedTeam"
              :options="teams"
              @update:selected="updateSelectedOptions"
              @blur="checkValidation('selectedTeam')"
            ></multi-select>
            <span v-if="errors.selectedTeam" class="error">{{ errors.selectedTeam[0] }}</span>
          </td>
        </tr>

        <!-- Buttons -->
        <tr>
          <td></td>
          <td>
            <button type="button" @click="closePopup()" class="cancel_btn">Cancel</button>
            <button type="submit" class="submit_btn">Submit</button>
          </td>
        </tr>
      </table>
    </form>
  </template>
  <script>
import Swal from 'sweetalert2'
import MultiSelect from "../../Shared Folder/MultiSelect.vue";
import axios from "axios";
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
      location: [],
    };
  },
  computed: {
    uniqueLocations() {
      return [...new Set(this.location.map((item) => item.location))];
    },
    uniqueClients() {
      return [
        ...new Set(
          this.client
            .filter((item) => item.location === this.teamManager.selectedLocation)
            .map((item) => item.client_name)
        ),
      ];
    },
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
          this.location = response.data.client;
          this.client = response.data.client;
          const teamEmail = response.data.teamEmail;
          teamEmail.forEach((tm) => {
            this.teams.push({
              label: tm.email_id,
              value: tm.email_id,
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
    resetForm() {
      this.teamManager = {
        selectedLocation: "",
        jobType: "",
        clientName: "",
        selectedTeam: [],
      };
      this.errors = {};
    },
    submitForm() {
      this.submitted = true;
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
            }).then(() => {
              this.resetForm();  // Reset form after successful submission
            });
          } else {
            Swal.fire("Form not Submitted");
          }
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
