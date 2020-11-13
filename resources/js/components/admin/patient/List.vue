<template>
    <div>
        <section class="content">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <span class="new-doctor">Patient's List</span>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="search" v-model="search" placeholder="Search Patient Phone">
                                </div>
                                <div class="col-md-4">
                                    <router-link to="/patient/create" class=""> <span class="btn btn-sm btn-primary pull-right manage-font">Add Patient</span></router-link>
                                </div>
                            </div>
                            <br/>
                            <table id="doctors">
                                <tr>
                                    <th width="5%">SL</th>
                                    <th width="10%">Name</th>
                                    <th width="15%">Phone</th>
                                    <th width="20%">Email</th>
                                    <th width="10%">Sex</th>
                                    <th width="13%">Action</th>
                                </tr>
                                <tbody v-if="patientsPages.length > 0">
                                    <tr v-for="(patient, index) in patientsPages[currentPage -1]" :key="patient.id" style="border: 1px solid #000000; padding: 50px;">
                                        <td>{{ ++index }}</td>
                                        <td>
                                            {{patient.name}}
                                        </td>
                                        <td>
                                            {{patient.phone}}
                                        </td>
                                        <td>{{ patient.email }}</td>
                                        <td v-if="patient.sex===1">Male</td>
                                        <td v-else>Female</td>
                                        <td>
                                            <router-link :to="`/patient/details/info/${patient.id}`" class="btn btn-sm btn-primary">
                                                <i class="fa fa-eye"></i>
                                            </router-link>
                                            <router-link :to="`/patient/edit/info/${patient.id}`" type="button" class="btn btn-sm btn-success">
                                                <i class="fa fa-edit"></i>
                                            </router-link>
                                            <button type="button" class="btn btn-sm btn-danger" @click="destroy(patient.id)">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tbody v-else>
                                    <tr>
                                        <td colspan="6" style="background-color: darkorange" role="alert"><span style="color: white; font-size: 18px;">{{ message }}</span></td>
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
    name: "List",
    data () {
        return {
            patients: [],
            patientsPages: [],
            perPage: 2,
            pageCount: 1,
            currentPage: 1,
            search: '',
            message: 'No Data Found',
        }
    },
    watch: {
        search (value) {
            this.setCurrentPage(1)
            this.generatePages(this.patients)
            if (this.search != '') {
                let search = this.patients.filter(p => {
                    if (p.phone.indexOf(this.search) !== -1) {
                        return p
                    }
                })
                this.generatePages(search)
            }
        },
    },
    created(){
        this.getPatients()
    },
    methods:{
        getPatients(){
            axios.get('all/patients')
            .then(response =>{
                this.patients = response.data
                this.generatePages(this.patients)
            })
            .catch(error =>{
                console.log(error)
            })
        },
        destroy(patientId) {
            let ans = confirm('Are You Sure Delete this ?')
            if(ans === true){
                axios.get('delete/patient/'+patientId)
                .then(response => {
                    flash('Patient has been deleted')
                    this.getPatients()
                    this.generatePages(this.patients)
                })
                .catch(error => {
                    console.log(error)
                })
            }

        },
        setCurrentPage (page) {
            this.currentPage = page
        },
        generatePages (patients) {
            this.patientsPages = _.chunk(patients, this.perPage)

            this.pageCount = 0
            this.pageCount = this.patientsPages.length
            if (this.pageCount === 0) {
                this.message = "Sorry! No Patient name Found"
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