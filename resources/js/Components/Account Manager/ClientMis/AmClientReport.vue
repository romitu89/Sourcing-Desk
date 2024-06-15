<template>
    <form @submit.prevent="submitForm">
        <table class="input_form">
            <tr>
                <td><label>Select Location</label></td>
                <td>
                    <select id="location" v-model.trim="client.location" class="color_cell" @change="filterClientData" name="location">
                        <option value="">Choose Location</option>
                        <option v-for="item in uniqueLocations" :key="item" :value="item">{{ item }}</option>
                    </select>
                    <span v-if="submitted && !validation.location" class="error">Location is required.</span>
                </td>
            </tr>

            <tr v-if="client.location">
                <td><label>Client Name</label></td>
                <td>
                    <select id="client" v-model.trim="client.name" class="color_cell" @change="filterBusinessUnits" name="client">
                        <option value="">Choose Client</option>
                        <option v-for="item in filteredClients" :key="item.client_name" :value="item.client_name">{{ item.client_name }}</option>
                    </select>
                    <span v-if="submitted && !validation.name" class="error">Client Name is required.</span>
                </td>
            </tr>

            <tr v-if="client.name">
                <td><label>Business Unit</label></td>
                <td>
                    <select id="business" v-model.trim="client.business" class="color_cell" name="business">
                        <option value="">Choose B-Unit</option>
                        <option v-for="item in filteredBusinessUnits" :key="item.business_unit_name" :value="item.business_unit_name">{{ item.business_unit_name }}</option>
                    </select>
                    <span v-if="submitted && !validation.business" class="error">Business Unit is required.</span>
                </td>
            </tr>

            <tr v-if="client.business">
                <td><label>Select Matrix</label></td>
                <td>
                    <select id="matrix" v-model.trim="client.matrix" name="matrix">
                        <option value="">Choose Matrix</option>
                        <option value="requirements">Requirements</option>
                        <option value="submission">Submission</option>
                        <option value="Selection">Selection</option>
                        <option value="Rejections">Rejections</option>
                        <option value="Onboarded">Onboarded</option>
                        <option value="Dropouts">Dropouts</option>
                        <option value="Offboarded">Offboarded</option>
                    </select>
                    <span v-if="submitted && !validation.matrix" class="error">Matrix is required.</span>
                </td>
            </tr>

            <tr v-if="client.matrix">
                <td><label>From Date</label></td>
                <td>
                    <input v-model.trim="client.from" type="date" @change="resetToDate">
                    <span v-if="submitted && !validation.from" class="error">From Date is required.</span>
                </td>
            </tr>

            <tr v-if="client.from">
                <td><label>To Date</label></td>
                <td>
                    <input v-model.trim="client.to" type="date" :min="client.from">
                    <span v-if="submitted && !validation.to" class="error">To Date is required.</span>
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
import Swal from 'sweetalert2'
import axios from 'axios';

export default {
    name: 'AMClientReport',
    mixins: [commonFunctionsMixin],
    data() {
        return {
            client: {
                name: "",
                business: "",
                location: "",
                matrix: "",
                from: "",
                to: "",
            },
            submitted: false,
            clientMis: [],
            filteredClients: [],
            filteredBusinessUnits: [],
        };
    },
    computed: {
        uniqueLocations() {
            const locations = this.clientMis.map(item => item.location);
            return [...new Set(locations)];
        },
        validation() {
            return {
                name: this.client.name.trim() !== '',
                business: this.client.business.trim() !== '',
                location: this.client.location.trim() !== '',
                matrix: this.client.matrix.trim() !== '',
                from: this.client.from.trim() !== '',
                to: this.client.to.trim() !== '',
            };
        },
        isFormValid() {
            return Object.values(this.validation).every(value => value);
        },
    },
    watch: {
        'client.location'() {
            this.client.name = "";
            this.client.business = "";
            this.client.matrix = "";
            this.client.from = "";
            this.client.to = "";
            this.filterClientData();
        },
        'client.name'() {
            this.client.business = "";
            this.client.matrix = "";
            this.client.from = "";
            this.client.to = "";
            this.filterBusinessUnits();
        },
        'client.business'() {
            this.client.matrix = "";
            this.client.from = "";
            this.client.to = "";
        },
    },
    methods: {
        closePopup() {
            this.$emit("closePopup");
        },
        userLocationApi() {
            axios
                .get('/api/editorclient-matrix')
                .then(response => {
                    this.clientMis = response.data.clients;
                })
                .catch(error => {
                    console.log(error);
                    this.errored = true;
                });
        },
        filterClientData() {
            this.filteredClients = this.clientMis.filter(item => item.location === this.client.location);
            this.filteredBusinessUnits = [];
        },
        filterBusinessUnits() {
            this.filteredBusinessUnits = this.filteredClients.filter(item => item.client_name === this.client.name);
        },
        resetToDate() {
            this.client.to = "";
        },
        submitForm() {
            this.submitted = true; // Set the submitted flag to true when attempting to submit the form
            if (this.isFormValid) {
                Swal.fire({
                    position: "top-center",
                    icon: "success",
                    title: "Your form has been submitted",
                    showConfirmButton: false,
                    timer: 5000
                });
                // You might want to reset the form and submitted flag here if needed
            } else {
                Swal.fire("Form not Submitted");
            }
        },
    },
    mounted() {
        this.userLocationApi();
    },
};
</script>
