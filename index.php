<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ESERCITAZIONE TPS CON API</title>
        <!--- file per relizzazioen del progetto --->
    </head>
    <body>
        <h1>Quiz Trivia</h1>
        <div id="quiz-container"></div>

        <script>
            fetch("https://opentdb.com/api.php?amount=10&category=9&difficulty=medium&type=multiple")
            .then(response => response.json()) // Converte la risposta in JSON
            .then(data => {
                console.log(data); // Mostra il JSON completo
                const container = document.getElementById("quiz-container");
                data.results.forEach(question => {
                    container.innerHTML += `<p><strong>${question.question}</strong></p>`;
                });
            })
            .catch(error => console.error("Errore nella richiesta:", error));
        </script>
    </body>
</html>