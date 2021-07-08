ALTER TABLE `aena-som-mig`.`cms_users` 
CHANGE COLUMN `email` `email` VARCHAR(255) NOT NULL ,
ADD COLUMN `email_verified_at` TIMESTAMP NULL DEFAULT NULL AFTER `objectguid`,
ADD COLUMN `remember_token` VARCHAR(100) NULL DEFAULT NULL AFTER `email_verified_at`;