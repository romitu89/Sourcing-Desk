<template>
    <div v-if="showPopUp" class="popup">
      <div class="close_btn">
        <a @click="closePopup"><font-awesome-icon :icon="['fas', 'times']" /></a>
      </div>
      <div class="popup-inner">
        <h2 class="title">{{ title }}</h2>

        <UserCreateForm v-if="titleProp === 'Create Form'"  @closePopup="closePopup" />

        <UserViewForm
          v-if="titleProp === 'View Form'"
          :empName="empNameProp"
          @updateForm="updateForm"
          @editMessageUpdated="editMessageUpdated"
          @closePopup="closePopup"
        />

        <UserLoginForm v-if="titleProp === 'Login Form'" @closePopup="closePopup" />

        <UserEditForm
          v-if="titleProp === 'Edit Form'"
          :editId="editIdProp"
          @editSuccess="editSuccess"
          @closePopup="closePopup"
        />
      </div>
    </div>
  </template>

  <script>
  import { outsideClickMixin } from '../../../outsideClick.js';
  import UserCreateForm from "./UserCreateForm.vue";
  import UserEditForm from "./UserEditForm.vue";
  import UserViewForm from "./UserViewForm.vue";
  import UserLoginForm from "./UserLoginForm.vue";

  export default {
    name: "UserCreate",
    mixins:[outsideClickMixin],

    components: {
      UserCreateForm,
      UserViewForm,
      UserLoginForm,
      UserEditForm,
    },
    props: {
      editId: {
        type: Number,
        default: null,
      },
      empName: {
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
        empNameProp: this.empName,
      };
    },

    methods: {
      closePopup() {
        this.$emit("closePopup");
      },
      updateForm(id) {
        this.$emit("updateForm", id);
      },
      editSuccess(name) {
        this.$emit("editSuccess", name);
      },
      editMessageUpdated() {
        console.log(this.empNameProp,"Value")
        this.empNameProp = "";
      },

    },
  };
  </script>

  <style scoped>
  .popup {
    position: fixed;
    top: 25px;
    left: 190px;
    padding: 15px 25px;
    z-index: 1000; /* Ensure it's above other elements */
    background-color: whitesmoke;
    width: 70%;
    height: 90%;
    border-radius: 25px;
    box-shadow: 2px 2px 7px 8px lightgray;
    overflow: scroll;
  }

  .close_btn {
    position: absolute;
    right: 25px;
    top: 15px;
    color: #002147;
    font-size: 25px;
    cursor: pointer;
  }

  .title {
    color: #002147;
    margin-left: 5%;
    font-size: 30px;
    letter-spacing: 5px;
    text-decoration: underline;
  }
  </style>
