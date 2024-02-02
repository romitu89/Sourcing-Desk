<template>

<form >
    <table class="input_form">

    <tr>
    <td ><label >Client Name</label></td>
    <td ><input type="text" placeholder="Client Name"></td>
    </tr>

    <tr>
    <td ><label >Business Unit Name</label></td>
    <td ><input type="text" placeholder="Business Unit Name"></td>
    </tr>

    <tr>
    <td ><label >Sub Location</label></td>
    <td ><input type="text" placeholder="Sub Location"></td>
    </tr>

    <tr>
    <td ><label >Select Location</label></td>
    <td ><select id="Location" class="color_cell" name="Location">
    <option value="">Choose Location</option>
    <option value="India">India</option>
    <option value="usa">USA</option>
    </select></td>
    </tr>

    <tr>
    <td ><label >Account Manager</label></td>
    <td ><select id="Manager" class="color_cell" name="Manager">
    <option value="">Choose Manager</option>
    <option value="India">India</option>
    <option value="usa">USA</option>
    </select></td>
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
    name: 'ClientCreateForm',
    
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

</style>