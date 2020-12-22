<template>
    <div>
        <section class="content">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <span class="new-doctor">Blood Donor Trash List</span>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="search" v-model="search" placeholder="Search Blood Donor Phone">
                                </div>
                                <div class="col-md-4">
                                    <router-link to="/blood-donor/list/info" class=""> <span class="btn btn-sm btn-primary pull-right manage-font">Manage Blood Donor</span></router-link>
                                </div>
                            </div>
                            <br/>
                            <table id="employee">
                                <tr>
                                    <th width="5%">SL</th>
                                    <th width="15%">Name</th>
                                    <th width="25%">Phone</th>
                                    <th width="10%">Address</th>
                                    <th width="25%">Action</th>
                                </tr>
                                <tbody v-if="trashedBloodDonorPages.length > 0">
                                <tr v-for="(bloodDonor, index) in trashedBloodDonorPages[currentPage -1]" :key="bloodDonor.id" style="border: 1px solid #000000; padding: 50px;">
                                    <td>{{ index+1 }}</td>
                                    <td>
                                        <span style="text-transform: capitalize">{{ bloodDonor.name }}</span>
                                    </td>
                                    <td>
                                        <span style="text-transform: uppercase; font-weight: bold">{{ bloodDonor.phone }}</span>
                                    </td>
                                    <td>{{ bloodDonor.address }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-warning" @click="restore(bloodDonor.id)">
                                            <i class="fa fa-refresh"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger" @click="destroy(bloodDonor.id)">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                                <tbody v-else>
                                <tr>
                                    <td colspan="7" style="background-color: orangered" role="alert"><span style="color: black; font-size: 18px;">{{ message }}</span></td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <paginate
                                            v-if="pageCount > 1"
                                            :page-count="pageCount"
                                            v-model="currentPage"
                                            :prev-text="'Prev'"
                                            :next-text="'Next'"
                                            :container-class="'pagination justify-content-center'"
                                        >
                                        </paginate>
                                    </div>
                                    <div class="col-md-4"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    data () {
        return {
            trashedBloodDonors: [],
            trashedBloodDonorPages: [],
            perPage: 10,
            pageCount: 1,
            currentPage: 1,
            search: '',
            message: 'No Data Found',
        }
    },
    watch: {
        search (value) {
            this.setCurrentPage(1)
            this.generatePages(this.trashedBloodDonors)
            if (this.search != '') {
                let search = this.trashedBloodDonors.filter(bloodDonor => {
                    if (bloodDonor.phone.indexOf(this.search) !== -1) {
                        return bloodDonor
                    }
                })
                this.generatePages(search)
            }
        }
    },
    created() {
        this.getTrashed()
    },
    methods : {
        getTrashed(){
                axios.get('/blood-donor/all/trashed/data')
                .then(response => {
                    this.trashedBloodDonors = response.data
                    this.generatePages(this.trashedBloodDonors)
                }).catch(error => {
                console.log(error)
            })
        },
        destroy(id) {
            let res = confirm('Are you sure to delete this permanently')
            if (res == true) {
                axios.get('/blood-donor/permanent/destroy/' + id)
                .then(response => {
                    flash('Blood Donor has been permanently deleted')
                    this.getTrashed()
                    this.generatePages(this.trashedBloodDonors)
                })
                .catch(error => {
                    console.log(error)
                })
            }

        },
        restore(id) {
            axios.get('/blood-donor/restore/' + id)
                .then(response => {
                    this.getTrashed()
                    flash('Blood Donor restored successfully')
                    this.generatePages(this.trashedBloodDonors)
                })
                .catch(error => {
                    console.log(error)
                })

        },
        setCurrentPage (page) {
            this.currentPage = page
        },
        generatePages (trashedBloodDonors) {
            this.trashedBloodDonorPages = _.chunk(trashedBloodDonors, this.perPage)

            this.pageCount = 0
            this.pageCount = this.trashedBloodDonorPages.length
            if (this.pageCount === 0) {
                this.message = "Sorry! No trashed Blood Donor name found"
            }
        },
    }
}
</script>

<style scoped>
#employee {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

#employee td, #employee th {
    border: 1px solid #ddd;
    padding: 8px;
}

#employee tr:nth-child(even){background-color: #f2f2f2;}

#employee tr:hover {background-color: #ddd;}

#employee th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #000000;
    color: white;
}
.manage-font {
    font-size: 15px;
}
.new-doctor {
    font-size: 24px;
}
</style>
