CREATE TABLE CA_Pokemon_Types(
    `id`    int auto_increment not null,
    `poke_type` VARCHAR(30),
    `created`   timestamp default current_timestamp,
    `modified`  timestamp default current_timestamp on update current_timestamp,
    PRIMARY KEY(`id`),
    UNIQUE KEY(`poke_type`)
)