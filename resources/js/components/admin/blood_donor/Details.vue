<template>
    <div class="container">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body" style="margin-bottom: 50px;">
                    <router-link to="/employee/manage"> <span class="btn btn-sm btn-primary pull-right fonts">Manage Employee</span></router-link>
                    <div class="row">
                        <div class="card">
                            <h2 style="padding-top:20px; text-transform: uppercase; color: orangered">Employee profile</h2>
                            <img :src="'/employees/' + avatar" style="margin-top:10px;" class="avatar">
                            <h1 style="text-transform: capitalize">{{ name }}</h1>
                            <p class="title"> <strong style="text-transform: uppercase">( {{ designation }} )</strong></p>
                            <center>
                                <table style="margin-top:10px;margin-bottom:10px; line-height: 30px;">
                                    <tr>
                                        <th>Phone :</th>
                                        <td><span style="margin-left: 20px;">{{ phone }}</span></td>
                                    </tr>
                                    <tr>
                                        <th>Email :</th>
                                        <td><span style="margin-left: 20px;">{{ email }}</span></td>
                                    </tr>
                                    <tr>
                                        <th>NID :</th>
                                        <td><span style="margin-left: 20px;">{{ nid_no }} Tk.</span></td>
                                    </tr>
                                    <tr>
                                        <th>Joining Date : </th>
                                        <td>
                                            <span style="margin-left: 20px;">{{ joining_date }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Date of Birth : </th>
                                        <td> <span style="margin-left: 20px;">{{ dob }}</span></td>
                                    </tr>
                                    <tr>
                                        <th>Salary : </th>
                                        <td> <span style="margin-left: 20px;">{{ salary }} BDT.</span></td>
                                    </tr>
                                </table>
                            </center>
                            <router-link to="/employee/manage" style="color:white;"><button>Go back</button></router-link>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Loading from "vue-loading-overlay";

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
        this.viewEmployee()
    },
    components: {
        Loading
    },
    methods: {
        viewEmployee () {
            axios.get(`/employee/view/${this.$route.params.id}`)
                .then(response => {
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
                }).catch(error => {
                console.log(error)
            })
        },
    }
}
</script>

<style scoped>
.avatar {
    vertical-align: middle;
    width: 150px;
    height: 150px;
    border-radius: 50%;
}
.fonts {
    font-size: 15px;
    color: #ffffff;
}
.fonts-line-height {
    line-height: 24px;
}

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
