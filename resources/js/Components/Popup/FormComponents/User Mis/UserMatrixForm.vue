<template>
   <form >
    <table class="input_form">

    <tr>
    <td ><label >Employee Name</label></td>
    <td ><select id="Location"  class="color_cell"  name="Choose Location">
    <option value="">Choose Employee</option>
    <option value="India">India</option>
    <option value="usa">USA</option>
    </select></td>
    </tr>

    <tr>
    <td ><label >Employee Email Id</label></td>
    <td ><select id="Location"  class="color_cell"  name="Choose Client">
    <option value="">Choose Email</option>
    <option value="India">India</option>
    <option value="usa">USA</option>
    </select></td>
    </tr>

    <tr>
    <td ><label >Select Matrix</label></td>
    <td ><select id="Location"   name="Location">
    <option value="">Choose Matrix</option>
    <option value="Selections-Skill">Selections-Skill</option>
                            <option value="Rejections-Skill">Rejections-Skill</option>
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
        name:'UserMatrixForm',

    }
</script>
