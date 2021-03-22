<template>
    <div>
        <section class="content">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <span class="new-doctor">Employee List</span>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="search" v-model="search" placeholder="Search Doctor Phone">
                                </div>
                                <div class="col-md-4">
                                    <router-link to="/employee/create" class=""> <span class="btn btn-sm btn-primary pull-right manage-font">Add Employee</span></router-link>
                                    <router-link to="/employee/trash/list/info"> <span class="btn btn-sm btn-danger manage-font pull-right" style="margin-right: 15px;">Trash List</span></router-link>
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
                                <tbody v-if="employeePages.length > 0">
                                <tr v-for="(employee, index) in employeePages[currentPage -1]" :key="employee.id" style="border: 1px solid #000000; padding: 50px;">
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
                                        <div class="dropdown show">
                                                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink+employee.id" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Dropdown link
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink+employee.id" style="background-transparent;">
                                                    <center>
                                                    <router-link :to="`/employee/details/info/${employee.id}`" style="width: 106px;" class="btn btn-sm btn-primary">
                                                        View Employee
                                                    </router-link>
                                                    <router-link :to="`/employee/edit/info/${employee.id}`" type="button" style="width: 106px;" class="btn btn-sm btn-success">
                                                        Edit Employee
                                                    </router-link>
                                                    <button type="button" style="width: 106px;" class="btn btn-sm btn-danger" @click="destroy(employee, index)">
                                                        Delete Employee
                                                    </button>
                                                    </center>
                                                </div>
                                        </div>
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
            employees: [],
            employeePages: [],
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
            this.generatePages(this.employees)
            if (this.search != '') {
                let search = this.employees.filter(employee => {
                    if (employee.phone.indexOf(this.search) !== -1) {
                        return employee
                    }
                })
                this.generatePages(search)
            }
        }
    },
    created() {
        axios.get('/employee/list')
            .then(response => {
                this.employees = response.data
                this.generatePages(this.employees)
            }).catch(error => {
            console.log(error)
        })
    },
    methods : {
        destroy(employee, index) {
            alert('Are You Sure Delete this ?')
            axios.get('/employee/destroy/' + employee.id)
                .then(response => {
                    this.employees.splice(index, 1)
                    flash('Employee has been deleted')
                    this.generatePages(this.employees)
                })
                .catch(error => {
                    console.log(error)
                })

        },
        setCurrentPage (page) {
            this.currentPage = page
        },
        generatePages (employees) {
            this.employeePages = _.chunk(employees, this.perPage)

            this.pageCount = 0
            this.pageCount = this.employeePages.length
            if (this.pageCount === 0) {
                this.message = "Sorry! No employee name found"
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
