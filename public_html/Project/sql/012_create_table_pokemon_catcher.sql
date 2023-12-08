CREATE TABLE CA_Pokemon_Catcher(
    `id` int auto_increment not null PRIMARY key,
    `pokemon_id` int,
    `owner_id` int,
    `intent_id` int,
    `created` timestamp default current_timestamp,
    `modified` timestamp default current_timestamp on update current_timestamp,
    FOREIGN KEY (`pokemon_id`) REFERENCES CA_Pokemon(`id`),
    FOREIGN KEY (`owner_id`) REFERENCES Users(`id`),
    FOREIGN KEY (`intent_id`) REFERENCES CA_Intents(`id`),
    unique key (`owner_id`, `pokemon_id`)
)