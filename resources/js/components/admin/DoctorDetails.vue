<template>
    <div class="container">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body" style="margin-bottom: 50px;">
                    <router-link to="/clients/doctors/list" class=""> <span class="btn btn-sm btn-primary pull-right manage-font">Manage Doctor</span></router-link>
                    <div class="row">

                        <div class="card">
                            <h2 style="padding-top:20px;">Doctor profile</h2>
                        <img :src="'/avatar/' + avatar" style="height: 68%; width: 70%; border-radius: 8px;margin-top:10px;">
                        <h1>{{ name }}</h1>
                        <p class="title"> <strong style="text-transform: uppercase">( {{ doctor_degree }}</strong> - {{ specialist }} Specialist <strong>)</strong></p>
                        <center>
                            <table style="margin-top:10px;margin-bottom:10px;">
                            <tr>
                                <th>Phone :</th>
                                <td>{{ phone }}</td>
                            </tr>
                            <tr>
                                <th>Email :</th>
                                <td>{{ email }}</td>
                            </tr>
                            <tr>
                                <th>Visiting Fee :</th>
                                <td>{{ visiting_fee }} Tk.</td>
                            </tr>
                            <tr>
                                <th>Visiting Day :</th>
                                <td>{{ visiting_day }}</td>
                            </tr>
                            <tr>
                                <th>Visiting Time :</th>
                                <td>{{ visiting_time }}</td>
                            </tr>
                            <tr>
                                <th>NID No :</th>
                                <td>{{ nid_no }}</td>
                            </tr>
                        </table>
                        </center>
                        <router-link to="/clients/doctors/list" style="color:white;"><button>Go back</button></router-link>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {
            // Condition
            isLoading: false,
            fullPage: true,
            editMode: false,
            buttonMode: false,
            titleMode: false,

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
            doctor_degree: '',
            avatar: '',

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

    mounted() {
        axios.get(`/clients/doctor/details/${this.$route.params.id}`)
        .then(response => {
            console.log(response)
            this.name = response.data.name,
            this.email = response.data.email,
            this.phone = response.data.phone,
            this.nid_no = response.data.nid_no,
            this.visiting_day = response.data.visiting_day,
            this.visiting_time = response.data.visiting_time,
            this.visiting_fee = response.data.visiting_fee,
            this.specialist = response.data.specialist,
            this.doctor_degree = response.data.doctor_degree,
            this.avatar = response.data.avatar,
            this.editMode = true
            this.buttonMode = true

        })
    }
}
</script>

<style scoped>
    .fonts {
        font-size: 20px;
        color: #000000;
    }
    .fonts-line-height {
        line-height: 24px;
    }

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
        /*background-color: #4CAF50;*/
        color: black;
    }
    /* changes */
    .card {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    max-width: 600px;
    margin: auto;
    text-align: center;
    font-family: arial;
    }

    .title {
    color: grey;
    font-size: 18px;
    }

    button {
    border: none;
    outline: 0;
    display: inline-block;
    padding: 8px;
    color: white;
    background-color: #000;
    text-align: center;
    cursor: pointer;
    width: 100%;
    font-size: 18px;
    }

    a {
    text-decoration: none;
    font-size: 22px;
    color: black;
    }

    button:hover, a:hover {
    opacity: 0.7;
    }
</style>
