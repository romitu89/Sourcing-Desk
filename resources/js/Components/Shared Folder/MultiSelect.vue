<template>
    <div class="multi-select">
      <div class="form-group">
        <input
          type="text"
          class="form-control"
          v-model="searchTerm"
          placeholder="Search..."
        />
      </div>
      <div class="d-flex mb-2">
        <button @click.prevent="selectAll" class="btn btn-primary me-2">Select All</button>
        <button @click.prevent="deselectAll" class="btn btn-danger">Deselect All</button>
      </div>

      <div class="options-container">
        <div v-for="option in filteredOptions" :key="option.value" class="form-check">
          <input class="form-check-input" type="checkbox" :value="option.value" :id="option.value" v-model="selectedOptions" />
          <label class="form-check-label" :for="option.value">{{ option.label }}</label>
        </div>
      </div>
    </div>
  </template>

  <script>
  export default {

    props: ['options','selectedTeam'],

    data() {
      return {
        searchTerm: '',
        selectedOptions: [],
      };
    },
    computed: {
      filteredOptions() {
        return this.options.filter((option) =>
          option.label.toLowerCase().includes(this.searchTerm.toLowerCase())
        );
      },
    },
    created() {
    if (this.selectedTeam && this.selectedTeam.length > 0) {
      this.selectedOptions = [...this.selectedTeam];
    }
  },
    methods: {
      selectAll() {
        this.selectedOptions = this.filteredOptions.map((option) => option.value);
      },
      deselectAll() {
        this.selectedOptions = [];
      },
      clearSelectedOptions() {
    this.selectedOptions = [];
  },
    },
    watch: {

    selectedOptions: {
      immediate: true,
      deep: true,
      handler(newVal) {
        this.$emit('update:selected', newVal);
      },
    },
    selectedTeam: {
      immediate: true,
      deep: true,
      handler() {
        if (this.selectedTeam.length === 0) {
          this.selectedOptions = [];
        }
      },
    },
  },



  };
  </script>


  <style scoped>
  .options-container {
    max-height: 200px;  /* Set the maximum height */
    overflow-y: auto;  /* Make it scrollable */
    border: 1px solid #ccc;  /* Optional: Add a border */
    border-radius: 4px;  /* Optional: Round the corners */
  }
  </style>
