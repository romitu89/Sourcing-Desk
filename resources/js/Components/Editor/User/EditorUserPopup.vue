<template>
    <div class="popup">
        <div @click="closePopup()" class="close_btn"> <a ><font-awesome-icon :icon="['fas', 'xmark']" /></a></div>
        <div class="popup-inner">
            <h2 class="title">{{ title }}</h2>

      <EditorCreateForm @closePopup="closePopup()"
      v-if="title=='Create Form'"/>

      <EditorViewForm
        @closePopup="closePopup()"
        @updateForm="updateForm"
        @editMessageUpdated="editMessageUpdated"
        :empName="empNameProp"
        v-if="titleProp == 'View Form'"
      />

      <EditorLoginForm @closePopup="closePopup()"
      v-if="title=='Login Form'"/>

      <EditorEditForm
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
import EditorCreateForm from './EditorCreateForm.vue'
import EditorViewForm from './EditorViewForm.vue'
import EditorLoginForm from './EditorLoginForm.vue'
import EditorEditForm from './EditorEditForm.vue'

export default {
    name: 'EditorUserPopup',
    mixins:[outsideClickMixin],
    components: {
        EditorCreateForm,
        EditorViewForm,
        EditorLoginForm,
        EditorEditForm
    },
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
      default: false,
    },
    title: {
      type: String,
      default: "Head",
    },
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
      this.showUserCreate = false;
      this.$emit("closePopup", this.showUserCreate);
    },
    updateForm(id) {
      this.$emit("updateForm", id);
    },
    editSuccess(name){
      this.$emit("editSuccess", name)
    },
    editMessageUpdated(){
      this.empNameProp=""
    }

  },
};
</script>

<style scoped>
.popup{
    position: fixed;
    top: 25px;
    left: 190px;
    padding: 15px 25px;
    z-index: 1;
    background-color: whitesmoke;
    /* opacity: 0.9; */
    width: 70%;
    height: 90%;
    border-radius: 25px;
    box-shadow: 2px 2px 7px 8px lightgray;

    overflow: scroll;
}

    .close_btn {
        position: absolute;
        right: 25px;
        color: #002147;
        font-size: 25px;
        cursor: pointer;
        padding: 10px;
    }

    .title{
        color: #002147;
        margin-left: 5%;
        font-size: 30px;
        letter-spacing: 5px;
        text-decoration: underline;
    }

</style>
