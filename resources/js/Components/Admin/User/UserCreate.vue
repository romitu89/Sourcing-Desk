<template>
  <div class="popup">
    <div @click="closePopup()" class="close_btn">
      <a><font-awesome-icon :icon="['fas', 'xmark']" /></a>
    </div>
    <div class="popup-inner">
      <h2 class="title">{{ titleProp }}</h2>

      <UserCreateForm @closePopup="closePopup()" v-if="titleProp == 'Create Form'" />

      <UserViewForm
        @closePopup="closePopup()"
        @updateForm="updateForm"
        v-if="titleProp == 'View Form'"
      />

      <UserLoginForm @closePopup="closePopup()" v-if="titleProp == 'Login Form'" />
      <UserEditForm
        @closePopup="closePopup()"
        :editId="editIdProp"
        v-if="titleProp == 'Edit Form'"
      />
    </div>
  </div>
</template>

<script>
import UserCreateForm from "./UserCreateForm.vue";
import UserEditForm from "./UserEditForm.vue";
import UserViewForm from "./UserViewForm.vue";
import UserLoginForm from "./UserLoginForm.vue";

export default {
  name: "UserCreate",
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
  },
  data() {
    return {
      showUserCreate: this.tab,
      editIdProp: this.editId,
      titleProp: this.title,
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
  },
};
</script>

<style scoped>
.popup {
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

.title {
  color: #002147;
  margin-left: 5%;
  font-size: 30px;
  letter-spacing: 5px;
  text-decoration: underline;
}
</style>
