<template>
    <div class="container-fluid">
        <div class="panel vld-parent">
            <loading :active.sync="isLoading"
                     :can-cancel="true"
                     :on-cancel="onCancel"
                     :is-full-page="fullPage"></loading>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">
                        <span class="new-doctor">{{ titleMode ? 'Update Employee Information' : 'Add New Employee' }}</span>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <router-link to="/employee/manage" class=""> <span class="btn btn-sm btn-primary pull-right manage-font">Manage Employee</span></router-link>
                    </div>
                </div>
                <hr/>
                <div class="col-md-12">
                    <form method="POST" @submit.prevent="editMode ? update() : store()">
                        <input type="hidden" id="id" name="id" v-model="id">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" v-model="name" class="form-control" placeholder="Employee name">
                                    <span class="text-danger">{{nameError}}</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Designation</label>
                                    <input type="text" name="designation" v-model="designation" class="form-control" placeholder="Employee Designation">
                                    <span class="text-danger">{{designationError}}</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Email <small style="color: red">( Optional )</small></label>
                                    <input type="email" name="email" v-model="email" class="form-control" placeholder="Doctor email">
                                    <span class="text-danger">{{emailError}}</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="number" name="phone" v-model="phone" class="form-control" placeholder="Employee Phone Number">
                                    <span class="text-danger">{{phoneError}}</span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Joining Date</label>
                                    <input type="date" name="joining_date" v-model="joining_date" class="form-control" placeholder="Employee joining date">
                                    <span class="text-black">{{joining_date}}</span>
                                    <span class="text-danger">{{joining_dateError}}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Salary</label>
                                <input type="number" class="form-control" name="salary" v-model="salary" placeholder="Employee Salary">
                                <span class="text-danger">{{salaryError}}</span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Date Of Birth <small style="color: red">( According to Certificate )</small></label>
                                    <input type="date" name="dob" v-model="dob" class="form-control" placeholder="Employee dob">
                                    <span class="text-danger">{{dobError}}</span>
                                    <span class="text-black">{{joining_date}}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Employee NID</label>
                                    <input type="number" name="nid_no" v-model="nid_no" class="form-control" placeholder="Doctor NID Number">
                                    <span class="text-danger">{{nidError}}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label>Avatar</label><br/>
                                <input id="avatar" type="file" class="form-control" name="avatar" @change="employeeAvatar" accept="image/*"><br/>
                                <small class="text-danger">{{ avatarError }}</small>
                                <img src=" " id="pre-avatar"/>
                                <img :src="'/employees/' + avatar" id="editImg" v-if="seen" style="height: 20%; width: 20%; border-radius: 5px;">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-sm btn-success pull-right manage-font">{{ buttonMode ? 'Update' : 'Create' }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
