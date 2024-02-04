<template>
 
    <div class="container-fluid mt-4">
        <!-- Enhanced Search Bar -->
        <div class="input-group mb-3 search-bar">
          <input
            type="text"
            class="form-control search-input"
            v-model="searchTerm"
            placeholder="Search..."
            @input="filterData"
          />
          <div class="input-group-append">
            <button class="btn btn-primary search-button" type="button">
              <i class="fas fa-search text-white"></i>
            </button>
          </div>
        </div>
 
      <div v-if="paginatedResults.length > 0">
        <!-- Data Table -->
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead class="thead-dark">
              <tr>
                <th v-for="col in columns" :key="col.key">{{ col.label }}</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="res in paginatedResults" :key="res.id">
                <td v-for="col in columns" :key="col.key" :data-label="col.label">
                  <slot :name="col.key" :row="res">
                    {{ res[col.key] }}
                  </slot>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- Pagination -->
        <nav>
          <ul class="pagination">
            <li class="page-item" :class="{ disabled: currentPage === 1 }">
              <button class="page-link" @click="currentPage--">Previous</button>
            </li>
            <li class="page-item" v-for="n in pageCount" :key="n" :class="{ active: n === currentPage }">
              <button class="page-link" @click="currentPage = n">{{ n }}</button>
            </li>
            <li class="page-item" :class="{ disabled: currentPage === pageCount }">
              <button class="page-link" @click="currentPage++">Next</button>
            </li>
          </ul>
        </nav>
      </div>
      <div v-else>
        <p class="text-center no-results">No results found</p>
      </div>
    </div>
 
  </template>
 
  <script>
  export default {
    props: {
      results: Array,
      columns: Array,
    },
    data() {
      return {
        searchTerm: "",
        filteredResults: [],
        currentPage: 1,
        perPage: 10,
      };
    },
    mounted() {
      this.filteredResults = this.results;
    },
    watch: {
      results: "filterData",
    },
    computed: {
      pageCount() {
        return Math.ceil(this.filteredResults.length / this.perPage);
      },
      paginatedResults() {
        const start = (this.currentPage - 1) * this.perPage;
        const end = this.currentPage * this.perPage;
        return this.filteredResults.slice(start, end);
      },
    },
    methods: {
      filterData() {
        if (!this.searchTerm) {
          this.filteredResults = this.results;
          return;
        }
        this.filteredResults = this.results.filter((row) =>
          Object.values(row).some((value) =>
            String(value).toLowerCase().includes(this.searchTerm.toLowerCase())
          )
        );
      },
    },
  };
  </script>
 
  <style scoped>
  .table-responsive {
    width: 100%;
    overflow-x: auto;
  }
 
  .table {
    max-width: none;
    width: 100%;
  }
  .search-bar {
    border-radius: 25px;
    overflow: hidden;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
  }
 
  .search-input {
 
    border-radius: 25px 0 0 25px;
    padding-left: 20px;
    transition: all 0.3s ease;
    border: 2px solid #ccc;
  }
 
  .search-input:focus {
    box-shadow: none;
    outline: none;
  }
 
  .search-button {
    border: none;
    background: linear-gradient(45deg, #007bff, #0056b3);
    border-radius: 0 25px 25px 0;
  }
  td:nth-child(2n) {
    background-color: #f2f2f2cb;
  }
 
  /* Hover effect for columns */
  td:hover {
    background-color: #ddd;
  }
  .no-results {
    font-size: 1.5rem; /* Increase the font size */
    font-weight: bold; /* Make it bold */
    color: #d9534f; /* Set the text color to a kind of red */
    text-align: center; /* Center-align the text */
  }
  </style>