CREATE TABLE CA_Pokemon_Stats(
    `id`    int auto_increment not null,
    `api_id` VARCHAR(10),
    `name` VARCHAR(30),
    `rarity` VARCHAR(30),
    `created`   timestamp default current_timestamp,
    `modified`  timestamp default current_timestamp on update current_timestamp,
    PRIMARY KEY(`id`),
    UNIQUE KEY(`api_id`),
    UNIQUE KEY(`name`)
)