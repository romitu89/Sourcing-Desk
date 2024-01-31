<template>
    <form >
    <table class="input_form">

    <tr>
    <td ><label >Select Location</label></td>
    <td ><select id="Location"  class="color_cell"  name="Choose Location">
    <option value="">Choose Location</option>
    <option value="India">India</option>
    <option value="usa">USA</option>
    </select></td>
    </tr>

    <tr>
    <td ><label >Client Name</label></td>
    <td ><select id="Location"  class="color_cell"  name="Choose Client">
    <option value="">Choose Client</option>
    <option value="India">India</option>
    <option value="usa">USA</option>
    </select></td>
    </tr>

    <tr>
    <td ><label >Business Unit</label></td>
    <td ><select id="Location"  class="color_cell"  name="Location">
    <option value="">Choose B-Unit</option>
    <option value="India">India</option>
    <option value="usa">USA</option>
    </select></td>
    </tr>

    <tr>
    <td ><label >Client Manager Name</label></td>
    <td ><select id="Location"  class="color_cell"  name="Location">
    <option value="">Choose Manager</option>
    <option value="India">India</option>
    <option value="usa">USA</option>
    </select></td>
    </tr>

    <tr>
    <td ><label >Select Matrix</label></td>
    <td ><select id="Location"   name="Location">
    <option value="">Choose Matrix</option>
    <option value="India">India</option>
    <option value="usa">USA</option>
    </select></td>
    </tr>

    <tr>
    <td ><label >From Date</label></td>
    <td ><input  type="date" ></td>
    </tr>

    <tr>
    <td ><label >To Date</label></td>
    <td ><input  type="date" ></td>
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
export default {
    name: 'ClientManagerReportForm',

}
</script>