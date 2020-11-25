<template>
    <div>
        <section class="content">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <span class="new-doctor">Employee Trash List</span>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="search" v-model="search" placeholder="Search Doctor Phone">
                                </div>
                                <div class="col-md-4">
                                    <router-link to="/employee/manage" class=""> <span class="btn btn-sm btn-primary pull-right manage-font">Employee Manage</span></router-link>
                                </div>
                            </div>
                            <br/>
                            <table id="employee">
                                <tr>
                                    <th width="5%">SL</th>
                                    <th width="10%">Avatar</th>
                                    <th width="15%">Name</th>
                                    <th width="25%">Designation</th>
                                    <th width="10%">Salary</th>
                                    <th width="15%">Phone</th>
                                    <th width="25%">Action</th>
                                </tr>
                                <tbody v-if="trashedEmployeePages.length > 0">
                                <tr v-for="(employee, index) in trashedEmployeePages[currentPage -1]" :key="employee.id" style="border: 1px solid #000000; padding: 50px;">
                                    <td>{{ index+1 }}</td>
                                    <td>
                                        <img :src="'/employees/' + employee.avatar" alt="avatar" style="width: 50px; height: 50px"><br/>
                                    </td>
                                    <td>
                                        <span style="text-transform: capitalize">{{ employee.name }}</span>
                                    </td>
                                    <td>
                                        <span style="text-transform: uppercase; font-weight: bold">{{ employee.designation }}</span>
                                    </td>
                                    <td>{{ employee.salary }}</td>
                                    <td>{{ employee.phone }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-warning" @click="restore(employee, index)">
                                            <i class="fa fa-refresh"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger" @click="destroy(employee, index)">
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
            trashedEmployees: [],
            trashedEmployeePages: [],
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
            this.generatePages(this.trashedEmployees)
            if (this.search != '') {
                let search = this.trashedEmployees.filter(employee => {
                    if (employee.phone.indexOf(this.search) !== -1) {
                        return employee
                    }
                })
                this.generatePages(search)
            }
        }
    },
    created() {
        //console.log('tets')
        axios.get('/employee/all/trashed/data')
            .then(response => {
                //console.log(response.data)
                this.trashedEmployees = response.data
                this.generatePages(this.trashedEmployees)
            }).catch(error => {
            console.log(error)
        })
    },
    methods : {
        destroy(employee, index) {
            alert('Are You Sure Delete this ?')
            axios.get('/employee/permanent/destroy/' + employee.id)
                .then(response => {
                    this.trashedEmployees.splice(index, 1)
                    flash('Employee has been permanently deleted')
                    this.generatePages(this.trashedEmployees)
                })
                .catch(error => {
                    console.log(error)
                })

        },
        restore(employee, index) {
            axios.get('/employee/restore/' + employee.id)
                .then(response => {
                    this.trashedEmployees.splice(index, 1)
                    flash('Employee restore successfully')
                    this.generatePages(this.trashedEmployees)
                })
                .catch(error => {
                    console.log(error)
                })

        },
        setCurrentPage (page) {
            this.currentPage = page
        },
        generatePages (trashedEmployees) {
            this.trashedEmployeePages = _.chunk(trashedEmployees, this.perPage)

            this.pageCount = 0
            this.pageCount = this.trashedEmployeePages.length
            if (this.pageCount === 0) {
                this.message = "Sorry! No trashed employee name found"
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
