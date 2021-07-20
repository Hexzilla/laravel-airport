-- 2021.07.11 23:00
ALTER TABLE `aena-som-mig`.`som_projects_partners` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `aena-som-mig`.`som_projects_advisors` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;

-- 2021.07.12 23:00
ALTER TABLE `aena-som-mig`.`som_country_info` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;

-- 2021.07.20 The user specified as a definer ('isadmin'@'%') does not exist
GRANT ALL ON *.* TO 'isadmin'@'%' IDENTIFIED BY 'complex-password';
FLUSH PRIVILEGES;


