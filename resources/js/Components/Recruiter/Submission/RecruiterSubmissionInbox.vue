<template>
    <div class="pcoded-content">
        <div class="pcoded-inner-content">
            <div class="main-body">
                <div class="page-wrapper">
                    <div class="page-body">
                        <div class="card">
                            <div class="card-block email-card">
                                <div class="row">
                                    <div class="col-lg-12 col-xl-3">
                                        <div class="user-head row">
                                            <div class="user-face">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-xl-9">
                                        <div class="mail-box-head row justify-content-end">
                                            <div class="col-auto">
                                                <form class="form-material">
                                                    <div class="material-group">
                                                        <div class="form-group form-default">
                                                            <input type="text" placeholder="Search" class="form-control search-input" v-model="searchTerm" @input="filterEmails" required>
                                                            <span class="form-bar"></span>
                                                        </div>
                                                        <div class="material-addone">
                                                            <i class="icofont icofont-search"></i>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-xl-3">
                                        <div class="user-body">
                                            <ul class="page-list nav nav-tabs flex-column" id="pills-tab" role="tablist">
                                                <div class="inbox">
                                                    <li class="nav-item mail-section">
                                                        <a class="nav-link waves-effect d-block  active" @click.prevent="toggle()" data-toggle="pill" href="#e-inbox" role="tab">
                                                            <i class="icofont icofont-inbox"></i> Inbox
                                                            <span class="label label-primary float-right">{{ unreadCount }}</span>
                                                        </a>
                                                    </li>
                                                </div>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-xl-9">
                                        <div class="tab-content" id="pills-tabContent">
                                            <div class="tab-pane fade show active" id="e-inbox" role="tabpanel">
                                                <div class="mail-body">
                                                    <div class="mail-body-content">
                                                        <div class="table-responsive" v-show="isTableVisible">
                                                            <table class="table">
                                                                <tr v-for="email in filteredEmails" :key="email.id" @click.prevent="toggleView(email)" >
                                                                    <td>
                                                                        <div class="check-star">
                                                                            <i class="fas fa-star"></i>
                                                                        </div>
                                                                    </td>
                                                                    <td><a href="#" class="email-name waves-effect">{{ email.created_by }}</a></td>
                                                                    <td><a href="#" class="email-name waves-effect">{{ truncateSubject(email.subject_line) }}</a></td>
                                                                    <td class="email-attch">
                                                                        <a v-if="email.file_upload_jd" href="#"><i class="icofont icofont-clip"></i></a>
                                                                        <span v-else>null</span>
                                                                    </td>
                                                                    <td class="email-time">{{ formatTime(email.created_at) }}</td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                        <div v-show="displayCard" class="card">
                                                            <div class="p-20 text-center">
                                                                <a v-if="selectedEmail" :href="route('submission-active', { id: selectedEmail.request_id })" class="btn_mail">Submit</a>
                                                            </div>
                                                            <div class="card-header">
                                                                <h5 v-if="selectedEmail">{{ truncateSubject(selectedEmail.subject_line)}}...</h5>
                                                                <h6 v-if="selectedEmail" class="float-right">{{ formatTime(selectedEmail.created_at) }}</h6>
                                                            </div>
                                                            <div class="card-block">
                                                                <div class="media m-b-20">
                                                                    <div class="media-left photo-table">
                                                                        <a v-if="selectedEmail && selectedEmail.img" href="#">
                                                                            <img class="media-object img-radius" src="#" alt="E-mail User">
                                                                        </a>
                                                                    </div>
                                                                    <div class="media-body photo-contant">
                                                                        <a href="#">
                                                                            <h6 v-if="selectedEmail" class="user-name txt-primary">{{selectedEmail.employee_name}}</h6>
                                                                        </a>
                                                                        <a class="user-mail txt-muted" href="#">
                                                                            <h6  v-if="selectedEmail">From:<span class="__cf_email__" data-cfemail="38525750565c575d090d0c0b785f55595154165b5755"> {{ selectedEmail.created_by }}</span></h6>
                                                                        </a>
                                                                        <div>
                                                                            <h6 class="email-welcome-txt">Hi,</h6>
                                                                            <p class="email-content"  v-if="selectedEmail" >
                                                                                {{ selectedEmail.request_body }}
                                                                            </p>
                                                                        </div>
                                                                        <div v-if="selectedEmail && selectedEmail.file_upload_jd" class="m-t-15">
                                                                            <i class="icofont icofont-clip f-20 m-r-10"></i>Attachments <b>(1)</b>
                                                                            <div class="row mail-img m-b-20">
                                                                                <div class="col-sm-4 col-md-2 col-xs-12">
                                                                                    <a :href="route('open-excel', { fileName: encodeURIComponent(selectedEmail.file_upload_jd).trim(), })"  rel="noopener noreferrer">View File</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="pagination">
                                                        <button @click="prevPage" :disabled="currentPage === 1" class="pagination-button" :class="{ 'pagination-button-disabled': currentPage === 1 }">Prev</button>
                                                        <span class="pagination-info">Page {{ isNaN(totalPages) ? 'Loading...' : `${currentPage} of ${totalPages}` }}</span>
                                                        <button @click="nextPage" :disabled="currentPage === totalPages" class="pagination-button" :class="{ 'pagination-button-disabled': currentPage === totalPages }">Next</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
export default {
    name: 'Inbox',

    data() {
        return {
            // Define your data variables here
        };
    },

    computed: {
        // Define your computed properties here
    },

    methods: {
        // Define your methods here
    }
}
</script>



