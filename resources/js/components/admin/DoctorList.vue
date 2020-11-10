<template>
    <div>
        <section class="content">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <span class="new-doctor">Doctor's List</span>
                                </div>
                                <div class="col-md-4">
                                    <input type="search" class="form-control" name="search" placeholder="Search Doctor">
                                </div>
                                <div class="col-md-4">
                                    <router-link to="/clients/add-new-doctor" class=""> <span class="btn btn-sm btn-primary pull-right manage-font">Add Doctor</span></router-link>
                                </div>
                            </div>
                            <br/>
                            <table id="doctors">
                                <tr>
                                    <th width="5%">SL</th>
                                    <th width="15%">Avatar</th>
                                    <th width="25%">Name/Degree</th>
                                    <th width="20%">Email</th>
                                    <th width="15%">Phone</th>
                                    <th width="22%">Action</th>
                                </tr>
                                <tr v-for="(doctor, index) in doctors" :key="doctor.id" style="border: 1px solid #000000; padding: 50px;">
                                    <td>{{ index+1 }}</td>
                                    <td>
                                        <img :src="'/avatar/' + doctor.avatar" alt="avatar" style="width: 80px; height: 80px">
                                    </td>
                                    <td>
                                        {{ doctor.name }} <br/>
                                        <span style="text-transform: uppercase; font-weight: bold">{{ doctor.doctor_degree }}</span>
                                    </td>
                                    <td>{{ doctor.email }}</td>
                                    <td>{{ doctor.phone }}</td>
                                    <td>
                                        <router-link :to="`/clients/doctor/details/info/${doctor.id}`" class="btn btn-sm btn-primary">
                                            <i class="fa fa-eye"></i>
                                        </router-link>
                                        <button type="button" class="btn btn-sm btn-success">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    data () {
        return {
            doctors: [],
        }
    },
    created() {
        //console.log('tets')
        axios.get('/clients/all/doctors')
            .then(response => {
                //console.log(response.data)
                this.doctors = response.data
            }).catch(error => {
            console.log(error)
        })
    },
    methods: {

    }
}
</script>

<style scoped>
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
    background-color: #4CAF50;
    color: white;
}
.manage-font {
    font-size: 15px;
}
.new-doctor {
    font-size: 24px;
}
</style>
