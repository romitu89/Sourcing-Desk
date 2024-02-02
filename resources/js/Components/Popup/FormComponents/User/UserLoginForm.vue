<template>

<form @submit.prevent="submitForm">
    <table class="input_form">

    <tr>
    <td ><label >Select Location</label></td>
    <td ><select id="Location" v-model="employee.location"  name="Location">
    <option value="">Select Location</option>
    <option value="India">India</option>
    <option value="usa">USA</option>
    </select><span v-if="submitted && !validation.location" class="error">Employee location is required.</span></td>
    </tr>

    <tr>
    <td ><label >Employee Email</label></td>
    <td ><select id="Email" v-model="employee.email" name="Email">
    <option value="">Select Email</option>
    <option value="India">India</option>
    <option value="usa">USA</option>
    </select><span v-if="submitted && !validation.email" class="error">Employee email is required.</span></td>
    </tr>

    <tr>
    <td ><label >From Date</label></td>
    <td ><input type="date" v-model="employee.fromDate" >
        <span v-if="submitted && !validation.fromDate" class="error"> From Date is required.</span></td>
    </tr>

    <tr>
    <td ><label >To Date</label></td>
    <td ><input type="date" v-model="employee.toDate" >
        <span v-if="submitted && !validation.toDate" class="error"> To Date is required.</span></td>
    </tr>

    <tr>
        <td></td>
       <td> <button class="submit_btn">Submit</button> </td>
    </tr>

</table>
</form>

</template>

<script>
    export default {
        name: 'UserLoginForm',
        
        data()
        {
            return{
                employee:{
                    location:"",
                    email:"",
                    fromDate:"",
                    toDate:"",
                },
                submitted:false,
            };
        },

        computed:{
            validation(){
                return {
            location: this.employee.location.trim() !== '',
            email:this.employee.email.trim() !== '',
            fromDate: this.employee.fromDate.trim() !== '',
            toDate: this.employee.toDate.trim() !== '',
            };
            },
            isFormValid() {
                return Object.values(this.validation).every(value => value);
            },
        },

        methods: {

submitForm() {
        this.submitted = true; // Set the submitted flag to true when attempting to submit the form
        if (this.isFormValid) {
        alert('Form submitted successfully!');
        // You might want to reset the form and submitted flag here if needed
        } 
        else {
        alert('Please correct the errors before submitting.');
        }
         },
        },
        }
</script>

