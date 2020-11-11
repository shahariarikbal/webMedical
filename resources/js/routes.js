import AdminHome from './components/admin/Home.vue'
import ManageDoctor from './components/admin/DoctorList.vue'
import AddNewDoctor from './components/admin/AddDoctor.vue'
import DoctorDetails from './components/admin/DoctorDetails.vue'
import AddNewPatient from './components/admin/patient/Add.vue'
import ManagePatient from './components/admin/patient/List.vue'
import DailyManagePatient from './components/admin/patient/Daily.vue'
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
    },
    {
        path:'/clients/doctor/edit/info/:id',
        component:AddNewDoctor,
    },
    {
        path: '/patient/create',
        component: AddNewPatient,
    },
    {
        path: '/patient/list',
        component: ManagePatient,
    },
    {
        path: '/patient/daily/list',
        component: DailyManagePatient,
    }
]
