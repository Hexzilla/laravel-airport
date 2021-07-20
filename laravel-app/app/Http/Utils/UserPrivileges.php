<?php

namespace App\Http\Utils;

class UserPrivileges
{
    const SuperAdmin = 1;
    const AdminExternal = 7; //Project_Admin
    const AdminInternal = 3; //SOM_Admin
    const Editor = 4; // New Approver role
    const Approver = 5; //DEPRECATED
    const Visualizer = 6; // SOM_User
    const Legal = 9;
    const Finance = 10;
    const Inactive = 2;
    const GPIAnalyst = 11;
}
