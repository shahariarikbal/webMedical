<template>
    <div>
        <form @submit.prevent="send">
            <div class="admission-form">
                <div class="form-group">
                    <input type="text" v-model="firstName" class="form-control" placeholder="First Name*">
                    <small class="text-danger">{{ firstNameError }}</small>
                </div>
                <div class="form-group">
                    <input type="text" v-model="lastName" class="form-control" placeholder="Last Name*">
                    <small class="text-danger">{{ lastNameError }}</small>
                </div>
                <div class="form-group">
                    <input type="text" v-model="phoneNumber" class="form-control" placeholder="Phone Number*">
                    <small class="text-danger">{{ phoneNumberError }}</small>
                </div>
                <div class="form-group">
                    <input type="text" v-model="email" class="form-control" placeholder="Email">
                    <small class="text-danger">{{ emailError }}</small>
                </div>
            </div>
            <div class="form-group">
                <textarea v-model="message" class="form-control" placeholder="Message*"></textarea>
                <small class="text-danger">{{ messageError }}</small>
            </div>
            <button type="submit" class="btn btn-primary submit">Get a Free Consultation</button>
        </form>
    </div>
</template>
<script>
// Import component
// import Loading from 'vue-loading-overlay';
// Import stylesheet
// import 'vue-loading-overlay/dist/vue-loading.css';
// Import Sweetalert
import swal from 'sweetalert';

export default {
    data(){
        return {
            isLoading: false,
            fullPage: true,

            firstName   : '',
            lastName    : '',
            email       : '',
            phoneNumber : '',
            message     : '',

            firstNameError   : '',
            lastNameError    : '',
            emailError       : '',
            phoneNumberError : '',
            messageError     : ''
        }
    },
    // components: {
    //     Loading
    // },
    methods : {
        // onCancel() {
        //     console.log('User cancelled the loader.')
        // },
        send(){

            // this.isLoading = true
                    this.firstNameError   = '',
                    this.lastNameError    = '',
                    this.emailError       = '',
                    this.phoneNumberError = '',
                    this.messageError     = ''
            axios.post('/contact/send', {
                first_name : this.firstName,
                last_name : this.lastName,
                email : this.email,
                phone : this.phoneNumber,
                message : this.message
            })
            .then(response =>{
                if (response.status === 200) {
                    swal("Success!", "Thanks for contact us!", "success");
                    this.firstName = '',
                    this.lastName = '',
                    this.email = '',
                    this.phoneNumber = '',
                    this.message = ''

                    this.firstNameError   = '',
                    this.lastNameError    = '',
                    this.emailError       = '',
                    this.phoneNumberError = '',
                    this.messageError     = ''
                }
            })
            .catch(error =>{
                if (error.response.status === 422) {
                    swal("Oops!", "Something went wrong!", "error");
                    var errors = error.response.data.errors
                    if(errors.first_name[0]){
                        this.firstNameError   = errors.first_name[0]
                    }
                    if (errors.last_name[0]) {
                        this.lastNameError    = errors.last_name[0]
                    }
                    if (errors.phone[0]) {
                        this.phoneNumberError = errors.phone[0]
                    }
                    if (errors.message[0]) {
                        this.messageError     = errors.message[0]
                    }
                }
            })
        }
    }
}
</script>