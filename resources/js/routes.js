import AdminHome from './components/admin/Home.vue'
import AddNewDoctor from './components/admin/DoctorList.vue'
export const routes = [
    {
        path:'/clients/dashboard',
        component:AdminHome
    },
    {
        path:'/clients/add-new-doctor',
        component:AddNewDoctor
    }
]
