<template>
    <div class="pcoded-content">
      <div class="page-header card">
        <div class="row align-items-end">
          <div class="col-lg-8">
            <div class="page-header-title">
              <i class="feather icon-clipboard bg-c-blue"></i>
              <div class="d-inline">
                <h5>{{ heading }}</h5>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="page-header-breadcrumb">
              <ul class="breadcrumb breadcrumb-title">
                <li class="breadcrumb-item">
                  <a href="../index-2.html"><i class="feather icon-home"></i></a>
                </li>
                <li class="breadcrumb-item">
                  <a href="#!">{{ heading }}</a>
                </li>
                <li class="breadcrumb-item">
                  <a href="#!">{{ subHeading }}</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="pcoded-inner-content">
        <div class="main-body">
          <div class="page-wrapper">
            <div class="page-body">
              <div class="row">
                <div class="col-sm-12">
                  <div class="card">
                    <div class="card-header">
                      <h5>{{ subHeading }}</h5>
                    </div>
                    <div class="card-block">
                      <form id="main" @submit.prevent="interview()" novalidate>
                        <div class="form-group options-container">
                          <input
                            type="text"
                            v-model="form.query"
                            @input="search"
                            ref="searchInput"
                            class="form-control"
                          />
                          <button type="submit" class="btn btn-primary m-b-0">
                            Submit
                          </button>
                          <ul
                            v-if="response.length && form.query.length"
                            class="search-results"
                          >
                            <li
                              v-for="result in response.slice(0, 2)"
                              :key="result.id"
                              @click="populateInput(result)"
                            >
                              {{ result.email_id || result.mobile_number }}
                            </li>
                          </ul>
                          <ul v-if="!response.length && form.query.length && showNoData">
                            <li>No Data found</li>
                          </ul>
                          <ul v-if="!form.query.length">
                            <!-- Do not show anything when query is empty -->
                          </ul>
                        </div>
                      </form>
                    </div>
                    <div v-if="results">
                      <responsive-table :results="results" :columns="columns">
                        <template #status="{ row }">
                          <select v-model="row.status">
                            <option disabled value="">Select Status</option>
                            <option value="firstRound">First Round</option>
                            <option value="secondRound">Second Round</option>
                            <option value="thirdRound">Third Round</option>
                            <option value="final">Final</option>
                          </select>
                        </template>

                        <template #response="{ row }">
                          <button
                            type="button"
                            class="accBtn"
                            @click.prevent="accepted(row)"
                          >
                            Submit
                          </button>
                        </template>
                      </responsive-table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  <script>

  import axios from "axios";

  export default {
    props: {
      candidate: Object,
      location: Object,
      results: {
        type: Array,
        default: () => [],
      },
    },
    data() {
      return {
        response: [],
        form: {
          query: "",
        },
        heading: "Candidate",
        subHeading: "Schedule",
        showNoData: false,
        columns: [
          { label: "Date", key: "created_at" },
          { label: "Candidate Name", key: "candidate_name" },
          { label: "Request No.", key: "request_no" },
          { label: "Mobile Number", key: "mobile_number" },
          { label: "Email ID", key: "email_id" },
          { label: "Skill", key: "primary_skills" },
          { label: "Process By", key: "submitted_by" },
          { label: "Client Name", key: "client_name" },
          { label: "Status", key: "status" },
          { label: "Response", key: "response" },
        ],
      };
    },
    methods: {
      async accepted(data) {
        try {
          if (data.status) {
            const remarks = prompt("Do you want to add any remarks?");
            const response = await router.post(route('schedule-update', {
              submission_id: data.submission_id,
              candidate_name: data.candidate_name,
              request_no: data.request_no,
              mobile_number: data.mobile_number,
              email_id: data.email_id,
              primary_skills: data.primary_skills,
              submitted_by: data.submitted_by,
              status: data.status,
              remarks:remarks
            }));
            if (response.data) {
              alert(response.data);
            }
          } else {
            alert("Status cannot be null");
          }
        } catch (error) {}
      },
      populateInput(result) {
        this.form.query = result.email_id || result.mobile_number;
        this.$refs.searchInput.focus();
        this.response = [];
        this.showNoData = false;
      },
      search() {
        if (this.form.query.length) {
          this.showNoData = true;
          axios
            .get(route("schedule-search", { query: this.form.query }))
            .then((response) => {
              this.response = response.data;
            })
            .catch((error) => {
              console.log("Error fetching the results:", error);
            });
        } else {
          this.showNoData = false;
        }
      },
      interview() {
        if (this.form.query.length) {
          router.post(route("candidate-schedule"), this.form, {
            preserveScroll: true,
            onSuccess: (data) => {
              // this.resetForm();
            },
          });
        }
      },
    },
  };
  </script>
  <style scoped>
  input,
  .btn {
    width: 100%;
    margin-bottom: 10px;
  }

  /* Tablet and above */
  @media (min-width: 768px) {
    input,
    .btn {
      width: 50%;
    }
  }

  /* Desktop and above */
  @media (min-width: 992px) {
    input,
    .btn {
      width: 30%;
    }
  }
  .search-results li:hover {
    cursor: pointer;
  }

  .accBtn {
    display: inline-block;
    padding: 8px 16px;
    background-color: rgb(15, 59, 74);
    color: white;
    border: none;
    cursor: pointer;
  }
  </style>
