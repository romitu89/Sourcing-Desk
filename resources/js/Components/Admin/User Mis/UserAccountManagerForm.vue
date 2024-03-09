<template>
     <form @submit.prevent="submitForm">
    <table class="input_form">

    <tr>
    <td ><label >Employee Name</label></td>
    <td ><select id="client"  v-model.trim="client.name" class="color_cell"  name="Choose Location">
    <option value="">Choose Employee</option>
    <option value="India">India</option>
    <option value="usa">USA</option>
    </select><br>
    <span v-if="submitted && !validation.name" class="error">Name is required.</span></td>
    </tr>

    <tr>
    <td ><label >Employee Email Id</label></td>
    <td ><select id="email"  v-model.trim="client.email" class="color_cell"  name="Choose Client">
    <option value="">Choose Email</option>
    <option value="India">India</option>
    <option value="usa">USA</option>
    </select><br>
    <span v-if="submitted && !validation.email" class="error">Email is required.</span></td>
    </tr>


    <tr>
    <td ><label >Select Matrix</label></td>
    <td ><select id="matrix"  v-model.trim="client.matrix"  name="matrix">
    <option value="">Choose Matrix</option>
    <option value="Requirements">Requirements</option>
    <option value="Submission">Submission</option>
    <option value="Selection">Selection</option>
    <option value="Rejections">Rejections</option>
    <option value="Onboarded">Onboarded</option>
    <option value="Dropouts">Dropouts</option>
    <option value="Offboarded">Offboarded</option>
    <option value="Daily Report">Daily Report</option>
    </select><br>
    <span v-if="submitted && !validation.matrix" class="error">Matrix is required.</span></td>
    </tr>

    <tr>
    <td ><label >From Date</label></td>
    <td ><input  v-model.trim="client.from"  type="date" >
        <span v-if="submitted && !validation.from" class="error">From Date is required.</span></td>
    </tr>

    <tr>
    <td ><label >To Date</label></td>
    <td ><input  v-model.trim="client.to"  type="date" >
        <span v-if="submitted && !validation.to" class="error">To Date is required.</span></td>
    </tr>

    <tr>
        <td></td>
       <td>
        <button  class="submit_btn">Submit</button> </td>
    </tr>
</table>
</form>
</template>

<script>
import Swal from 'sweetalert2'
    export default {
        name:'UserAccountManagerForm',

        data()
        {
            return{
                client: {
                    name:"",
                    email:"",
                    matrix:"",
                    from:"",
                    to:"",
                },
                submitted:false,
            };
        },

        computed:{
            validation(){

                return {
            name: this.client.name.trim() !== '',
            email: this.client.email.trim() !== '',
            matrix: this.client.matrix.trim() !== '',
            from: this.client.from.trim() !== '',
            to: this.client.to.trim() !== '',

            };
            },

            isFormValid() {

                return Object.values(this.validation).every(value => value);
            },

            },

            methods:{
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
                        }
                else {
                        Swal.fire("Form not Submitted");
                        }
                },
            },
    }
</script>
