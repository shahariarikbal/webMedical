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
                        <span class="new-doctor">{{ titleMode ? 'Update Blood Donor Information' : 'Add New Blood Donor' }}</span>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <router-link to="/blood-donor/list/info" class=""> <span class="btn btn-sm btn-primary pull-right manage-font">Manage Blood Donor</span></router-link>
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
                                    <input type="text" name="name" v-model="name" class="form-control" placeholder="Blood Donor name">
                                    <span class="text-danger">{{nameError}}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="number" name="phone" v-model="phone" class="form-control" placeholder="Blood Donor Phone Number">
                                    <span class="text-danger">{{phoneError}}</span>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <label>Address</label>
                                <input type="text" class="form-control" name="address" v-model="address" placeholder="Blood Donor Address">
                                <span class="text-danger">{{addressError}}</span>
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
            phone : '',
            address: '',

            //Error Generate
            errorCount: 0,
            nameError : '',
            phoneError : '',
            addressError: '',
        }
    },
    created() {
        this.editBloodDonor()
    },
    components: {
        Loading
    },
    methods: {
        onCancel() {
            console.log('User cancelled the loader.')
        },
        editBloodDonor () {
            axios.get(`/blood-donor/edit/${this.$route.params.id}`)
                .then(response => {
                    if (response.data.name != undefined) {
                            this.editMode      = true,
                            this.titleMode     = true,
                            this.buttonMode    = true,
                            this.seen          = true,
                            this.id            = response.data.id,
                            this.name          = response.data.name,
                            this.phone         = response.data.phone,
                            this.address       = response.data.address
                    }
                }).catch(error => {
                console.log(error)
            })
        },
        store () {
            this.isLoading = true
            axios.post('/blood-donor/store',{
                name : this.name,
                phone : this.phone,
                address : this.address
            })
            .then(response => {
                if (response.status === 200) {
                    this.isLoading = false
                    flash('New Blood Donor added successfully')
                    this.$router.push('/blood-donor/list/info')
                }
            }).catch(error => {
                if (error.response.status === 422) {
                    this.isLoading = false
                    this.nameError = 'Name field is required'
                    this.phoneError = 'Phone field is required'
                    this.addressError = 'Address field is required'
                }
            })
        },
        update() {
            this.isLoading = true
            axios.post('/blood-donor/update',{
                name : this.name,
                phone : this.phone,
                address : this.address,
                id : this.id,
            })
            .then(response => {
                if (response.status === 200) {
                    this.isLoading = false
                    flash('Blood Donor updated successfully')
                    this.$router.push('/blood-donor/list/info')
                }
            }).catch(error => {
                if (error.response.status === 422) {
                    this.isLoading = false
                    this.nameError = 'Name field is required'
                    this.phoneError = 'Phone field is required'
                    this.addressError = 'Address field is required'
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
