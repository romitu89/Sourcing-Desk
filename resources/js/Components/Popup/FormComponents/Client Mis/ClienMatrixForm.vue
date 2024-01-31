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
    <td ><label >Select Matrix</label></td>
    <td ><select id="Location"   name="Location">
    <option value="">Choose Matrix</option>
    <option value="requirements">Requirements</option>
    <option value="submission">Submission</option>
    <option value="Selection">Selection</option>
    <option value="Rejections">Rejections</option>
    <option value="Onboarded">Onboarded</option>
    <option value="Dropouts">Dropouts</option>
    <option value="Offboarded">Offboarded</option>
    </select></td>
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
    name:'ClienMatrixForm',

}
</script>
