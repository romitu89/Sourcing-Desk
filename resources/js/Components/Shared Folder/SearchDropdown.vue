<template>
    <div class="dropdown">
      <button
        class="btn btn-secondary dropdown-toggle"
        type="button"
        id="dropdownMenuButton"
        data-toggle="dropdown"
        aria-haspopup="true"
        aria-expanded="false"
      >
        {{ selectedOption ? selectedOption : defaultName }}
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <div class="dropdown-search">
          <input
            type="text"
            class="form-control"
            v-model="searchTerm"
            @input="filterOptions"
            @click.stop
            @keydown.up.prevent="navigateOptions(-1)"
            @keydown.down.prevent="navigateOptions(1)"
            ref="searchInput"
          />
        </div>
        <div class="dropdown-options">
          <button
            href="#"
            class="dropdown-item"
            v-for="(option, index) in filteredOptions"
            :key="option"
            :class="{ active: index === activeIndex }"
 
            @click="selectOption(option)"
            type ="button"
          >
            {{ option }}
          </button>
          <div v-if="filteredOptions.length === 0" class="dropdown-item no-data-found">
            No data found
          </div>
        </div>
      </div>
    </div>
  </template>
 
  <script>
 
  export default {
 
    props: {
      defaultName: {
        type: String,
      },
      optionLabels: {
        type: Array,
      },
    },
    emits: ["selectedOption"],
    data() {
      return {
        searchTerm: "",
        selectedOption: this.defaultName, // Initialize selectedOption with defaultName
        activeIndex: -1,
        optionSelected: false,
      };
    },
    computed: {
      filteredOptions() {
        const searchTerm = this.searchTerm.toLowerCase();
        return this.optionLabels.filter((option) => option.toLowerCase().includes(searchTerm));
      },
    },
    watch: {
      defaultName(newDefaultName) {
        // Watch for changes in defaultName prop and update selectedOption
        this.selectedOption = newDefaultName;
      },
      optionLabels(newOptions) {
        // Reset selected option and search term when options change
        this.selectedOption = "";
        this.searchTerm = "";
      },
    },
    methods: {
      addOption(option) {
        this.optionLabels.push(option);
      },
      selectOption(option) {
        this.selectedOption = option;
        this.searchTerm = option;
        this.optionSelected = true;
 
 
        // Emit the selected option to the parent component
        this.$emit("selectedOption", option);
 
        this.hideDropdown();
      },
      hideDropdown() {
        this.searchTerm = "";
        this.$refs.searchInput.blur();
      },
      filterOptions() {
        this.activeIndex = -1;
      },
      navigateOptions(direction) {
        this.activeIndex = Math.max(
          0,
          Math.min(this.activeIndex + direction, this.filteredOptions.length - 1)
        );
      },
    },
  };
  </script>
 
  <style>
  /* Add some spacing to the active option */
  .dropdown-item.active {
    background-color: #f8f9fa;
  }
 
  /* Add some padding to the dropdown search input */
  .dropdown-search {
    padding: 8px;
  }
 
  /* Set the height and enable vertical scrolling for the options list */
  .dropdown-options {
    max-height: 200px; /* Set the desired height */
    overflow-y: auto;
  }
 
  /* Customize button styles */
  .btn-secondary {
    background-color: #4099ff;
  }
 
  .btn-secondary:hover {
    background-color: #73b4ff;
  }
  </style>