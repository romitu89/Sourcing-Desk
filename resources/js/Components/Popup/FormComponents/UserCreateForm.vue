<template>
   <form @submit.prevent="userCreateApi()">
    <table class="input_form">

    <tr>
    <td ><label >Employee Name</label></td>
    <td ><input type="text" v-model="empName" placeholder="Employee Name"></td>
    </tr>

    <tr>
    <td ><label >User Name</label></td>
    <td ><input type="text" v-model="userName" placeholder="User Name"></td>
    </tr>

    <tr>
    <td ><label >Password</label></td>
    <td ><input type="text" v-model="password" placeholder="Password"></td>
    </tr>

    <tr>
    <td ><label >Confirm Password</label></td>
    <td ><input type="text" v-model="cnfrmPassword" placeholder="Confirm Password"></td>
    </tr>

    <tr>
    <td ><label >Employee Id</label></td>
    <td ><input type="text" v-model="empId" placeholder="Enter Employee Id"></td>
    </tr>

    <tr>
    <td ><label >Email Id</label></td>
    <td ><input type="text" v-model="emailId" placeholder="Enter Email Id"></td>
    </tr>

    <tr>
    <td ><label >Mobile Number</label></td>
    <td ><input type="text" v-model="mobile" placeholder="Enter Mobile Number"></td>
    </tr>

    <tr>
    <td ><label >Select Location</label></td>
    <td ><select id="location" v-model="selectLocation" class="color_cell"  name="location">
    <option value="">Select Location</option>
    <option value="India">India</option>
    <option value="usa">USA</option>
    </select></td>
    </tr>

    <tr>
    <td ><label >Role</label></td>
    <td ><select id="role" v-model="role" name="role">
    <option value="Role">Choose Role</option>
    <option value="admin">Admin</option>
    <option value="editor">Editor</option>
    <option value="accountManager">Account-Manager</option>
    <option value="teamLead">Team-Lead</option>
    <option value="recruiter">Recruiter</option>
    <option value="hr-payroll">Hr-Payroll</option>

    </select></td>
    </tr>

    <tr>
    <td ><label >Department</label></td>
    <td ><select id="department" v-model="department" name="department">
    <option value="Choose Department">Choose Department</option>
    <option value="hrStaffing">HR-Staffing</option>
    <option value="hrPayroll">HR-Payroll</option>
    <option value="sales">Sales</option>
    <option value="informationTechnology">Information Technology</option>
    <option value="others">Others</option>
    </select></td>
    </tr>

    <tr>
    <td ><label >Date of Birth</label></td>
    <td ><input v-model="dob" type="date" ></td>
    </tr>

    <tr>
        <td></td>
       <td> <button class="cancel_btn">Cancel</button>
        <button @click="userCreateApi()" class="submit_btn">Submit</button> </td>
    </tr>
    </table>

   </form>

</template>

<script>
    export default {
        name:'UserCreateForm',

        data()
        {
            return{
            empName:"",
            userName:"",
            password:"",
            cnfrmPassword:"",
            empId:"",
            emailId:"",
            mobile:"",
            selectLocation:"",
            role:"",
            department:"",
            dob:"",

            };
        },
        methods:{
        userLocationApi()
        {
            axios
      .get('/api/adminuser-view')
      .then(response => {
        this.userLocation = response.data.locations
        console.log(this.userLocation)
      })
      .catch(error => {
        console.log(error)
        this.errored = true
      })

        },

        userViewApi(){
            console.log(this.selectedLocation, this.selectedUser)
            const formData = {
                selectedLocation: this.selectedLocation,
                user: this.selectedUser,
               // include other data as needed
           };zzz

          axios.post('/api/adminuser-view', formData)
              .then(response => {
                  console.log('Form submitted:', response.data.results);
                  // Handle the response as needed
               })
              .catch(error => {
                  console.error('Error submitting form:', error);
               });
        }
    },
mounted(){
    this.userLocationApi()

}
    }
</script>


<style scoped>

.input_form td{

    /* border: 2px solid red; */
    padding: 10px 40px;
    font-size: 20px;

}
input[type=text] {
    width: 100%;
    padding: 10px 20px;
    border-radius: 4px;
}

input[type=date] {
    width: 100%;
    padding: 10px 5px;
    border-radius: 4px;
}

.input_form{
    overflow-x: scroll;
    margin-left: 40px;
}

.input_form td select{
    padding: 10px 20px;
    width: 400px;
}

.color_cell{
    background-color: #227C09;
}

.cancel_btn{
    padding: 10px 25px;
    background-color: rgb(252, 64, 64);
    border-radius: 5px;

}
.submit_btn{
    padding: 10px 25px;
    background-color: #227C09;
    border-radius: 5px;
    margin-left: 5px;

}

.cancel_btn:hover{
    box-shadow: 2px 2px 4px 5px darkgray;
}
.submit_btn:hover{
    box-shadow: 2px 2px 4px 5px darkgray;
}
</style>

