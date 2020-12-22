<nav class="example">
    <ul class="nav">
        <li>
            <router-link to="/clients/dashboard" class=""><i class="lnr lnr-home"></i> <span>Dashboard</span></router-link>
        </li>
        <li>
            <a href="#patientPages" data-toggle="collapse" class="collapsed"><i class="lnr lnr-users"></i> <span>Patient</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
            <div id="patientPages" class="collapse ">
                <ul class="nav">
                    <li>
                        <router-link to="/patient/list" class=""><i class="lnr lnr-code"></i> <span>Manage Patient</span></router-link>
                    </li>
                    <li>
                        <router-link to="/patient/daily/list" class=""><i class="lnr lnr-code"></i> <span>Daily Patients</span></router-link>
                    </li>
                </ul>
            </div>
        <li>
        <li>
            <a href="#doctorPages" data-toggle="collapse" class="collapsed"><i class="lnr lnr-users"></i> <span>Doctors</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
            <div id="doctorPages" class="collapse ">
                <ul class="nav">
                    <li>
                        <router-link to="/clients/doctors/list" class=""><i class="lnr lnr-code"></i> <span>Manage Doctor</span></router-link>
                    </li>
                </ul>
            </div>
        <li>
            <a href="#department" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Department</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
            <div id="department" class="collapse ">
                <ul class="nav">
                    <li>
                        <router-link to="/clients/add-new-doctor" class=""><i class="lnr lnr-code"></i> <span>Manage Department</span></router-link>
                    </li>
                </ul>
            </div>
        </li>
        <li>
            <a href="#employee" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Employee</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
            <div id="employee" class="collapse ">
                <ul class="nav">
                    <li>
                        <router-link to="/employee/manage" class=""><i class="lnr lnr-code"></i> <span>Manage Employee</span></router-link>
                    </li>
                </ul>
            </div>
        </li>
        <li>
            <a href="#bloodDonors" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Blood Donors</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
            <div id="bloodDonors" class="collapse ">
                <ul class="nav">
                    <li>
                        <router-link to="/blood-donor/list/info" class=""><i class="lnr lnr-code"></i> <span>Blood Donors</span></router-link>
                    </li>
                </ul>
            </div>
        </li>
        <li>
            <a href="#accounts" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Accounts</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
            <div id="accounts" class="collapse ">
                <ul class="nav">
                    <li>
                        <router-link to="/clients/add-new-doctor" class=""><i class="lnr lnr-code"></i> <span>Admit Patient Bill</span></router-link>
                    </li>
                    <li>
                        <router-link to="/clients/add-new-doctor" class=""><i class="lnr lnr-code"></i> <span>Operation Bill</span></router-link>
                    </li>
                    <li>
                        <router-link to="/clients/add-new-doctor" class=""><i class="lnr lnr-code"></i> <span>Salary</span></router-link>
                    </li>
                    <li>
                        <router-link to="/clients/add-new-doctor" class=""><i class="lnr lnr-code"></i> <span>Daily Expenses</span></router-link>
                    </li>
                </ul>
            </div>
        </li>
        <li>
            <a href="#payroll" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Payroll System</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
            <div id="payroll" class="collapse ">
                <ul class="nav">
                    <li>
                        <router-link to="/clients/add-new-doctor" class=""><i class="lnr lnr-code"></i> <span>New User</span></router-link>
                    </li>
                    <li>
                        <router-link to="/clients/add-new-doctor" class=""><i class="lnr lnr-code"></i> <span>Payroll</span></router-link>
                    </li>
                </ul>
            </div>
        </li>
        <li>
            <a href="#general" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>General Settings</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
            <div id="general" class="collapse ">
                <ul class="nav">
                    <li>
                        <router-link to="/clients/add-new-doctor" class=""><i class="lnr lnr-code"></i> <span>New User</span></router-link>
                    </li>
                    <li>
                        <router-link to="/clients/add-new-doctor" class=""><i class="lnr lnr-code"></i> <span>Payroll</span></router-link>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</nav>