// Import component
import Loading from 'vue-loading-overlay';
// Import stylesheet
import 'vue-loading-overlay/dist/vue-loading.css';
export default {
    data() {
        return {
            // Condition
            isLoading: false,
            fullPage: true,
            editMode: false,
            buttonMode: false,
            titleMode: false,
            seen : false,

            // Store
            id: '',
            name : '',
            email : '',
            phone : '',
            designation : '',
            joining_date : '',
            salary : '',
            dob : '',
            nid_no: '',
            avatar: '',

            //Error Generate
            errorCount: 0,
            nameError : '',
            emailError : '',
            phoneError : '',
            nidError : '',
            designationError : '',
            joining_dateError : '',
            salaryError : '',
            avatarError: '',
            dobError: '',
        }
    },
    created() {
        this.editEmployee()
    },
    components: {
        Loading
    },
    methods: {
        onCancel() {
            console.log('User cancelled the loader.')
        },
        editEmployee () {
            axios.get(`/employee/edit/${this.$route.params.id}`)
                .then(response => {
                    if (response.data.name != undefined) {
                            this.editMode      = true,
                            this.titleMode     = true,
                            this.buttonMode    = true,
                            this.seen          = true,
                            this.id            = response.data.id,
                            this.name          = response.data.name,
                            this.email         = response.data.email,
                            this.phone         = response.data.phone,
                            this.nid_no        = response.data.nid_no,
                            this.designation   = response.data.designation,
                            this.joining_date  = response.data.joining_date,
                            this.dob           = response.data.dob,
                            this.salary        = response.data.salary,
                            this.avatar        = response.data.avatar
                    }
                }).catch(error => {
                console.log(error)
            })
        },
        employeeAvatar(e) {
            $('#editImg').hide()
            if (e.target.files[0]) {
                let image = e.target.files[0];
                if(image['type'] === 'image/jpeg' || image['type'] === 'image/png' || image['type'] === 'image/webp' || image['type'] === 'image/gif'){
                    let reader = new FileReader();
                    reader.onload = function ()
                    {
                        let output = document.getElementById('pre-avatar');
                        output.src = reader.result;
                        output.style.display = "block";
                        output.style.width = "25%";
                    }
                    reader.readAsDataURL(event.target.files[0]);
                }else{
                    console.log("This file not an Image", 'Error !!');
                }
            }
        },
        store () {
            this.isLoading = true
            const config = {
                headers: { 'content-type': 'multipart/form-data' }
            };
            let employee = new FormData ();
            let avatar = document.getElementById("avatar").files[0];
            employee.append('avatar', avatar);
            employee.append('name', this.name);
            employee.append('email', this.email);
            employee.append('phone', this.phone);
            employee.append('nid_no', this.nid_no);
            employee.append('designation', this.designation);
            employee.append('joining_date', this.joining_date);
            employee.append('salary', this.salary);
            employee.append('dob', this.dob);

            axios.post('/employee/store', employee, config)
            .then(response => {
                if (response.status === 201) {
                    this.isLoading = false
                    this.$router.push('/employee/manage')
                    flash('Add New Employee')
                    this.name = '';
                    this.email = '';
                    this.phone = '';
                    this.nid_no = '';
                    this.designation = '';
                    this.joining_date = '';
                    this.salary = '';
                    this.dob = '';
                    $('#avatar').val('');
                    $('#pre-logo').hide();
                }
            }).catch(error => {
                if (error.response.status === 422) {
                    this.isLoading = false
                    this.nameError = error.response.data.errors.name
                    this.emailError = error.response.data.errors.email
                    this.phoneError = error.response.data.errors.phone
                    this.nidError = error.response.data.errors.nid_no
                    this.designationError = error.response.data.errors.designation
                    this.joining_dateError = error.response.data.errors.joining_date
                    this.dobError = error.response.data.errors.dob
                    this.salaryError = error.response.data.errors.salary
                    this.avatarError = error.response.data.errors.avatar
                }
            })
        },
        update() {
            this.isLoading = true
            const config = {
                headers: { 'content-type': 'multipart/form-data' }
            };
            let employee = new FormData ();
            let avatar = document.getElementById("avatar").files[0];
            employee.append('avatar', avatar);
            employee.append('name', this.name);
            employee.append('email', this.email);
            employee.append('phone', this.phone);
            employee.append('nid_no', this.nid_no);
            employee.append('designation', this.designation);
            employee.append('joining_date', this.joining_date);
            employee.append('salary', this.salary);
            employee.append('dob', this.dob);

            axios.post('/employee/update/' + this.id, employee, config)
                .then(response => {
                    if (response.status === 201) {
                        this.isLoading = false
                        this.$router.push('/employee/manage')
                        flash('Employee has been updated')
                        this.name = '';
                        this.email = '';
                        this.phone = '';
                        this.nid_no = '';
                        this.designation = '';
                        this.joining_date = '';
                        this.salary = '';
                        this.dob = '';
                        $('#avatar').val('');
                        $('#pre-logo').hide();
                    }
                }).catch(error => {
                if (error.response.status === 422) {
                    this.isLoading = false
                    this.nameError = error.response.data.errors.name
                    this.emailError = error.response.data.errors.email
                    this.phoneError = error.response.data.errors.phone
                    this.nidError = error.response.data.errors.nid_no
                    this.designationError = error.response.data.errors.designation
                    this.joining_dateError = error.response.data.errors.joining_date
                    this.salaryError = error.response.data.errors.salary
                    this.avatarError = error.response.data.errors.avatar
                }
            })
        }
    }
}
</script>

<style scoped>
.manage-font {
    font-size: 15px;
}
.new-doctor {
    font-size: 24px;
}
</style>
