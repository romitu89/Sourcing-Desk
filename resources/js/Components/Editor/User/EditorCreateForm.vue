<template>
    <form @submit.prevent="submitForm">
     <table class="input_form">

     <tr>
     <td ><label >Employee Name</label></td>
     <td ><input type="text" v-model.trim="employee.empName" placeholder="Employee Name" >
         <span v-if="errors.empName" class="error">{{errors.empName[0]}}</span></td>
     </tr>

     <tr>
     <td ><label >User Name</label></td>
     <td ><input type="text" v-model.trim="employee.userName" placeholder="User Name" >
         <span v-if="errors.userName" class="error">{{errors.userName[0]}}</span></td>
     </tr>

     <tr>
     <td ><label >Password</label></td>
     <td ><input type="text" v-model.trim="employee.password" placeholder="Password" >
         <span v-if="errors.password" class="error">{{errors.password[0]}}</span></td>
     </tr>

     <tr>
     <td ><label >Confirm Password</label></td>
     <td ><input type="text" v-model.trim="employee.cnfrmPassword" placeholder="Confirm Password">
         <span v-if="errors.cnfrmPassword" class="error">{{errors.cnfrmPassword[0]}}</span></td>
     </tr>

     <tr>
     <td ><label >Employee Id</label></td>
     <td ><input type="text" v-model.trim="employee.empId" placeholder="Enter Employee Id">
         <span v-if="errors.empId" class="error">{{errors.empId[0]}}</span></td>
     </tr>

     <tr>
     <td ><label >Email Id</label></td>
     <td ><input type="text" v-model.trim="employee.email" placeholder="Enter Email Id">
         <span v-if="errors.email" class="error">{{errors.email[0]}}</span></td>
     </tr>

     <tr>
     <td ><label >Mobile Number</label></td>
     <td ><input type="text" v-model.trim="employee.mobile" placeholder="Enter Mobile Number">
         <span v-if="errors.mobile" class="error">{{errors.mobile[0]}}</span></td>
     </tr>

     <tr>
     <td ><label >Select Location</label></td>
     <td ><select id="location" v-model="employee.selectedLocation" name="location">
     <option value="">Select Location</option>
     <option v-for="item in userLocation" :key='item.country' :value="item.country">{{ item.country }}</option>

     </select><br><span v-if="errors.selectedLocation" class="error">{{errors.selectedLocation[0]}}</span></td>
     </tr>

     <tr>
    <td ><label >Role</label></td>
    <td ><select id="role" v-model="employee.role" name="role">
    <option value="">Select Role</option>
    <option value="admin">Admin</option>
    <option value="editor">Editor</option>
    <option value="accountManager">Account-Manager</option>
    <option value="teamLead">Team-Lead</option>
    <option value="recruiter">Recruiter</option>
    <option value="hr-payroll">Hr-Payroll</option>
    </select><br><span v-if="errors.role" class="error">{{errors.role[0]}}</span></td>
    </tr>

     <tr>
    <td ><label >Department</label></td>
    <td ><select id="department" v-model="employee.department" name="department">
    <option value="">Select Department</option>

    <option value="hrStaffing">HR-Staffing</option>
    <option value="hrPayroll">HR-Payroll</option>
    <option value="sales">Sales</option>
    <option value="informationTechnology">Information Technology</option>
    <option value="others">Others</option>
    </select><br><span v-if="errors.department" class="error">{{errors.department[0]}}</span></td>
    </tr>

     <tr>
     <td ><label >Date of Birth</label></td>
     <td ><input v-model.trim="employee.dob" type="date" >
         <span v-if="errors.dob" class="error">{{errors.dob[0]}}</span></td>
     </tr>

     <tr>
        <td></td>
       <td> <button @click="closePopup()" class="cancel_btn">Cancel</button>
        <button class="submit_btn">Submit</button> </td>
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
             empName:"",
             userName:"",
             password:"",
             cnfrmPassword:"",
             empId:"",
             email:"",
             mobile:"",
             selectedLocation:"",
             role:"",
             department:"",
             dob:"",
                 },
                 submitted:false,
                 userLocation:[],
                 errors:{},
             };
         },


         methods:{
            closePopup() {
      this.$emit("closePopup");
    },

             userLocationApi()
         {
             axios
       .get('/api/editoruser-create')
       .then(response => {
         this.userLocation = response.data
         console.log(this.userLocation)
       })
       .catch(error => {
         console.log(error)
         this.errored = true
       })

         },

         resetForm(){
                this.employee.empName=""
                this.employee.userName=""
                this.employee.password=""
                this.employee.cnfrmPassword=""
                this.employee.empId=""
                this.employee.email=""
                this.employee.mobile=""
                this.employee.selectedLocation=""
                this.employee.role=""
                this.employee.department=""
                this.employee.dob=""
         },

             submitForm() {
                 this.submitted = true; // Set the submitted flag to true when attempting to submit the form
                 // if (this.isFormValid) {

                     axios.post('/api/editoruser-create', this.employee)
               .then(response => {
                   console.log('Form submitted:', response.data.message);
                   if(response.data.message){
                     this.errors={};

                      Swal.fire({
                         position: "top-center",
                         icon: "success",
                         title: "User created successfully",
                         showConfirmButton: false,
                         timer: 5000
                         });

                         this.resetForm()

                   }
                   else{
                     Swal.fire("Form not Submitted");
                   }

                   // Handle the response as needed
                })
               .catch(error => {
                 //   console.error('Error submitting form:', error.response.data.errors);
                   this.errors= error.response.data.errors;
                });




 // You might want to reset the form and submitted flag here if needed

                 },
             },

             mounted(){
     this.userLocationApi()

 }

         };
 </script>


