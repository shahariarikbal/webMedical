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
                        <span class="new-patient">{{ titleMode ? 'Update Patient Information' : 'Add New Patient' }}</span>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <router-link to="/patient/list" class=""> <span class="btn btn-sm btn-primary pull-right manage-font">Manage Patients</span></router-link>
                    </div>
                </div>
                <hr/>
                <div class="col-md-12">
                    <form method="POST" @submit.prevent="editMode ? update() : store()">
                         <input type="text" id="id" name="id" v-model="id">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Patient Name</label>
                                    <input type="text" name="name" v-model="name" class="form-control" placeholder="Patient name">
                                    <span class="text-danger">{{nameError}}</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Patient Phone</label>
                                    <input type="text" name="phone" v-model="phone" class="form-control" placeholder="Patient phone">
                                    <span class="text-danger">{{phoneError}}</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Patient Email</label>
                                    <input type="email" name="email" v-model="email" class="form-control" placeholder="Patient email">
                                    <span class="text-danger">{{emailError}}</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Patient Father Name</label>
                                    <input type="text" name="father_name" v-model="father_name" class="form-control" placeholder="Patient father name">
                                    <span class="text-danger">{{fatherNameError}}</span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Patient/Patient Father NID</label>
                                    <input type="text" name="nid" v-model="nid" class="form-control" placeholder="Patient/Patient father name">
                                    <span class="text-danger">{{nidError}}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Patient Address</label>
                                    <input type="text" name="address" v-model="address" class="form-control" placeholder="Patient address">
                                    <span class="text-danger">{{addressError}}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Patient Cabin</label>
                                    <input type="number" name="cabin" v-model="cabin" class="form-control" placeholder="Patient cabin">
                                    <span class="text-danger">{{cabinError}}</span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Patient Bed</label>
                                    <input type="number" name="bed" v-model="bed" class="form-control" placeholder="Patient bed">
                                    <span class="text-danger">{{bedError}}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Patient Diseas</label>
                                    <input type="text" name="diseas" v-model="diseas" class="form-control" placeholder="Patient diseas">
                                    <span class="text-danger">{{diseasError}}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="sex">Patient Sex</label>
                                    <select v-model="sex" name="sex" id="sex" class="form-control">
                                        <option disabled value="">Please select your sex</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        </select>
                                        <span>Selected: {{ sex }}</span>
                                    <span class="text-danger">{{sexError}}</span>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-sm btn-success pull-right manage-font">{{ buttonMode ? 'Update' : 'Register' }}</button>
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
   data(){
       return{
           // Mode Condition
           isLoading: false,
           fullPage: true,
           titleMode   : false,
           editMode    : false,
           buttonMode  : false,

           // Store items
           id: '',
           name        : '',
           phone       : '',
           email       : '',
           father_name : '',
           nid         : '',
           address     : '',
           cabin       : '',
           bed         : '',
           diseas      : '',
           sex         : '',


           // Error messages
           nameError       : '',
           phoneError      : '',
           emailError      : '',
           fatherNameError : '',
           nidError        : '',
           addressError    : '',
           cabinError      : '',
           bedError        : '',
           diseasError     : '',
           sexError        : '',
       }
   },
    components: {
        Loading
    },
   created(){
       this.edit()
   },
   methods:{
       onCancel() {
           console.log('User cancelled the loader.')
       },
       edit(){
           axios.get(`/patient/edit/${this.$route.params.id}`)
           .then(response =>{
               this.titleMode = true
               this.editMode = true
               this.buttonMode = true

               this.id = response.data.id
               this.name = response.data.name
               this.phone = response.data.phone
               this.email = response.data.email
               this.father_name = response.data.father_name
               this.nid         = response.data.nid
               this.address     = response.data.address
               this.cabin       = response.data.cabin
               this.bed = response.data.cabin
               this.diseas = response.data.disease
               if(response.data.sex === 1){
                   this.sex = 'Male'
               }else{
                   this.sex = 'Female'
               }
           })
           .catch(error =>{
               console.log(error)
           })
       },
       store(){
           this.isLoading = true
           axios.post('store',{
                name        : this.name,
                phone       : this.phone,
                email       : this.email,
                father_name : this.father_name,
                nid         : this.nid,
                address     : this.address,
                cabin       : this.cabin,
                bed         : this.bed,
                diseas      : this.diseas,
                sex         : this.sex,
           })
           .then(response =>{
               this.isLoading = false
                this.name        = ''
                this.phone       = ''
                this.email       = ''
                this.father_name = ''
                this.nid         = ''
                this.address     = ''
                this.cabin       = ''
                this.bed         = ''
                this.diseas      = ''
                this.sex         = ''
                this.sexError    = ''
               flash('New patient insert successfully')
               console.log(response.data);
           })
           .catch(error =>{
            //    console.log(error);
               if(error.response.status === 422){
                   this.isLoading = false
                    if(error.response.data.errors.name === undefined){
                        this.nameError = ''
                    }else{
                        this.nameError = 'Patient name is required'
                    }
                    if(error.response.data.errors.phone === undefined){
                        this.phoneError = ''
                    }else{
                        this.phoneError = 'Patient phone is required'
                    }
                    if(error.response.data.errors.email === undefined){
                        this.emailError = ''
                    }else{
                        this.emailError = 'Patient email is required & unique'
                    }
                    if(error.response.data.errors.father_name === undefined){
                        this.fatherNameError = ''
                    }else{
                        this.fatherNameError = 'Patient father name is required'
                    }
                    if(error.response.data.errors.nid === undefined){
                        this.nidError = ''
                    }else{
                        this.nidError = 'Patient NID no is required'
                    }
                    if(error.response.data.errors.address === undefined){
                        this.addressError = ''
                    }else{
                        this.addressError = 'Patient address is required'
                    }
                    if(error.response.data.errors.cabin === undefined){
                        this.cabinError = ''
                    }else{
                        this.cabinError = 'Patient cabin no is required'
                    }
                    if(error.response.data.errors.bed === undefined){
                        this.bedError = ''
                    }else{
                        this.bedError = 'Patient bed no is required'
                    }
                    if(error.response.data.errors.diseas === undefined){
                        this.diseasError = ''
                    }else{
                        this.diseasError = 'Patient disease names is required'
                    }
                    if(error.response.data.errors.sex === undefined){
                        this.sexError = ''
                    }else{
                        this.sexError = 'Patient sex is required'
                    }
               }
           })
       },
       update(){
           this.isLoading = true
           axios.post('update/' + this.id,{
                id          : this.id,
                name        : this.name,
                phone       : this.phone,
                email       : this.email,
                father_name : this.father_name,
                nid         : this.nid,
                address     : this.address,
                cabin       : this.cabin,
                bed         : this.bed,
                diseas      : this.diseas,
                sex         : this.sex
           })
           .then(response =>{
               this.isLoading = false
               console.log(response.data);
               flash('Patient information updated successfully')
           })
           .catch(error =>{
               this.isLoading = false
               console.log(error);
           })
       }
   }
}
</script>

<style scoped>

</style>
