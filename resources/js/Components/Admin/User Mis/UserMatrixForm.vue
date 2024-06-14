<template>
    <form @submit.prevent="submitForm">
        <table class="input_form">
            <tr>
                <td><label>Employee Name</label></td>
                <td>
                    <select id="employee" v-model="client.employeeName" @change="handleFieldChange('employeeName')" @blur="checkValidation('employeeName')" name="employee">
                        <option value="">Select Employee</option>
                        <option v-for="item in uniqueEmployeeNames" :key="item" :value="item">{{ item }}</option>
                    </select>
                    <br />
                    <span v-if="errors.employeeName" class="error">{{ errors.employeeName[0] }}</span>
                </td>
            </tr>
            <tr v-if="client.employeeName">
                <td><label>Employee Email Id</label></td>
                <td>
                    <select id="email" v-model.trim="client.employeeEmail" @change="handleFieldChange('employeeEmail')" @blur="checkValidation('employeeEmail')" name="Choose Client">
                        <option value="">Select Email</option>
                        <option v-for="item in filteredEmails" :key="item.email_id" :value="item.email_id">{{ item.email_id }}</option>
                    </select>
                    <br />
                    <span v-if="errors.employeeEmail" class="error">{{ errors.employeeEmail[0] }}</span>
                </td>
            </tr>
            <tr v-if="client.employeeEmail">
                <td><label>Select Matrix</label></td>
                <td>
                    <select id="matrix" v-model="client.selectedMatrix" @change="handleFieldChange('selectedMatrix')" @blur="checkValidation('selectedMatrix')" name="matrix">
                        <option value="">Select Matrix</option>
                        <option value="Selections-Skill">Selections-Skill</option>
                        <option value="Rejections-Skill">Rejections-Skill</option>
                    </select>
                    <br />
                    <span v-if="errors.selectedMatrix" class="error">{{ errors.selectedMatrix[0] }}</span>
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
import Swal from 'sweetalert2';
import axios from 'axios';

export default {
    name: 'UserMatrixForm',
    mixins: [commonFunctionsMixin],
    data() {
        return {
            client: {
                employeeName: "",
                employeeEmail: "",
                selectedMatrix: "",
            },
            submitted: false,
            userData: [],
            filteredEmails: [],
            errors: {},
        };
    },
    computed: {
        uniqueEmployeeNames() {
            const employeeNames = this.userData.map(item => item.employee_name);
            return [...new Set(employeeNames)];
        },
    },
    watch: {
        'client.employeeName'() {
            this.resetDependentFields('employeeName');
            this.filterEmailData();
        },
        'client.employeeEmail'() {
            this.resetDependentFields('employeeEmail');
        },
        'client.selectedMatrix'() {
            this.resetDependentFields('selectedMatrix');
        },
    },
    methods: {
        closePopup() {
            this.$emit("closePopup");
        },
        userLocationApi() {
            axios
                .get("/api/adminuserMis-userMatrix")
                .then((response) => {
                    this.userData = response.data.User;
                    console.log(this.userData, "userData");
                })
                .catch((error) => {
                    console.log(error);
                    this.errored = true;
                });
        },
        filterEmailData() {
            this.filteredEmails = this.userData.filter(
                item => item.employee_name === this.client.employeeName
            );
        },
        submitForm() {
            this.submitted = true;
            axios
                .post("/api/adminuserMis-userMatrix", this.client)
                .then((response) => {
                    this.errors = {};

                    console.log("Form submitted:", response.data.results);
                    if (Object.values(this.errors).length === 0) {
                        this.buttonAction = true;
                    }
                    this.results = response.data.results;
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
        resetDependentFields(level) {
            const resetMap = {
                employeeName: ['employeeEmail', 'selectedMatrix'],
                employeeEmail: ['selectedMatrix'],
                selectedMatrix: [],
            };
            resetMap[level].forEach(field => {
                this.client[field] = "";
            });
            this.errors = {};
        },
        handleFieldChange(level) {
            this.resetDependentFields(level);
        }
    },
    mounted() {
        this.userLocationApi();
    },
};
</script>
