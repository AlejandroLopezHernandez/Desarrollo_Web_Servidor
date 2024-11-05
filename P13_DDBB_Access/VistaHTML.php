<?php

class VistaHTML
{

    // Método para mostrar la lista de personajes
    public function showCharacters(array $characters)
    {
        echo "<div style='font-family: Arial, sans-serif;'>";
        echo "<h3 style='color: #4CAF50;'>Lista de personajes del juego:</h3>";
        echo "<div style='display: flex; flex-wrap: wrap; gap: 10px;'>";

        foreach ($characters as $character) {
            echo "<div style='background-color: #e0f7e9; padding: 10px; border-radius: 5px; width: 250px; box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.2);'>";
            echo "<strong>Nombre:</strong> {$character['name']}<br>";
            echo "<strong>Nivel:</strong> {$character['level']}<br>";
            echo "<strong>Salud:</strong> {$character['health']}<br>";
            echo "</div>";
        }

        echo "</div>";
        echo "</div>";
    }

    // Método para mostrar la lista de quests
    public function showQuests(array $quests)
    {
        echo "<div style='font-family: Arial, sans-serif;'>";
        echo "<h3 style='color: #4CAF50;'>Lista de desafíos del juego:</h3>";
        echo "<ul style='list-style-type: none; padding: 0;'>";

        foreach ($quests as $quest) {
            echo "<li style='background-color: #e0f1ff; margin: 10px 0; padding: 10px; border-radius: 5px; box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);'>";
            echo "<strong>Título:</strong> {$quest['title']}<br>";
            echo "<strong>Recompensa:</strong> {$quest['reward']}<br>";
            echo "<strong>Completada:</strong> " . ($quest['is_completed'] ? '<span style="color: green;">Sí</span>' : '<span style="color: red;">No</span>') . "<br>";
            echo "</li>";
        }

        echo "</ul>";
        echo "</div>";
    }

    // Método para mostrar las quests de un personaje específico
    public function showQuestsOfCharacter(string $name, array $quests)
    {
        echo "<div style='font-family: Arial, sans-serif;'>";
        echo "<h3 style='color: #4CAF50;'>Lista de desafíos del personaje: $name</h3>";
        echo "<ul style='list-style-type: none; padding: 0;'>";

        foreach ($quests as $quest) {
            echo "<li style='background-color: #f1f1f1; margin: 10px 0; padding: 10px; border-radius: 5px; box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);'>";
            echo "<strong>Título:</strong> {$quest['title']}<br>";
            echo "<strong>Recompensa:</strong> {$quest['reward']}<br>";
            echo "<strong>Completada:</strong> " . ($quest['is_completed'] ? '<span style="color: green;">Sí</span>' : '<span style="color: red;">No</span>') . "<br>";
            echo "</li>";
        }

        echo "</ul>";
        echo "</div>";
    }

    // Método para mostrar mensajes personalizados
    public function mostrarMensaje(string $mensaje)
    {
        echo "<div style='font-family: Arial, sans-serif; padding: 10px; background-color: #e0f7fa; border: 1px solid #00796b; border-radius: 5px; color: #004d40; margin-top: 15px;'>";
        echo "<strong>$mensaje</strong>";
        echo "</div>";
    }

    // Método para mostrar la información general del juego
    public function mostrarInformacionJuego(array $characters, array $quests)
    {
        echo "<div style='font-family: Arial, sans-serif;'>";
        echo "<h1 style='color: #2c3e50;'>Información del juego: LISTA DE PERSONAJES Y LISTA DE DESAFÍOS</h1>";
        $this->showCharacters($characters);
        $this->showQuests($quests);
        echo "</div>";
    }

    // Método para mostrar errores
    public function mostrarError(string $error)
    {
        echo "<div style='font-family: Arial, sans-serif; color: #c0392b; background-color: #f9e2e2; padding: 10px; border: 1px solid #e74c3c; border-radius: 5px; margin-top: 15px;'>";
        echo "<strong>Error:</strong> $error";
        echo "</div>";
    }
}
