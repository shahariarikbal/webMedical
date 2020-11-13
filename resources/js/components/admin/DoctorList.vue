<template>
    <div>
        <section class="content">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <span class="new-doctor">Doctor's List</span>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="search" v-model="search" placeholder="Search Doctor Phone">
                                </div>
                                <div class="col-md-4">
                                    <router-link to="/clients/add-new-doctor" class=""> <span class="btn btn-sm btn-primary pull-right manage-font">Add Doctor</span></router-link>
                                </div>
                            </div>
                            <br/>
                            <table id="doctors">
                                <tr>
                                    <th width="5%">SL</th>
                                    <th width="15%">Avatar</th>
                                    <th width="25%">Name/Degree</th>
                                    <th width="20%">Email</th>
                                    <th width="15%">Phone</th>
                                    <th width="22%">Action</th>
                                </tr>
                                <tbody v-if="doctorsPages.length > 0">
                                    <tr v-for="(doctor, index) in doctorsPages[currentPage -1]" :key="doctor.id" style="border: 1px solid #000000; padding: 50px;">
                                        <td>{{ index+1 }}</td>
                                        <td>
                                            <img :src="'/avatar/' + doctor.avatar" alt="avatar" style="width: 80px; height: 80px">
                                        </td>
                                        <td>
                                            <span style="text-transform: capitalize">{{ doctor.name }}</span> <br/>
                                            <span style="text-transform: uppercase; font-weight: bold">{{ doctor.doctor_degree }}</span>
                                        </td>
                                        <td>{{ doctor.email }}</td>
                                        <td>{{ doctor.phone }}</td>
                                        <td>
                                            <router-link :to="`/clients/doctor/details/info/${doctor.id}`" class="btn btn-sm btn-primary">
                                                <i class="fa fa-eye"></i>
                                            </router-link>
                                            <router-link :to="`/clients/doctor/edit/info/${doctor.id}`" type="button" class="btn btn-sm btn-success">
                                                <i class="fa fa-edit"></i>
                                            </router-link>
                                            <button type="button" class="btn btn-sm btn-danger" @click="destroy(doctor, index)">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tbody v-else>
                                    <tr>
                                        <td colspan="6" style="background-color: darkorange" role="alert"><span style="color: black; font-size: 18px;">{{ message }}</span></td>
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
            doctors: [],
            doctorsPages: [],
            perPage: 1,
            pageCount: 1,
            currentPage: 1,
            search: '',
            message: 'No Data Found',
        }
    },
    watch: {
        search (value) {
            this.setCurrentPage(1)
            this.generatePages(this.doctors)
            if (this.search != '') {
                let search = this.doctors.filter(d => {
                    if (d.phone.indexOf(this.search) !== -1) {
                        return d
                    }
                })
                this.generatePages(search)
            }
        }
    },
    created() {
        //console.log('tets')
        axios.get('/clients/all/doctors')
            .then(response => {
                //console.log(response.data)
                this.doctors = response.data
                this.generatePages(this.doctors)
            }).catch(error => {
            console.log(error)
        })
    },
    methods: {
        destroy(doctor, index) {
            alert('Are You Sure Delete this ?')
            axios.delete('/clients/delete/doctor/' + doctor.id)
                .then(response => {
                    this.doctors.splice(index, 1)
                    flash('Doctor has been deleted')
                    this.generatePages(this.doctors)
                })
                .catch(error => {
                    console.log(error)
                })

        },
        setCurrentPage (page) {
            this.currentPage = page
        },
        generatePages (doctors) {
            this.doctorsPages = _.chunk(doctors, this.perPage)

            this.pageCount = 0
            this.pageCount = this.doctorsPages.length
            if (this.pageCount === 0) {
                this.message = "Sorry! No Doctor name Found"
            }
        },
    }
}
</script>

<style scoped>
#doctors {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

#doctors td, #doctors th {
    border: 1px solid #ddd;
    padding: 8px;
}

#doctors tr:nth-child(even){background-color: #f2f2f2;}

#doctors tr:hover {background-color: #ddd;}

#doctors th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #4CAF50;
    color: white;
}
.manage-font {
    font-size: 15px;
}
.new-doctor {
    font-size: 24px;
}
</style>
