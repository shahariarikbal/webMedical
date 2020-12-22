<template>
    <div class="container">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body" style="margin-bottom: 50px;">
                    <router-link to="/employee/manage"> <span class="btn btn-sm btn-primary pull-right fonts">Manage Blood Donor</span></router-link>
                    <div class="row">
                        <div class="card">
                            <h2 style="padding-top:20px; text-transform: uppercase; color: orangered">Blood Donor profile</h2>
                            <center>
                                <table style="margin-top:10px;margin-bottom:10px; line-height: 30px;">
                                    <tr>
                                        <th>Name :</th>
                                        <td><span style="margin-left: 20px;">{{ name }}</span></td>
                                    </tr>
                                    <tr>
                                        <th>Phone :</th>
                                        <td><span style="margin-left: 20px;">{{ phone }}</span></td>
                                    </tr>
                                    <tr>
                                        <th>Address :</th>
                                        <td><span style="margin-left: 20px;">{{ address }}</span></td>
                                    </tr>
                                </table>
                            </center>
                            <router-link to="/blood-donor/list/info" style="color:white;"><button>Go back</button></router-link>
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
            name : '',
            phone : '',
            address : '',
        }
    },
    created() {
        this.viewBloodDonor()
    },
    components: {
        Loading
    },
    methods: {
        viewBloodDonor () {
            axios.get(`/blood-donor/view/${this.$route.params.id}`)
                .then(response => {
                    this.name          = response.data.name,
                    this.phone         = response.data.phone,
                    this.address        = response.data.address
                }).catch(error => {
                    console.log(error)
            })
        },
    }
}
</script>

<style scoped>
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
