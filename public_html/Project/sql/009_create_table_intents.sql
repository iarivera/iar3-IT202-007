CREATE TABLE CA_Intents(
    `id`    int auto_increment not null PRIMARY key,
    `pokemon_id` INT,
    `requestor_id` int,
    `processor_id` int,
    `type` int,
    `status` int,
    `requestor_notes` TEXT,
    `processor_notes` TEXT,
    `created`   timestamp default current_timestamp,
    `modified`  timestamp default current_timestamp on update current_timestamp,
    FOREIGN KEY (`pokemon_id`) REFERENCES CA_Pokemon(`id`),
    FOREIGN KEY (`requestor_id`) REFERENCES Users(`id`),
    FOREIGN KEY (`processor_id`) REFERENCES Users(`id`),
    FOREIGN KEY (`type`) REFERENCES CA_Intent_Types(`id`),
    FOREIGN KEY (`status`) REFERENCES CA_Intent_Status(`id`)
)