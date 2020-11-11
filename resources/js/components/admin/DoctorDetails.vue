<template>
    <div class="container">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body" style="margin-bottom: 50px;">
                    <router-link to="/clients/doctors/list" class=""> <span class="btn btn-sm btn-primary pull-right manage-font">Manage Doctor</span></router-link>
                    <div class="row">
                        <div class="col-md-6" style="margin-top: 50px;">
                            <img :src="'/avatar/' + avatar" style="height: 68%; width: 68%; border-radius: 8px;">
                        </div>
                        <div class="col-md-6 fonts-line-height" style="margin-top: 20px;">
                            <table id="doctors">
                                <tr>
                                    <th>Name</th>
                                    <td>{{ name }} <strong style="text-transform: uppercase">( {{ doctor_degree }} )</strong></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ email }}</td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td>{{ phone }}</td>
                                </tr>
                                <tr>
                                    <th>NID</th>
                                    <td>{{ nid_no }}</td>
                                </tr>
                                <tr>
                                    <th>Visiting Day</th>
                                    <td>{{ visiting_day }}</td>
                                </tr>
                                <tr>
                                    <th>Visiting Time</th>
                                    <td>{{ visiting_time }}</td>
                                </tr>
                                <tr>
                                    <th>Visiting Fee</th>
                                    <td>{{ visiting_fee }}</td>
                                </tr>
                                <tr>
                                    <th>Specialist</th>
                                    <td>{{ specialist }}</td>
                                </tr>
                            </table>
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
            this.avatar = response.data.avatar

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

    .manage-font {
        font-size: 15px;
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
</style>
