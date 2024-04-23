<template>

<div class="popup">
        <div @click="closePopup()" class="close_btn"> <a ><font-awesome-icon :icon="['fas', 'xmark']" /></a></div>
        <div class="popup-inner">
            <h2 class="title">{{ titleProp }}</h2>

            <ClientCreateForm  @closePopup="closePopup()"
            v-if="titleProp =='Client Create'"/>

            <ClientViewForm
            @closePopup="closePopup()"
            @updateForm="updateForm"
            @editMessageUpdated="editMessageUpdated"
            :empName="empNameProp"
            v-if="titleProp =='Client View'"/>

            <ClientEditForm
            @closePopup="closePopup()"
            @editSuccess="editSuccess"
            :editId="editIdProp"
            v-if="titleProp == 'Edit Form'"
        />


        </div>
    </div>
</template>

<script>
import { outsideClickMixin } from '../../../outsideClick.js';
import ClientCreateForm from './ClientCreateForm.vue'
import ClientViewForm from './ClientViewForm.vue'
import ClientEditForm from './ClientEditForm.vue';

export default {

    name:'ClientForm',
    mixins:[outsideClickMixin],
    props: {
        editId: {
        type: Number,
        default: null,
        },
        empName:{
        type: String,
        default: "",
        },
        showPopUp: {
            type: Boolean,
            default: false
        },
        title: {
            type: String,
            default: 'Head'
        }
    },
    watch: {
        tab(newVal) {
            this.showUserCreate = newVal;
        },
        editId(newVal) {
        this.editIdProp = newVal;
        },
        title(newVal) {
        this.titleProp = newVal;
        },
        empName(newVal) {
        this.empNameProp = newVal;
        },
    },
    data() {
        return {
            showUserCreate: this.tab,
            editIdProp: this.editId,
            titleProp: this.title,
            empNameProp:this.empName,
        };
    },
    methods: {
        closePopup() {
            console.log(this.showUserCreate);
            this.showUserCreate = false;
            this.$emit('closePopup', this.showUserCreate);
        },
        updateForm(id) {
            this.$emit("updateForm", id);
        },
        editSuccess(name){
            console.log("Edit Client form")
            this.$emit("editSuccess", name)
        },
        editMessageUpdated(){
            this.empNameProp=""
        },
    },
    components:{ClientCreateForm, ClientViewForm, ClientEditForm},
}

</script>
