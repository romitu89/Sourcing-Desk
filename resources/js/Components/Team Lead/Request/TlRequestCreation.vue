<template>
    <form @submit.prevent="submitForm">
      <table class="input_form">
        <!-- Subject Line -->
        <tr>
          <td><label>Subject Line</label></td>
          <td>
            <input
              type="text"
              v-model="TlRequest.subject"
              @blur="checkValidation('subject')"
              placeholder="Subject Line"
            />
            <span v-if="errors.subject" class="error">{{ errors.subject[0] }}</span>
          </td>
        </tr>

        <!-- Request Body -->
        <tr>
          <td><label>Request Body</label></td>
          <td>
            <input
              type="text"
              v-model="TlRequest.requestBody"
              @blur="checkValidation('requestBody')"
              placeholder="Request Body"
            />
            <span v-if="errors.requestBody" class="error">{{ errors.requestBody[0] }}</span>
          </td>
        </tr>

        <!-- Requirement Name -->
        <tr>
          <td><label>Requirement Name</label></td>
          <td>
            <input
              type="text"
              v-model="TlRequest.requirement"
              @blur="checkValidation('requirement')"
              placeholder="Requirement Name"
            />
            <span v-if="errors.requirement" class="error">{{ errors.requirement[0] }}</span>
          </td>
        </tr>

        <!-- Job Type -->
        <tr>
          <td><label>Job Type</label></td>
          <td>
            <select
              id="role"
              v-model="TlRequest.jobType"
              @blur="checkValidation('jobType')"
              name="role"
              @change="handleJobTypeChange"
            >
              <option value="">Select Job</option>
              <option value="permanent">Permanent</option>
              <option value="contract">Contract</option>
            </select>
            <br />
            <span v-if="errors.jobType" class="error">{{ errors.jobType[0] }}</span>
          </td>
        </tr>

        <!-- Select Location -->
        <tr v-if="TlRequest.jobType">
          <td><label>Select Location</label></td>
          <td>
            <select
              id="location"
              v-model="TlRequest.selectedLocation"
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

        <!-- Select Client Name -->
        <tr v-if="TlRequest.selectedLocation">
          <td><label>Client Name</label></td>
          <td>
            <select
              id="client"
              v-model="TlRequest.selectedClient"
              @change="fetchBusinessUnits"
              @blur="checkValidation('selectedClient')"
              name="client"
            >
              <option value="">Select Client</option>
              <option v-for="item in uniqueClients" :key="item" :value="item">
                {{ item }}
              </option>
            </select>
            <br />
            <span v-if="errors.selectedClient" class="error">{{ errors.selectedClient[0] }}</span>
          </td>
        </tr>

        <!-- Business Unit -->
        <tr v-if="TlRequest.selectedClient">
          <td><label>Business Unit</label></td>
          <td>
            <select
              id="business"
              v-model="TlRequest.selectedBusiness"
              @change="fetchClientManagerName"
              @blur="checkValidation('selectedBusiness')"
              name="business"
            >
              <option value="">Select Unit</option>
              <option v-for="item in uniqueBusinessUnits" :key="item" :value="item">
                {{ item }}
              </option>
            </select>
            <br />
            <span v-if="errors.selectedBusiness" class="error">{{ errors.selectedBusiness[0] }}</span>
          </td>
        </tr>

        <!-- Client Manager Name -->
        <tr v-if="TlRequest.selectedBusiness">
          <td><label>Client Manager Name</label></td>
          <td>
            <select
              v-model="TlRequest.clientManager"
              @blur="checkValidation('clientManager')"
              name="manager"
            >
              <option value="">Select Manager</option>
              <option v-for="manager in uniqueManagers" :key="manager" :value="manager">
                {{ manager }}
              </option>
            </select>
            <br />
            <span v-if="errors.clientManager" class="error">{{ errors.clientManager[0] }}</span>
          </td>
        </tr>

        <!-- Select Team -->
        <tr v-if="TlRequest.clientManager">
          <td><label>Select Team</label></td>
          <td>
            <multi-select
              :selectedTeam="selectedTeam"
              :options="teams"
              @update:selected="updateSelectedOptions"
              @blur="checkValidation('selectedTeam')"
            ></multi-select>
            <span v-if="errors.selectedTeam" class="error">{{ errors.selectedTeam[0] }}</span>
          </td>
        </tr>

        <!-- Upload File -->
        <tr v-if="TlRequest.selectedTeam.length > 0">
          <td><label>Upload File</label></td>
          <td>
            <input
              type="file"
              ref="file"
              @change="handleFileChange"
              accept=".xls, .xlsx"
              name="file"
              placeholder="Upload"
            /><br />
            <span v-if="errors.file" class="error">{{ errors.file[0] }}</span>
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
import Swal from "sweetalert2";
import MultiSelect from "../../Shared Folder/MultiSelect.vue";
import axios from "axios";
import { commonFunctionsMixin } from "../../../function.js";

