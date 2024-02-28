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
        <button class="btn btn-outline-secondary search-button" type="button">
          <font-awesome-icon icon="search" /> <!-- Ensure you include FontAwesome for this icon -->
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
            <button class="page-link" @click="currentPage--" :disabled="currentPage === 1">Previous</button>
          </li>
          <li class="page-item" v-for="n in pageCount" :key="n" :class="{ active: n === currentPage }">
            <button class="page-link" @click="changePage(n)">{{ n }}</button>
          </li>
          <li class="page-item" :class="{ disabled: currentPage === pageCount }">
            <button class="page-link" @click="currentPage++" :disabled="currentPage === pageCount">Next</button>
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
        changePage(pageNumber) {
      this.currentPage = pageNumber;
    },
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
.container-fluid {
  padding: 0 15px;
}

/* Enhanced Search Bar */
.search-bar {
  display: flex;
  width: 100%;
  max-width: 600px;
  margin: 0 auto 20px;
  border: 1px solid #ced4da;
  border-radius: .375rem;
  overflow: hidden;
}

.search-input {
  flex-grow: 1;
  border: none;
  padding: .375rem .75rem;
  font-size: 1rem;
}

.search-button {
  background-color: #007bff;
  color: white;
  padding: .375rem .75rem;
  border: 2px solid #007bff;
  cursor: pointer;

}

.search-button:hover {
  background-color: #0056b3;
}

/* Styling for Tables */
.table-responsive {
  overflow-x: auto; /* Allows table to scroll horizontally on smaller screens */
  box-shadow: 2px 2px 2px 4px lightgray;
  border-radius: 5px;
}

.table {
  width: 100%;
  border-collapse: collapse;


}

.table th {
  background-color: #0C1423; /* Deep navy blue for table headers */
  color: lightblue; /* White text for contrast */
  padding: 12px;
  white-space: nowrap; /* Prevents text from wrapping */
  min-width: 120px; /* Adjust as needed to prevent wrapping */
}
.table td {
  padding: 12px;
  background-color: #f8f9fa;
  color: #333;
  border-bottom: 1px solid lightblue;
  text-align: center;

}

.table tr:nth-child(odd) td {
  background-color: rgb(217, 217, 217);
}

/* Pagination */
.pagination {
  display: flex;
  justify-content: center;
  list-style: none;
  padding: 0;
}

.page-item {
  margin: 0 2px;
}

.page-link {
  color: #007bff;
  background-color: #fff;
  border: 1px solid #dee2e6;
  padding: .375rem .75rem;
  border-radius: .375rem;
  cursor: pointer;
}

.page-item.active .page-link {
  color: #fff;
  background-color: #007bff;
  border-color: #007bff;
}

.page-item.disabled .page-link {
  color: #6c757d;
  background-color: #e9ecef;
  border-color: #dee2e6;
  cursor: not-allowed;
}

.page-link:hover {
  color: #0056b3;
  background-color: #e2e6ea;
  border-color: #d3d9df;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
  .search-bar {
    width: 95%;
    max-width: none;
  }

  .search-input, .search-button, .page-link {
    padding: .25rem .5rem;
    font-size: .875rem;
  }

  .table th, .table td {
    padding: 8px; /* Adjust padding */
    font-size: 14px; /* Adjust font size if necessary for space */
  }
}

.no-results {
  font-size: 1.5rem;
  color: #d9534f;
  text-align: center;
  padding: 20px 0;
}
</style>

