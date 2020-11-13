<template>
    <div class="container">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body" style="margin-bottom: 50px;">
                    <router-link to="/clients/doctors/list" class=""> <span class="btn btn-sm btn-primary pull-right manage-font">Manage Doctor</span></router-link>
                    <div class="row">
                        
                        <div class="card">
                            <h2 style="padding-top:20px;">Patient profile</h2>
                        <table class="table table-hover table-bordered">
                        <tbody>
                            <tr>
                                <th>Name</th>
                                <td>{{name}}</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>{{phone}}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{email}}</td>
                            </tr>
                            <tr>
                                <th>Father name</th>
                                <td>{{father_name}}</td>
                            </tr>
                            <tr>
                                <th>Nid</th>
                                <td>{{nid}}</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>{{address}}</td>
                            </tr>
                            <tr>
                                <th>Cabin</th>
                                <td>{{cabin}}</td>
                            </tr>
                            <tr>
                                <th>Bed</th>
                                <td>{{bed}}</td>
                            </tr>
                            <tr>
                                <th>Disease</th>
                                <td>{{disease}}</td>
                            </tr>
                            <tr>
                                <th>Sex</th>
                                <td>{{sex}}</td>
                            </tr>
                        </tbody>
                        </table>
                        <router-link to="/patient/list" style="color:white;"><button>Go back</button></router-link>
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
            name        : '',
            phone       : '',
            email       : '',
            father_name : '',
            nid         : '',
            address     : '',
            cabin       : '',
            bed         : '',
            disease     : '',
            sex         : '',
        }
    },

    mounted() {
        axios.get(`/patient/details/${this.$route.params.id}`)
        .then(response => {
            this.name        = response.data.name
            this.phone       = response.data.phone
            this.email       = response.data.email
            this.father_name = response.data.father_name
            this.nid         = response.data.nid
            this.address     = response.data.address
            this.cabin       = response.data.cabin
            this.bed         = response.data.bed
            this.disease     = response.data.disease
            if(response.data.sex === 1){
                this.sex = 'Male'
            }else{
                this.sex = 'Female'
            }
        })
        .catch(error =>{
            console.log(error);
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