export default {
  name: "TlRequestCreation",
  mixins: [commonFunctionsMixin],
  components: {
    MultiSelect,
  },
  data() {
    return {
      TlRequest: {
        subject: "",
        requestBody: "",
        requirement: "",
        jobType: "",
        selectedLocation: "",
        selectedClient: "",
        selectedBusiness: "",
        clientManager: "",
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
    uniqueLocations() {
      return [...new Set(this.client.map((item) => item.location))];
    },
    uniqueClients() {
      return [
        ...new Set(
          this.client
            .filter((item) => item.location === this.TlRequest.selectedLocation)
            .map((item) => item.client_name)
        ),
      ];
    },
    uniqueBusinessUnits() {
      return [
        ...new Set(
          this.client
            .filter((item) => item.client_name === this.TlRequest.selectedClient)
            .map((item) => item.business_unit_name)
        ),
      ];
    },
    uniqueManagers() {
      return [
        ...new Set(
          this.client
            .filter((item) => item.business_unit_name === this.TlRequest.selectedBusiness)
            .map((item) => item.client_manager_name)
        ),
      ];
    },
  },
  methods: {
    closePopup() {
      this.$emit("closePopup");
    },
    handleFileChange() {
      this.TlRequest.file = this.$refs.file.files[0];
    },
    userLocationApi() {
      axios
        .get("/api/tlrequest-create")
        .then((response) => {
          this.client = response.data.client;
          const teamEmail = response.data.teamEmail;
          const uniqueEmails = new Set();
          teamEmail.forEach((tm) => {
            if (!uniqueEmails.has(tm.email)) {
              uniqueEmails.add(tm.email);
              this.teams.push({
                label: tm.email,
                value: tm.email,
              });
            }
          });
        })
        .catch((error) => {
          console.log(error);
          this.errored = true;
        });
    },
    resetForm() {
      this.TlRequest = {
        subject: "",
        requestBody: "",
        requirement: "",
        jobType: "",
        selectedLocation: "",
        selectedClient: "",
        selectedBusiness: "",
        clientManager: "",
        file: null,
        selectedTeam: [],
      };
      this.$refs.file.value = null;  // Reset the file input
      this.errors = {};
    },
    fetchClients() {
      this.TlRequest.selectedClient = "";
      this.TlRequest.selectedBusiness = "";
      this.TlRequest.clientManager = "";
    },
    fetchBusinessUnits() {
      this.TlRequest.selectedBusiness = "";
      this.TlRequest.clientManager = "";
    },
    fetchClientManagerName() {
      this.TlRequest.clientManager = "";
    },
    updateSelectedOptions(newVal) {
      if (JSON.stringify(newVal) !== JSON.stringify(this.TlRequest.selectedTeam)) {
        this.TlRequest.selectedTeam = newVal;
      }
    },
    submitForm() {
      this.submitted = true;
      axios
        .post("/api/tlrequest-create", this.TlRequest, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
          if (response.data.message) {
            this.errors = {};
            Swal.fire({
              position: "top-center",
              icon: "success",
              title: "Request created successfully",
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
          this.errors = error.response.data.errors;
        });
    },
  },
  mounted() {
    this.userLocationApi();
  },
};
</script>
