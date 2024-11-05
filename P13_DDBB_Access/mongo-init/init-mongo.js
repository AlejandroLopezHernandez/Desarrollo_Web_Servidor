// init-mongo.js

db = db.getSiblingDB('rpg_game'); // Cambia a la base de datos rpg_game

// Crear la colección characters y agregar un documento
db.characters.insertMany([
    {
        name: "Ulises",
        level: 5,
        experience: 1200,
        health: 100,
        quests: [
            {
                quest_id: ObjectId(), // Puedes llenar más tarde con el id real
                title: "Regresar a Ítaca",
                is_completed: false
            },
            {
                quest_id: ObjectId(), // Puedes llenar más tarde con el id real
                title: "Derrotar a los Ciclopios",
                is_completed: true
            }
        ]
    },
    {
        name: "Telémaco",
        level: 3,
        experience: 500,
        health: 90,
        quests: []
    }
]);

// Crear la colección quests y agregar un documento
db.quests.insertMany([
    {
        title: "Regresar a Ítaca",
        description: "Ulises debe encontrar el camino de regreso a su hogar.",
        reward: 500,
        is_completed: false
    },
    {
        title: "Derrotar a los Ciclopios",
        description: "Ulises debe enfrentarse a Polifemo.",
        reward: 300,
        is_completed: true
    }
]);
