import AdminHome from './components/admin/Home.vue'
import ManageDoctor from './components/admin/DoctorList.vue'
import AddNewDoctor from './components/admin/AddDoctor.vue'
import DoctorDetails from './components/admin/DoctorDetails.vue'
import AddNewPatient from './components/admin/patient/Add.vue'
import PatientDetails from './components/admin/patient/Details.vue'
import ManagePatient from './components/admin/patient/List.vue'
import DailyManagePatient from './components/admin/patient/Daily.vue'
import AddNewEmployee from './components/admin/employee/Add.vue'
import EmployeeList from './components/admin/employee/List.vue'
import EmployeeDetails from './components/admin/employee/Details.vue'
import EmployeeTrashList from './components/admin/employee/Trash.vue'
import AddNewBloodDonor from './components/admin/blood_donor/Add.vue'
import BloodDonorList from './components/admin/blood_donor/List.vue'

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
        path: '/patient/edit/info/:id',
        component:AddNewPatient,
    },
    {
        path: '/patient/details/info/:id',
        component:PatientDetails,
    },
    {
        path: '/patient/daily/list',
        component: DailyManagePatient,
    },
    {
        path: '/employee/create',
        component: AddNewEmployee,
    },
    {
        path: '/employee/manage',
        component: EmployeeList,
    },
    {
        path: '/employee/trash/list/info',
        component: EmployeeTrashList,
    },
    {
        path: '/employee/edit/info/:id',
        component: AddNewEmployee,
    },
    {
        path: '/employee/details/info/:id',
        component: EmployeeDetails,
    },
    {
        path: '/blood-donor/add',
        component: AddNewBloodDonor,
    },
    {
        path: '/blood-donor/list/info',
        component: BloodDonorList,
    }

]
