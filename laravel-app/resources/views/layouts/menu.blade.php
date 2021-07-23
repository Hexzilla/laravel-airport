
<li class="nav-item">
    <a href="{{ route('cmsDashboards.index') }}"
       class="nav-link {{ Request::is('cmsDashboards*') ? 'active' : '' }}">
        <p title='Dashboard'><i class="fa fa-palette"></i> Dashboard</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('home.index') }}"
       class="nav-link {{ Request::is('home*') ? 'active' : '' }}">
        <p title="Home"><i class="fa fa-home"></i> Home</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('somProjects.index') }}"
       class="nav-link {{ Request::is('somProjects*') ? 'active' : '' }}">
        <p title="Projects"><i class="fa fa-box"></i> Projects</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('somAirports.index') }}"
       class="nav-link {{ Request::is('somAirports*') ? 'active' : '' }}">
        <p title="Airports"><i class="fa fa-fighter-jet"></i> Airports</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('somCountries.index') }}"
       class="nav-link {{ Request::is('somCountries*') ? 'active' : '' }}">
        <p title="Country"><i class="fa fa-globe"></i> Country</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('somNews.index') }}"
       class="nav-link {{ Request::is('somNews*') ? 'active' : '' }}">
        <p title="News"><i class="far fa-newspaper"></i> News</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('cmsUsers.index') }}"
       class="nav-link {{ Request::is('cmsUsers*') ? 'active' : '' }}">
        <p title="User Management"><i class="fa fa-users"></i> User Management</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('somDepartments.index') }}"
       class="nav-link {{ Request::is('somDepartments*') ? 'active' : '' }}">
        <p title="Departments"><i class="fa fa-folder"></i> Departments</p>
    </a>
</li>

<!--
<li class="nav-item">
    <a href="{{ route('somCountryInfos.index') }}"
       class="nav-link {{ Request::is('somCountryInfos*') ? 'active' : '' }}">
        <p>Country Infos</p>
    </a>
</li> -->



