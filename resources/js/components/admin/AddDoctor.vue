<template>
    <div class="container-fluid">
        <div class="panel">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">
                        <span class="new-doctor">{{ titleMode ? 'Update Doctor' : 'Add New Doctor' }}</span>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <router-link to="/clients/manage-doctor" class=""> <span class="btn btn-sm btn-primary pull-right manage-font">Manage Doctor</span></router-link>
                    </div>
                </div>
                <hr/>
                <div class="col-md-12">
                    <form method="POST" @submit.prevent="editMode ? update() : store()">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Doctor Name</label>
                                    <input type="text" name="name" v-model="name" class="form-control" placeholder="Doctor name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Doctor Email</label>
                                    <input type="email" name="email" v-model="email" class="form-control" placeholder="Doctor email">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Doctor Phone</label>
                                    <input type="number" name="phone" v-model="phone" class="form-control" placeholder="Doctor Phone">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Doctor NID</label>
                                    <input type="number" name="nid_no" v-model="nid_no" class="form-control" placeholder="Doctor NID Number">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Patient Visiting Day</label>
                                    <input type="text" name="visiting_day" v-model="visiting_day" class="form-control" placeholder="Doctor Visiting Day">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Patient Visiting Time</label>
                                    <input type="text" name="visiting_time" v-model="visiting_time" class="form-control" placeholder="Doctor Visiting time">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Patient Fee</label>
                                    <input type="text" name="visiting_fee" v-model="visiting_fee" class="form-control" placeholder="Doctor Visiting fee">
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
export default {
    data() {
        return {
            editMode: false,
            buttonMode: false,
            titleMode: false,
            id: '',
            name : '',
            email : '',
            phone : '',
            nid_no : '',
            visiting_day : '',
            visiting_time : '',
            visiting_fee : '',
        }
    },

    methods : {
        store() {
            axios.post('/clients/add-new-doctor', {
                name : this.name,
                email : this.email,
                phone : this.phone,
                nid_no : this.nid_no,
                visiting_day : this.visiting_day,
                visiting_time : this.visiting_time,
                visiting_fee : this.visiting_fee,
            }).then(response => {
                console.log(response)
            }).catch(error => {
                console.log(error)
            })
        },
        update() {

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
