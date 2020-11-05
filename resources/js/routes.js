import AdminHome from './components/admin/Home.vue'
import ManageDoctor from './components/admin/DoctorList.vue'
import AddNewDoctor from './components/admin/AddDoctor.vue'
export const routes = [
    {
        path:'/clients/dashboard',
        component:AdminHome
    },
    {
        path:'/clients/manage-doctor',
        component:ManageDoctor
    },
    {
        path:'/clients/add-new-doctor',
        component:AddNewDoctor
    }
]
