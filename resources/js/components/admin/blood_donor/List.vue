<template>
    <div>
        <section class="content">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <span class="new-doctor">Blood Donor List</span>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="search" v-model="search" placeholder="Search Blood Donor Phone">
                                </div>
                                <div class="col-md-4">
                                    <router-link to="/blood-donor/add" class=""> <span class="btn btn-sm btn-primary pull-right manage-font">Add Blood Donor</span></router-link>
                                    <router-link to="/blood-donor/trash/info"> <span class="btn btn-sm btn-danger manage-font pull-right" style="margin-right: 15px;">Trash List</span></router-link>
                                </div>
                            </div>
                            <br/>
                            <table id="employee">
                                <tr>
                                    <th width="5%">SL</th>
                                    <th width="15%">Name</th>
                                    <th width="15%">Phone</th>
                                    <th width="15%">Address</th>
                                    <th width="15%">Action</th>
                                </tr>
                                <tbody v-if="bloodDonorPages.length > 0">
                                <tr v-for="(bloodDonor, index) in bloodDonorPages[currentPage -1]" :key="bloodDonor.id" style="border: 1px solid #000000; padding: 50px;">
                                    <td>{{ index+1 }}</td>
                                    <td>
                                        <span style="text-transform: capitalize">{{ bloodDonor.name }}</span>
                                    </td>
                                    <td>{{ bloodDonor.phone }}</td>
                                    <td>{{ bloodDonor.address }}</td>
                                    <td style="width: 15%">
                                        <router-link :to="`/bloodDonor/details/info/${bloodDonor.id}`" class="btn btn-sm btn-primary">
                                            <i class="fa fa-eye"></i>
                                        </router-link>
                                        <router-link :to="`/bloodDonor/edit/info/${bloodDonor.id}`" type="button" class="btn btn-sm btn-success">
                                            <i class="fa fa-edit"></i>
                                        </router-link>
                                        <button type="button" class="btn btn-sm btn-danger" @click="destroy(bloodDonor, index)">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                                <tbody v-else>
                                <tr>
                                    <td colspan="7" style="background-color: orangered" role="alert"><span style="color: black; font-size: 18px;color:white;">{{ message }}</span></td>
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
            bloodDonors: [],
            bloodDonorPages: [],
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
            this.generatePages(this.bloodDonors)
            if (this.search != '') {
                let search = this.bloodDonors.filter(bloodDonor => {
                    if (bloodDonor.phone.indexOf(this.search) !== -1) {
                        return bloodDonor
                    }
                })
                this.generatePages(search)
            }
        }
    },
    created() {
        axios.get('/blood-donor/list')
            .then(response => {
                this.bloodDonors = response.data
                //console.log(response)
                this.generatePages(this.bloodDonors)
            }).catch(error => {
            console.log(error)
        })
    },
    methods : {
        destroy(bloodDonor, index) {
            alert('Are You Sure Delete this ?')
            axios.get('/bloodDonor/destroy/' + bloodDonor.id)
                .then(response => {
                    this.bloodDonors.splice(index, 1)
                    flash('BloodDonor has been deleted')
                    this.generatePages(this.bloodDonors)
                })
                .catch(error => {
                    console.log(error)
                })

        },
        setCurrentPage (page) {
            this.currentPage = page
        },
        generatePages (bloodDonors) {
            this.bloodDonorPages = _.chunk(bloodDonors, this.perPage)

            this.pageCount = 0
            this.pageCount = this.bloodDonorPages.length
            if (this.pageCount === 0) {
                this.message = "Sorry! No Blood-Donor name found"
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
