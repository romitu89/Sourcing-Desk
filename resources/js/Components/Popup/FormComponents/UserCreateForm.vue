<template>
   <form >
    <table class="input_form">

    <tr>
    <td ><label >Employee Name</label></td>
    <td ><input type="text" placeholder="Employee Name"></td>
    </tr>

    <tr>
    <td ><label >User Name</label></td>
    <td ><input type="text" placeholder="User Name"></td>
    </tr>

    <tr>
    <td ><label >Password</label></td>
    <td ><input type="text" placeholder="Password"></td>
    </tr>

    <tr>
    <td ><label >Confirm Password</label></td>
    <td ><input type="text" placeholder="Confirm Password"></td>
    </tr>

    <tr>
    <td ><label >Employee Id</label></td>
    <td ><input type="text" placeholder="Enter Employee Id"></td>
    </tr>

    <tr>
    <td ><label >Email Id</label></td>
    <td ><input type="text" placeholder="Enter Email Id"></td>
    </tr>

    <tr>
    <td ><label >Mobile Number</label></td>
    <td ><input type="text" placeholder="Enter Mobile Number"></td>
    </tr>

    <tr>
    <td ><label >Select Location</label></td>
    <td ><select id="Location" class="color_cell" name="Location">
    <option value="">Select Location</option>
    <option value="India">India</option>
    <option value="usa">USA</option>
    </select></td>
    </tr>

    <tr>
    <td ><label >Role</label></td>
    <td ><select id="Role" name="Role">
    <option value="Role">Choose Role</option>
    <option value="Admin">Admin</option>
    <option value="Team Lead">Team Lead</option>
    </select></td>
    </tr>

    <tr>
    <td ><label >Department</label></td>
    <td ><select id="Department" name="Department">
    <option value="Department">Choose Department</option>
    <option value="Development">Development</option>
    <option value="HR">HR</option>
    </select></td>
    </tr>

    <tr>
    <td ><label >Date</label></td>
    <td ><input type="date" placeholder="Enter Mobile Number"></td>
    </tr>

    <tr>
        <td></td>
       <td> <button class="cancel_btn">Cancel</button><button class="submit_btn">Submit</button> </td>
    </tr>
    </table>
    
   </form>

</template>

<script>
    export default {
        name:'UserCreateForm',
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

