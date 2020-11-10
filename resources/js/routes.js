import AdminHome from './components/admin/Home.vue'
import ManageDoctor from './components/admin/DoctorList.vue'
import AddNewDoctor from './components/admin/AddDoctor.vue'
import DoctorDetails from './components/admin/DoctorDetails.vue'
export const routes = [
    {
        path:'/clients/dashboard',
        component:AdminHome
    },
    {
        path:'/clients/add-new-doctor',
        component:AddNewDoctor
    },
    {
        path:'/clients/doctors/list',
        component:ManageDoctor
    },
    {
        path:'/clients/doctor/details/info/:id',
        component:DoctorDetails,
    }
]
