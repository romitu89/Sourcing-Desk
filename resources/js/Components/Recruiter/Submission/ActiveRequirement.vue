<template>
  <form @submit.prevent="submitForm">
    <table class="input_form">
      <!-- Subject -->
      <tr>
        <td><label>Subject</label></td>
        <td>
          <input
            type="text"
            v-model="active.subject"
            @blur="checkValidation('subject')"
            placeholder="Subject"
          />
          <span v-if="errors.subject" class="error">{{ errors.subject[0] }}</span>
        </td>
      </tr>

      <!-- Request Number -->
      <tr>
        <td><label>Request Number</label></td>
        <td>
          <input
            type="text"
            v-model="active.requestnum"
            @blur="checkValidation('requestnum')"
            placeholder="Request Number"
          />
          <span v-if="errors.requestnum" class="error">{{ errors.requestnum[0] }}</span>
        </td>
      </tr>

      <!-- Requirement Name -->
      <tr>
        <td><label>Requirement Name</label></td>
        <td>
          <input
            type="text"
            v-model="active.requirename"
            @blur="checkValidation('requirename')"
            placeholder="Requirement Name"
          />
          <span v-if="errors.requirename" class="error">{{ errors.requirename[0] }}</span>
        </td>
      </tr>

      <!-- Work Assigned By -->
      <tr>
        <td><label>Work Assigned By</label></td>
        <td>
          <input
            type="text"
            v-model="active.work"
            @blur="checkValidation('work')"
            placeholder="Work Assigned By"
          />
          <span v-if="errors.work" class="error">{{ errors.work[0] }}</span>
        </td>
      </tr>

      <!-- Client Name -->
      <tr>
        <td><label>Client Name</label></td>
        <td>
          <input
            type="text"
            v-model="active.client"
            @blur="checkValidation('client')"
            placeholder="Client Name"
          />
          <span v-if="errors.client" class="error">{{ errors.client[0] }}</span>
        </td>
      </tr>

      <!-- Client Manager -->
      <tr>
        <td><label>Client Manager</label></td>
        <td>
          <input
            type="text"
            v-model="active.manager"
            @blur="checkValidation('manager')"
            placeholder="Client Manager"
          />
          <span v-if="errors.manager" class="error">{{ errors.manager[0] }}</span>
        </td>
      </tr>

      <!-- Candidate Name -->
      <tr>
        <td><label>Candidate Name</label></td>
        <td>
          <input
            type="text"
            v-model="active.candName"
            @blur="checkValidation('candName')"
            placeholder="Candidate Name"
          />
          <span v-if="errors.candName" class="error">{{ errors.candName[0] }}</span>
        </td>
      </tr>

      <!-- Primary Skills -->
      <tr>
        <td><label>Primary Skills</label></td>
        <td>
          <input
            type="text"
            v-model="active.primary"
            @blur="checkValidation('primary')"
            placeholder="Primary Skills"
          />
          <span v-if="errors.primary" class="error">{{ errors.primary[0] }}</span>
        </td>
      </tr>

      <!-- Secondary Skills -->
      <tr>
        <td><label>Secondary Skills</label></td>
        <td>
          <input
            type="text"
            v-model="active.secondary"
            @blur="checkValidation('secondary')"
            placeholder="Secondary Skills"
          />
          <span v-if="errors.secondary" class="error">{{ errors.secondary[0] }}</span>
        </td>
      </tr>

      <!-- Rate Communication -->
      <tr>
        <td><label>Rate Communication</label></td>
        <td>
          <input
            type="text"
            v-model="active.communication"
            @blur="checkValidation('communication')"
            placeholder="Rate Communication"
          />
          <span v-if="errors.communication" class="error">{{
            errors.communication[0]
          }}</span>
        </td>
      </tr>

      <!-- Rate Technicality -->
      <tr>
        <td><label>Rate Technicality</label></td>
        <td>
          <input
            type="text"
            v-model="active.technical"
            @blur="checkValidation('technical')"
            placeholder="Rate Technicality"
          />
          <span v-if="errors.technical" class="error">{{ errors.technical[0] }}</span>
        </td>
      </tr>

      <!-- Total Experience -->
      <tr>
        <td><label>Total Experience</label></td>
        <td>
          <input
            type="text"
            v-model="active.totexperience"
            @blur="checkValidation('totexperience')"
            placeholder="Total Experience"
          />
          <span v-if="errors.totexperience" class="error">{{
            errors.totexperience[0]
          }}</span>
        </td>
      </tr>

      <!-- Relevant Experience -->
      <tr>
        <td><label>Relevant Experience</label></td>
        <td>
          <input
            type="text"
            v-model="active.relexperience"
            @blur="checkValidation('relexperience')"
            placeholder="Relevant Experience"
          />
          <span v-if="errors.relexperience" class="error">{{
            errors.relexperience[0]
          }}</span>
        </td>
      </tr>

      <!-- Notice Period -->
      <tr>
        <td><label>Notice Period</label></td>
        <td>
          <input
            type="text"
            v-model="active.notice"
            @blur="checkValidation('notice')"
            placeholder="Notice Period"
          />
          <span v-if="errors.notice" class="error">{{ errors.notice[0] }}</span>
        </td>
      </tr>

      <!-- Current CTC -->
      <tr>
        <td><label>Current CTC</label></td>
        <td>
          <input
            type="text"
            v-model="active.currentctc"
            @blur="checkValidation('currentctc')"
            placeholder="Current CTC"
          />
          <span v-if="errors.currentctc" class="error">{{ errors.currentctc[0] }}</span>
        </td>
      </tr>

      <!-- Expected CTC -->
      <tr>
        <td><label>Expected CTC</label></td>
        <td>
          <input
            type="text"
            v-model="active.expectctc"
            @blur="checkValidation('expectctc')"
            placeholder="Expected CTC"
          />
          <span v-if="errors.expectctc" class="error">{{ errors.expectctc[0] }}</span>
        </td>
      </tr>

      <!-- Mobile Number -->
      <tr>
        <td><label>Mobile Number</label></td>
        <td>
          <input
            type="text"
            v-model="active.mobile"
            @blur="checkValidation('mobile')"
            placeholder="Mobile Number"
          />
          <span v-if="errors.mobile" class="error">{{ errors.mobile[0] }}</span>
        </td>
      </tr>

      <!-- Email -->
      <tr>
        <td><label>Email</label></td>
        <td>
          <input
            type="text"
            v-model="active.email"
            @blur="checkValidation('email')"
            placeholder="Email"
          />
          <span v-if="errors.email" class="error">{{ errors.email[0] }}</span>
        </td>
      </tr>

      <!-- Location -->
      <tr>
        <td><label>Location</label></td>
        <td>
          <input
            type="text"
            v-model="active.location"
            @blur="checkValidation('location')"
            placeholder="Location"
          />
          <span v-if="errors.location" class="error">{{ errors.location[0] }}</span>
        </td>
      </tr>

      <!-- Job Location -->
      <tr>
        <td><label>Job Location</label></td>
        <td>
          <input
            type="text"
            v-model="active.joblocation"
            @blur="checkValidation('joblocation')"
            placeholder="Job Location"
          />
          <span v-if="errors.joblocation" class="error">{{ errors.joblocation[0] }}</span>
        </td>
      </tr>

      <!-- Communication -->
      <tr>
        <td><label>Communication</label></td>
        <td>
          <input
            type="text"
            v-model="active.communication"
            @blur="checkValidation('communication')"
            placeholder="Communication"
          />
          <span v-if="errors.communication" class="error">{{
            errors.communication[0]
          }}</span>
        </td>
      </tr>

      <!-- Technical -->
      <tr>
        <td><label>Technical</label></td>
        <td>
          <input
            type="text"
            v-model="active.technical"
            @blur="checkValidation('technical')"
            placeholder="Technical"
          />
          <span v-if="errors.technical" class="error">{{ errors.technical[0] }}</span>
        </td>
      </tr>

      <!-- File Profile -->
      <tr>
        <td><label>File Profile</label></td>
        <td>
          <input
            type="file"
            @change="handleFileChange"
            accept=".pdf,.doc,.docx"
            name="fileProfile"
            placeholder="File Profile"
          />
          <span v-if="errors.fileProfile" class="error">{{ errors.fileProfile[0] }}</span>
        </td>
      </tr>

      <!-- File Vendor -->
      <tr>
        <td><label>File Vendor</label></td>
        <td>
          <input
            type="file"
            @change="handleFileChange"
            accept=".xls,.xlsx"
            name="fileVendor"
            placeholder="File Vendor"
          />
          <span v-if="errors.fileVendor" class="error">{{ errors.fileVendor[0] }}</span>
        </td>
      </tr>

      <!-- File Id Proof -->
      <tr>
        <td><label>File Id Proof</label></td>
        <td>
          <input
            type="file"
            @change="handleFileChange"
            accept=".pdf,.doc,.docx,.jpeg,.jpg,.png"
            name="fileIdProof"
            placeholder="File Id Proof"
          />
          <span v-if="errors.fileIdProof" class="error">{{ errors.fileIdProof[0] }}</span>
        </td>
      </tr>

      <!-- File Email -->
      <tr>
        <td><label>File Email</label></td>
        <td>
          <input
            type="file"
            @change="handleFileChange"
            accept=".pdf,.doc,.docx,.jpeg,.jpg,.png"
            name="fileEmail"
            placeholder="File Email"
          />
          <span v-if="errors.fileEmail" class="error">{{ errors.fileEmail[0] }}</span>
        </td>
      </tr>

      <!-- Buttons -->
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
  name: "ActiveRequirement",
  mixins: [commonFunctionsMixin],
  data() {
    return {
      active: {
        subject: "",
        requestnum: "",
        requirename: "",
        work: "",
        client: "",
        manager: "",
        candName: "",
        primary: "",
        secondary: "",
        communication: "",
        technical: "",
        totexperience: "",
        relexperience: "",
        notice: "",
        currentctc: "",
        expectctc: "",
        mobile: "",
        email: "",
        location: "",
        joblocation: "",
        fileProfile: null,
        fileVendor: null,
        fileIdProof: null,
        fileEmail: null,
      },
      errors: {},
    };
  },
  methods: {
    closePopup() {
      this.$emit("closePopup");
    },
    handleFileChange(event) {
      const fieldName = event.target.name;
      this.active[fieldName] = event.target.files[0];
    },
    getRecruiterSubmission(id) {
        axios
        .get(`/api/submission-inbox/${id}`)
        .then((response) => {
          if (response.data.create) {
            console.log(response.data.create);
          }
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
          console.log(this.errors);
        });
    },
    submitForm() {
      const formData = new FormData();
      for (let key in this.active) {
        formData.append(key, this.active[key]);
      }

    },
    resetForm() {
      for (let key in this.active) {
        if (
          key !== "fileProfile" &&
          key !== "fileVendor" &&
          key !== "fileIdProof" &&
          key !== "fileEmail"
        ) {
          this.active[key] = "";
        } else {
          this.active[key] = null;
        }
      }
      this.errors = {};
    },
  },
  mounted() {
    const id = this.$route.params.id;
    console.log(id, "id");
    this.getRecruiterSubmission(id);
  },
};
</script>
