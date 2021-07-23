-- 2021.07.11 23:00
ALTER TABLE `aena-som-mig`.`som_projects_partners` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `aena-som-mig`.`som_projects_advisors` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;

-- 2021.07.12 23:00
ALTER TABLE `aena-som-mig`.`som_country_info` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;

-- 2021.07.20 The user specified as a definer ('isadmin'@'%') does not exist
GRANT ALL ON *.* TO 'isadmin'@'%' IDENTIFIED BY 'complex-password';
FLUSH PRIVILEGES;

-- 2021.07.22 For database log
UPDATE `aena-som-mig`.`cms_moduls` SET `path` = 'somNews' , `controller` = 'SomNewsController' WHERE `id` = '37'; 
UPDATE `aena-som-mig`.`cms_moduls` SET `path` = 'somProjects' , `controller` = 'SomProjectsController' WHERE `id` = '16'; 
UPDATE `aena-som-mig`.`cms_moduls` SET `path` = 'somStatuses' , `controller` = 'SomStatusController' WHERE `id` = '13'; 
UPDATE `aena-som-mig`.`cms_moduls` SET `path` = 'somProjectUsers' , `controller` = 'SomProjectUsersController' WHERE `id` = '17'; 
UPDATE `aena-som-mig`.`cms_moduls` SET `path` = 'somProjectsPhases' , `controller` = 'SomProjectsPhasesController' WHERE `id` = '18'; 
UPDATE `aena-som-mig`.`cms_moduls` SET `path` = 'somPhases' , `controller` = 'SomPhasesController' WHERE `id` = '19'; 
UPDATE `aena-som-mig`.`cms_moduls` SET `path` = 'somProjectsMilestones' , `controller` = 'SomProjectsMilestonesController' WHERE `id` = '21'; 
UPDATE `aena-som-mig`.`cms_moduls` SET `path` = 'somForms' , `controller` = 'SomFormsController' WHERE `id` = '22'; 
UPDATE `aena-som-mig`.`cms_moduls` SET `path` = 'somFormTasks' , `controller` = 'SomFormTasksController' WHERE `id` = '23'; 
UPDATE `aena-som-mig`.`cms_moduls` SET `path` = 'somFormElements' , `controller` = 'SomFormElementsController' WHERE `id` = '25'; 
UPDATE `aena-som-mig`.`cms_moduls` SET `path` = 'somDepartments' , `controller` = 'SomDepartmentsController' WHERE `id` = '27'; 
UPDATE `aena-som-mig`.`cms_moduls` SET `path` = 'somDepartmentsUsers' , `controller` = 'somDepartmentsUsers' WHERE `id` = '28'; 
UPDATE `aena-som-mig`.`cms_moduls` SET `path` = 'somFormApprovals' , `controller` = 'SomFormApprovalsController' WHERE `id` = '29'; 
UPDATE `aena-som-mig`.`cms_moduls` SET `path` = 'somApprovalsResponsibles' , `controller` = 'SomApprovalsResponsibleController' WHERE `id` = '30'; 
UPDATE `aena-som-mig`.`cms_moduls` SET `path` = 'somProjectsPartners' , `controller` = 'SomProjectsPartnersController' WHERE `id` = '31'; 
UPDATE `aena-som-mig`.`cms_moduls` SET `path` = 'somProjectsAdvisors' , `controller` = 'SomProjectsAdvisorsController' WHERE `id` = '32'; 
UPDATE `aena-som-mig`.`cms_moduls` SET `path` = 'somStatusApprovals' , `controller` = 'SomStatusApprovalsController' WHERE `id` = '33'; 
UPDATE `aena-som-mig`.`cms_moduls` SET `path` = 'somCountries' , `controller` = 'SomCountryController' WHERE `id` = '34'; 
UPDATE `aena-som-mig`.`cms_moduls` SET `path` = 'somCountryInfos' , `controller` = 'SomCountryInfoController' WHERE `id` = '35'; 
UPDATE `aena-som-mig`.`cms_moduls` SET `path` = 'somAirports' , `controller` = 'SomProjectsAirportController' WHERE `id` = '36'; 
UPDATE `aena-som-mig`.`cms_moduls` SET `path` = 'somProjectsAdditionalAirports' , `controller` = 'SomProjectsAdditionalAirportController' WHERE `id` = '38'; 
UPDATE `aena-som-mig`.`cms_moduls` SET `path` = 'somFormTasks' WHERE `id` = '24'; 
UPDATE `aena-som-mig`.`cms_moduls` SET `controller` = 'SomFormTasksController' WHERE `id` = '24';
UPDATE `aena-som-mig`.`cms_moduls` SET `path` = 'cmsUsers' , `controller` = 'CmsUsersController' WHERE `id` = '4';  




