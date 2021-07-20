<?php

return [
    'elementTypes' => [
        '0' => 'Element(Only Header)',
        '1' => 'Sub-Element',
        '2' => 'Element'
    ],
    'taskTypes' => [
        '0' => 'Task(Only Header)',
        '1' => 'Sub-Task',
        '2' => 'Task'
    ],
    'UserPrivileges' => [
        'SuperAdmin'      => 1,
        'Inactive'        => 2,
        'AdminInternal'   => 3, //SOM_Admin
        'Editor'          => 4, // New Approver role
        'Approver'        => 5, //DEPRECATED
        'Visualizer'      => 6, // SOM_User
        'AdminExternal'   => 7, //Project_Admin
        'Legal'           => 9,
        'Finance'         => 10,
        'GPIAnalyst'      => 11
    ]
];

?>
