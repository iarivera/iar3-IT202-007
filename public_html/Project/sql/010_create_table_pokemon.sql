CREATE TABLE CA_Pokemon(
    `id`        int auto_increment not null,
    `name` VARCHAR(30),
    `type_1` VARCHAR(30),
    `type_2` VARCHAR(30),
    `attack` INT,
    `defense` INT,
    `stamina` INT,
    `created` timestamp default current_timestamp,
    `modified` timestamp default current_timestamp on update current_timestamp,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`name`) REFERENCES CA_Pokemon_Stats(`name`)
)