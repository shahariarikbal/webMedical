<template>
    <div>
        <div class="card reg-form">
            <loading :active.sync="isLoading"
                     :can-cancel="true"
                     :on-cancel="onCancel"
                     :is-full-page="fullPage"></loading>
            <div class="card-header bg-primary">
                <span class="reg-text-font" style="margin-left: 40px; color: white">Client Registration Form</span>
            </div>
            <div class="card-body">
                <form method="POST" @submit.prevent="registration()" enctype="multipart/form-data" name="clientForm">
                    <div class="form-group">
                        <label>Organisation Name</label>
                        <input type="text" name="name" id="name" v-model="name" class="form-control" placeholder="Organisation name" value="" required autocomplete="name" autofocus>
                        <small class="text-danger" id="nameValidation">{{ nameError }}</small>
                    </div>
                    <div class="form-group">
                        <label>Organisation Email</label>
                        <input type="email" name="email" id="email" v-model="email" class="form-control" placeholder="Organisation email" value="" required autocomplete="email" autofocus>
                        <small class="text-danger" id="emailValidation">{{ emailError }}</small>
                        <small class="text-success" v-text="emailSuccess"></small>
                    </div>
                    <div class="form-group">
                        <label>Organisation Phone</label>
                        <input type="text" name="phone" id="phone" v-model="phone" class="form-control" placeholder="Organisation phone" value="" required autocomplete="phone" autofocus>
                        <small class="text-danger" id="phoneValidation">{{ phoneError }}</small>
                        <small class="text-success" v-text="phoneSuccess"></small>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label>Password [8 to 20 characters]</label>
                                <input id="password" type="password" v-model="password" class="form-control" placeholder="password" name="password" required autocomplete="new-password">
                                <small class="text-danger">{{ passwordError }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Organisation Logo</label><br/>
                        <input id="logo" type="file" name="logo" @change="organisationLogo" accept="image/*"><br/>
                        <small class="text-danger">{{ photoError }}</small>
                        <img src=" " id="pre-logo"/>
                    </div>
                    <div class="form-group">
                        <a :href="'login-form'" class="pull-left" style="color: orangered; font-weight: bold">Already register ? Click</a>
                        <button type="submit" id="clientRegister" class="btn btn-success pull-right">Register</button>
                    </div>
                </form>
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
            name: '',
            email: '',
            phone: '',
            password: '',
            logo: '',

            phoneSuccess: '',
            emailSuccess: '',
            mailformat: '/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/',

            errorCount: 0,
            nameError: '',
            emailError: '',
            phoneError: '',
            passwordError: '',
            photoError: '',

            isLoading: false,
            fullPage: true
        }
    },

    components: {
        Loading
    },

    watch: {
        phone () {
            this.phoneError = ''
            axios.get('registration/phone-is-available', { params: {phone: this.phone} })
                .then(response => {
                    if (response.status === 200 && response.data.available === false) {
                        this.phoneError = 'This phone is already been taken'
                        this.phoneSuccess = ''
                        this.errorCount++
                    }
                    if (response.status === 200 && response.data.available === true) {
                        this.phoneSuccess = 'Success'
                        this.phoneError = ''
                    }
                })
                .catch(error => {
                    console.log(error)
                })
        },
        email () {
            this.emailError = ''

            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

            if (re.test(this.email)) {
                axios.get('registration/email-is-available', { params: {email: this.email} })
                    .then(response => {

                        if (response.status === 200 && response.data.available === false) {
                            this.emailError = 'This email is already been taken'
                            this.emailSuccess = ''
                            this.errorCount++
                        }
                        if (response.status === 200 && response.data.available === true) {
                            this.emailError = ''
                            this.emailSuccess = 'Success'
                        }
                    })
                    .catch(error => {
                        console.log(error)
                    })
            }

        }
    },

    methods: {
        organisationLogo (e) {
            if (e.target.files[0]) {
                let image = e.target.files[0];
                if(image['type'] === 'image/jpeg' || image['type'] === 'image/png' || image['type'] === 'image/webp' || image['type'] === 'image/gif'){
                    let reader = new FileReader();
                    reader.onload = function ()
                    {
                        let output = document.getElementById('pre-logo');
                        output.src = reader.result;
                        output.style.display = "block";
                        output.style.width = "15%";
                    }
                    reader.readAsDataURL(event.target.files[0]);
                }else{
                    console.log("This file not an Image", 'Error !!');
                }
            }
        },

        resetError () {
            this.errorCount = 0
            this.nameError = ''
            this.emailError = ''
            this.phoneError = ''
            this.photoError = ''
            this.passwordError = ''
        },

        validation_error () {
            if(this.name.length === 0){
                this.nameError = 'Name is required'
                this.errorCount++
            }

            if(this.email.length === 0){
                this.emailError = 'Email is required'
                this.errorCount++
            }

            let emailCheck = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if (!emailCheck.test(this.email)){
                this.emailError = 'Valid Email is Required'
                this.errorCount++
            }

            if(this.phone.length === 0){
                this.phoneError = 'Phone is required'
                this.errorCount++
            }

            if(this.phone.length < 11){
                this.phoneError = 'Phone is to short'
                this.errorCount++
            }
        },

        registration() {
            this.resetError()
            this.validation_error()
            this.isLoading = true
            // Axios Request to server for client registration
            const config = {
                headers: { 'content-type': 'multipart/form-data' }
            };
            let clientData = new FormData();
            let orgLogo = document.getElementById("logo").files[0];
                        clientData.append('logo', orgLogo);
                        clientData.append('name', this.name);
                        clientData.append('email', this.email);
                        clientData.append('phone', this.phone);
                        clientData.append('password', this.password);

            axios.post('registration', clientData, config)
                .then(response => {
                    if (response.status === 201){
                        this.isLoading = false
                        this.onCancel()
                        $('#logo').val('');
                        this.name = '';
                        this.email = '';
                        this.phone = '';
                        this.password = '';
                    }

                })
                .catch((error ) => {
                    this.isLoading = false
                    if (error.response.status === 422) {
                        if (error.response.data.errors.name && error.response.data.errors.name.length > 0) {
                            this.nameError = error.response.data.errors.name[0]
                        }
                        if (error.response.data.errors.email && error.response.data.errors.email.length > 0) {
                            this.emailError = error.response.data.errors.email[0]
                        }
                        if (error.response.data.errors.phone && error.response.data.errors.phone.length > 0) {
                            this.phoneError = error.response.data.errors.phone[0]
                        }
                        if (error.response.data.errors.password && error.response.data.errors.password.length > 0) {
                            this.passwordError = error.response.data.errors.password[0]
                        }
                    }
                })
        },
        onCancel() {
            console.log('User cancelled the loader.')
        }
    }
}
</script>

<style scoped>

</style>