<!--
<li class="nav-item">
    <a href="{{ route('cmsApiCustoms.index') }}"
       class="nav-link {{ Request::is('cmsApiCustoms*') ? 'active' : '' }}">
        <p>Cms Api Customs</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('cmsApiKeys.index') }}"
       class="nav-link {{ Request::is('cmsApiKeys*') ? 'active' : '' }}">
        <p>Cms Api Keys</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('cmsLogs.index') }}"
       class="nav-link {{ Request::is('cmsLogs*') ? 'active' : '' }}">
        <p>Cms Logs</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('cmsStatisticComponents.index') }}"
       class="nav-link {{ Request::is('cmsStatisticComponents*') ? 'active' : '' }}">
        <p>Cms Statistic Components</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('cmsStatistics.index') }}"
       class="nav-link {{ Request::is('cmsStatistics*') ? 'active' : '' }}">
        <p>Cms Statistics</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('cmsUsers.index') }}"
       class="nav-link {{ Request::is('cmsUsers*') ? 'active' : '' }}">
        <p>Cms Users</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('cmsSettings.index') }}"
       class="nav-link {{ Request::is('cmsSettings*') ? 'active' : '' }}">
        <p>Cms Settings</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('cmsPrivilegesRoles.index') }}"
       class="nav-link {{ Request::is('cmsPrivilegesRoles*') ? 'active' : '' }}">
        <p>Cms Privileges Roles</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('cmsPrivileges.index') }}"
       class="nav-link {{ Request::is('cmsPrivileges*') ? 'active' : '' }}">
        <p>Cms Privileges</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('cmsModuls.index') }}"
       class="nav-link {{ Request::is('cmsModuls*') ? 'active' : '' }}">
        <p>Cms Moduls</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('cmsMenusPrivileges.index') }}"
       class="nav-link {{ Request::is('cmsMenusPrivileges*') ? 'active' : '' }}">
        <p>Cms Menus Privileges</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('cmsMenuses.index') }}"
       class="nav-link {{ Request::is('cmsMenuses*') ? 'active' : '' }}">
        <p>Cms Menuses</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('cmsEmailTemplates.index') }}"
       class="nav-link {{ Request::is('cmsEmailTemplates*') ? 'active' : '' }}">
        <p>Cms Email Templates</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('cmsEmailQueues.index') }}"
       class="nav-link {{ Request::is('cmsEmailQueues*') ? 'active' : '' }}">
        <p>Cms Email Queues</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('cmsDashboards.index') }}"
       class="nav-link {{ Request::is('cmsDashboards*') ? 'active' : '' }}">
        <p>Cms Dashboards</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('somApprovalsResponsibles.index') }}"
       class="nav-link {{ Request::is('somApprovalsResponsibles*') ? 'active' : '' }}">
        <p>Som Approvals Responsibles</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('somCountries.index') }}"
       class="nav-link {{ Request::is('somCountries*') ? 'active' : '' }}">
        <p>Som Countries</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('somCountryInfos.index') }}"
       class="nav-link {{ Request::is('somCountryInfos*') ? 'active' : '' }}">
        <p>Som Country Infos</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('somDepartments.index') }}"
       class="nav-link {{ Request::is('somDepartments*') ? 'active' : '' }}">
        <p>Som Departments</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('somDepartmentsUsers.index') }}"
       class="nav-link {{ Request::is('somDepartmentsUsers*') ? 'active' : '' }}">
        <p>Som Departments Users</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('somFormApprovals.index') }}"
       class="nav-link {{ Request::is('somFormApprovals*') ? 'active' : '' }}">
        <p>Som Form Approvals</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('somFormElements.index') }}"
       class="nav-link {{ Request::is('somFormElements*') ? 'active' : '' }}">
        <p>Som Form Elements</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('somFormTasks.index') }}"
       class="nav-link {{ Request::is('somFormTasks*') ? 'active' : '' }}">
        <p>Som Form Tasks</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('somForms.index') }}"
       class="nav-link {{ Request::is('somForms*') ? 'active' : '' }}">
        <p>Som Forms</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('somMilestonesFormsTypes.index') }}"
       class="nav-link {{ Request::is('somMilestonesFormsTypes*') ? 'active' : '' }}">
        <p>Som Milestones Forms Types</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('somNews.index') }}"
       class="nav-link {{ Request::is('somNews*') ? 'active' : '' }}">
        <p>Som News</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('somPhases.index') }}"
       class="nav-link {{ Request::is('somPhases*') ? 'active' : '' }}">
        <p>Som Phases</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('somProjectsMilestones.index') }}"
       class="nav-link {{ Request::is('somProjectsMilestones*') ? 'active' : '' }}">
        <p>Som Projects Milestones</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('somPhasesMilestonesTypes.index') }}"
       class="nav-link {{ Request::is('somPhasesMilestonesTypes*') ? 'active' : '' }}">
        <p>Som Phases Milestones Types</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('somProjectInfoStatuses.index') }}"
       class="nav-link {{ Request::is('somProjectInfoStatuses*') ? 'active' : '' }}">
        <p>Som Project Info Statuses</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('somProjectProcessTypes.index') }}"
       class="nav-link {{ Request::is('somProjectProcessTypes*') ? 'active' : '' }}">
        <p>Som Project Process Types</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('somProjectUsers.index') }}"
       class="nav-link {{ Request::is('somProjectUsers*') ? 'active' : '' }}">
        <p>Som Project Users</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('somProjects.index') }}"
       class="nav-link {{ Request::is('somProjects*') ? 'active' : '' }}">
        <p>Som Projects</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('somProjectsAdditionalAirports.index') }}"
       class="nav-link {{ Request::is('somProjectsAdditionalAirports*') ? 'active' : '' }}">
        <p>Som Projects Additional Airports</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('somProjectsAdvisors.index') }}"
       class="nav-link {{ Request::is('somProjectsAdvisors*') ? 'active' : '' }}">
        <p>Som Projects Advisors</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('somProjectsAirports.index') }}"
       class="nav-link {{ Request::is('somProjectsAirports*') ? 'active' : '' }}">
        <p>Som Projects Airports</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('somProjectsAirportTypes.index') }}"
       class="nav-link {{ Request::is('somProjectsAirportTypes*') ? 'active' : '' }}">
        <p>Som Projects Airport Types</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('somProjectsAssetTypes.index') }}"
       class="nav-link {{ Request::is('somProjectsAssetTypes*') ? 'active' : '' }}">
        <p>Som Projects Asset Types</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('somProjectsModels.index') }}"
       class="nav-link {{ Request::is('somProjectsModels*') ? 'active' : '' }}">
        <p>Som Projects Models</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('somProjectsPartners.index') }}"
       class="nav-link {{ Request::is('somProjectsPartners*') ? 'active' : '' }}">
        <p>Som Projects Partners</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('somProjectsPhases.index') }}"
       class="nav-link {{ Request::is('somProjectsPhases*') ? 'active' : '' }}">
        <p>Som Projects Phases</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('somProjectsPriorities.index') }}"
       class="nav-link {{ Request::is('somProjectsPriorities*') ? 'active' : '' }}">
        <p>Som Projects Priorities</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('somProjectsTransactionTypes.index') }}"
       class="nav-link {{ Request::is('somProjectsTransactionTypes*') ? 'active' : '' }}">
        <p>Som Projects Transaction Types</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('somStatuses.index') }}"
       class="nav-link {{ Request::is('somStatuses*') ? 'active' : '' }}">
        <p>Som Statuses</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('somStatusApprovals.index') }}"
       class="nav-link {{ Request::is('somStatusApprovals*') ? 'active' : '' }}">
        <p>Som Status Approvals</p>
    </a>
</li>


-->
