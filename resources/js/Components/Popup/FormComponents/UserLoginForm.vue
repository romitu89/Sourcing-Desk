<template>

<form >
    <table class="input_form">

    <tr>
    <td ><label >Select Location</label></td>
    <td ><select id="Location"  name="Location">
    <option value="">Select Location</option>
    <option value="India">India</option>
    <option value="usa">USA</option>
    </select></td>
    </tr>

    <tr>
    <td ><label >Employee Email</label></td>
    <td ><select id="Email" name="Email">
    <option value="">Select Location</option>
    <option value="India">India</option>
    <option value="usa">USA</option>
    </select></td>
    </tr>

    <tr>
    <td ><label >From Date</label></td>
    <td ><input type="date" ></td>
    </tr>

    <tr>
    <td ><label >To Date</label></td>
    <td ><input type="date" ></td>
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
        name: 'UserLoginForm'
    }
</script>

<style scoped>
.input_form td{
    
    /* border: 2px solid red; */
    padding: 10px 40px;
    font-size: 20px;
}

.input_form td select{
    padding: 10px 20px;
    width: 400px;
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

input[type=date] {
    width: 100%;
    padding: 10px 5px;
    border-radius: 4px;
}

</style>