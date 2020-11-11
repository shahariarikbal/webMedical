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
                        <span class="new-doctor">{{ titleMode ? 'Update Doctor Information' : 'Add New Doctor' }}</span>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <router-link to="/clients/doctors/list" class=""> <span class="btn btn-sm btn-primary pull-right manage-font">Manage Doctor</span></router-link>
                    </div>
                </div>
                <hr/>
                <div class="col-md-12">
                    <form method="POST" @submit.prevent="editMode ? update() : store()">
                        <input type="hidden" id="id" name="id" v-model="id">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Doctor Name</label>
                                    <input type="text" name="name" v-model="name" class="form-control" placeholder="Doctor name">
                                    <span class="text-danger">{{nameError}}</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Degree</label>
                                    <input type="text" name="doctor_degree" v-model="doctor_degree" class="form-control" placeholder="Doctor degree">
                                    <span class="text-danger">{{doctor_degreeError}}</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Doctor Email</label>
                                    <input type="email" name="email" v-model="email" class="form-control" placeholder="Doctor email">
                                    <span class="text-danger">{{emailError}}</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Specialist</label>
                                    <input type="text" name="specialist" v-model="specialist" class="form-control" placeholder="Doctor specialist">
                                    <span class="text-danger">{{specialistError}}</span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Doctor Phone</label>
                                    <input type="number" name="phone" v-model="phone" class="form-control" placeholder="Doctor Phone">
                                    <span class="text-danger">{{phoneError}}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Doctor NID</label>
                                    <input type="number" name="nid_no" v-model="nid_no" class="form-control" placeholder="Doctor NID Number">
                                    <span class="text-danger">{{nidError}}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label>Avatar</label><br/>
                                <input id="avatar" type="file" class="form-control" name="avatar" @change="doctorAvatar" accept="image/*"><br/>
                                <small class="text-danger">{{ avatarError }}</small>
                                <img src=" " id="pre-logo"/>
                                <img :src="'/avatar/' + avatar" id="editImg" v-if="seen" style="height: 20%; width: 20%; border-radius: 5px;">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Patient Visiting Day</label>
                                    <input type="text" name="visiting_day" v-model="visiting_day" class="form-control" placeholder="Doctor Visiting Day">
                                    <span class="text-danger">{{visiting_dayError}}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Patient Visiting Time</label>
                                    <input type="text" name="visiting_time" v-model="visiting_time" class="form-control" placeholder="Doctor Visiting time">
                                    <span class="text-danger">{{visiting_timeError}}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Patient Fee</label>
                                    <input type="text" name="visiting_fee" v-model="visiting_fee" class="form-control" placeholder="Doctor Visiting fee">
                                    <span class="text-danger">{{visiting_feeError}}</span>
                                </div>
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
            nid_no : '',
            visiting_day : '',
            visiting_time : '',
            visiting_fee : '',
            specialist: '',
            avatar: '',
            doctor_degree: '',

            //Error Generate
            errorCount: 0,
            nameError : '',
            emailError : '',
            phoneError : '',
            nidError : '',
            visiting_dayError : '',
            visiting_timeError : '',
            visiting_feeError : '',
            avatarError: '',
            specialistError: '',
            doctor_degreeError: '',
        }
    },

    created() {
      this.editDoctor()
    },

    components: {
        Loading
    },

    methods : {
        editDoctor () {
            axios.get(`/clients/doctor/edit/${this.$route.params.id}`)
                .then(response => {
                    this.editMode = true,
                    this.titleMode = true,
                    this.buttonMode = true,
                    this.seen = true,
                    this.id = response.data.id,
                    this.name = response.data.name,
                    this.email = response.data.email,
                    this.phone = response.data.phone,
                    this.nid_no = response.data.nid_no,
                    this.visiting_day = response.data.visiting_day,
                    this.visiting_time = response.data.visiting_time,
                    this.visiting_fee = response.data.visiting_fee,
                    this.specialist = response.data.specialist,
                    this.doctor_degree = response.data.doctor_degree,
                    this.avatar = response.data.avatar
                }).catch(error => {
                console.log(error)
            })
        },
        doctorAvatar (e) {
            $('#editImg').hide()
            if (e.target.files[0]) {
                let image = e.target.files[0];
                if(image['type'] === 'image/jpeg' || image['type'] === 'image/png' || image['type'] === 'image/webp' || image['type'] === 'image/gif'){
                    let reader = new FileReader();
                    reader.onload = function ()
                    {
                        let output = document.getElementById('pre-logo');
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
        store() {
            this.isLoading = true
            const config = {
                headers: { 'content-type': 'multipart/form-data' }
            };
            let doctorData = new FormData();
            let avatar = document.getElementById("avatar").files[0];
                doctorData.append('avatar', avatar);
                doctorData.append('name', this.name);
                doctorData.append('email', this.email);
                doctorData.append('phone', this.phone);
                doctorData.append('nid_no', this.nid_no);
                doctorData.append('visiting_day', this.visiting_day);
                doctorData.append('visiting_time', this.visiting_time);
                doctorData.append('visiting_fee', this.visiting_fee);
                doctorData.append('specialist', this.specialist);
                doctorData.append('doctor_degree', this.doctor_degree);

            axios.post('/clients/add-new-doctor', doctorData, config)
                .then(response => {
                console.log(response)
                if (response.status === 201) {
                    this.isLoading = false
                    flash('Add New Doctor successfully')
                    this.name = '';
                    this.email = '';
                    this.phone = '';
                    this.nid_no = '';
                    this.visiting_day = '';
                    this.visiting_time = '';
                    this.visiting_fee = '';
                    this.specialist = '';
                    this.doctor_degree = '';
                    $('#avatar').val('');
                    $('#pre-logo').hide();
                }
            }).catch(error => {
                console.log(error)
                if (error.response.status === 422) {
                    this.isLoading = false
                    this.nameError = error.response.data.errors.name
                    this.emailError = error.response.data.errors.email
                    this.phoneError = error.response.data.errors.phone
                    this.nidError = error.response.data.errors.nid_no
                    this.visiting_dayError = error.response.data.errors.visiting_day
                    this.visiting_timeError = error.response.data.errors.visiting_time
                    this.visiting_feeError = error.response.data.errors.visiting_fee
                    this.visiting_feeError = error.response.data.errors.visiting_fee
                    this.specialistError = error.response.data.errors.specialist
                    this.avatarError = error.response.data.errors.avatar
                    this.doctor_degreeError = error.response.data.errors.doctor_degree
                }
            })
        },
        onCancel() {
            console.log('User cancelled the loader.')
        },
        update() {
            this.isLoading = true
            const config = {
                headers: { 'content-type': 'multipart/form-data' }
            };
            let doctorData = new FormData();
            let avatar = document.getElementById("avatar").files[0];
            doctorData.append('avatar', avatar);
            doctorData.append('name', this.name);
            doctorData.append('email', this.email);
            doctorData.append('phone', this.phone);
            doctorData.append('nid_no', this.nid_no);
            doctorData.append('visiting_day', this.visiting_day);
            doctorData.append('visiting_time', this.visiting_time);
            doctorData.append('visiting_fee', this.visiting_fee);
            doctorData.append('specialist', this.specialist);
            doctorData.append('doctor_degree', this.doctor_degree);

            axios.post('/clients/doctor/update/' + this.id, doctorData, config)
                .then(response => {
                    console.log(response)
                    if (response.status === 200) {
                        this.isLoading = false
                        flash('Doctor Information Updated')
                    }
                }).catch(error => {
                console.log(error)
                if (error.response.status === 422) {
                    this.isLoading = false
                    this.nameError = error.response.data.errors.name
                    this.emailError = error.response.data.errors.email
                    this.phoneError = error.response.data.errors.phone
                    this.nidError = error.response.data.errors.nid_no
                    this.visiting_dayError = error.response.data.errors.visiting_day
                    this.visiting_timeError = error.response.data.errors.visiting_time
                    this.visiting_feeError = error.response.data.errors.visiting_fee
                    this.visiting_feeError = error.response.data.errors.visiting_fee
                    this.specialistError = error.response.data.errors.specialist
                    this.avatarError = error.response.data.errors.avatar
                    this.doctor_degreeError = error.response.data.errors.doctor_degree
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
