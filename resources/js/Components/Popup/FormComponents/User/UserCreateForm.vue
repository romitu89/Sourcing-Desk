<template>
   <form @submit.prevent="submitForm">
    <table class="input_form">
    
    <tr>
    <td ><label >Employee Name</label></td>
    <td ><input type="text" v-model.trim="employee.name" placeholder="Employee Name" >
        <span v-if="submitted && !validation.name" class="error">Name is required.</span></td>
    </tr>

    <tr>
    <td ><label >User Name</label></td>
    <td ><input type="text" v-model.trim="employee.userName" placeholder="User Name" >
        <span v-if="submitted && !validation.userName" class="error">User Name is required.</span></td>
    </tr>

    <tr>
    <td ><label >Password</label></td>
    <td ><input type="text" v-model.trim="employee.password" placeholder="Password" >
        <span v-if="submitted && !validation.password" class="error">Password is required.</span></td>
    </tr>

    <tr>
    <td ><label >Confirm Password</label></td>
    <td ><input type="text" v-model.trim="employee.cnfrmPassword" placeholder="Confirm Password">
        <span v-if="submitted && !validation.cnfrmPassword" class="error">Password is required.</span></td>
    </tr>

    <tr>
    <td ><label >Employee Id</label></td>
    <td ><input type="text" v-model.trim="employee.id" placeholder="Enter Employee Id">
        <span v-if="submitted && !validation.id" class="error">Employee Id is required.</span></td>
    </tr>

    <tr>
    <td ><label >Email Id</label></td>
    <td ><input type="text" v-model.trim="employee.email" placeholder="Enter Email Id">
        <span v-if="submitted && !validation.email" class="error">Email Id is required.</span></td>
    </tr>

    <tr>
    <td ><label >Mobile Number</label></td>
    <td ><input type="text" v-model.trim="employee.mobile" placeholder="Enter Mobile Number">
        <span v-if="submitted && !validation.mobile" class="error">Mobile Number is required.</span></td>
    </tr>

    <tr>
    <td ><label >Select Location</label></td>
    <td ><select id="Location" v-model.trim="employee.location" class="color_cell"  name="Location">
    <option value="">Select Location</option>
    <option value="India">India</option>
    <option value="usa">USA</option>
    </select><span v-if="submitted && !validation.location" class="error">Employee Location required.</span></td>
    </tr>

    <tr>
    <td ><label >Role</label></td>
    <td ><select id="Role" v-model.trim="employee.role" name="Role">
    <option value="Role">Choose Role</option>
    <option value="Admin">Admin</option>
    <option value="Team Lead">Team Lead</option>
    </select><span v-if="submitted && !validation.role" class="error">Employee Role is required.</span></td>
    </tr>

    <tr>
    <td ><label >Department</label></td>
    <td ><select id="Department" v-model.trim="employee.department" name="Department">
    <option value="Choose Department">Choose Department</option>
    <option value="Development">Development</option>
    <option value="HR">HR</option>
    </select><span v-if="submitted && !validation.department" class="error">Department is required.</span></td>
    </tr>

    <tr>
    <td ><label >Date of Birth</label></td>
    <td ><input v-model.trim="employee.dob" type="date" >
        <span v-if="submitted && !validation.dob" class="error">DOB is required.</span></td>
    </tr>

    <tr>
        <td></td>
       <td> <button class="cancel_btn">Cancel</button>
        <button  class="submit_btn">Submit</button> </td>
    </tr>

    </table>
    
   </form>

</template>

<script>
import Swal from 'sweetalert2'

    export default {
        name:'UserCreateForm',
        

        data()
        {
            return{
                employee: {
            name:"",
            userName:"",
            password:"",
            cnfrmPassword:"",
            id:"",
            email:"",
            mobile:"",
            location:"",
            role:"",
            department:"",
            dob:"",
                },
                submitted:false,
            };
        },

        computed:{
            validation(){
                return {
            name: this.employee.name.trim() !== '',
            userName: this.employee.userName.trim() !== '',
            password: this.employee.password.trim() !== '',
            cnfrmPassword: this.employee.cnfrmPassword.trim() !== '',
            id: this.employee.id.trim() !== '',
            email: /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.employee.email),
            mobile: this.employee.mobile.trim() !== '', // Adjust regex based on your mobile number format
            location: this.employee.location.trim() !== '',
            role: this.employee.role.trim() !== '',
            department: this.employee.department.trim() !== '',
            dob: this.employee.dob.trim() !== '',
            };
            },

            isFormValid() {

                return Object.values(this.validation).every(value => value);
            },

            },

        methods:{
            submitForm() {
                this.submitted = true; // Set the submitted flag to true when attempting to submit the form
              
                },
            },
        };
</script>


