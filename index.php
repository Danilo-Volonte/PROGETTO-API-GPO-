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
            // Usa le classi
            let quiz = [];
            fetch("https://opentdb.com/api.php?amount=10&categoria=9&difficolta=medium&type=multiple")
            .then(response => response.json())
            .then(informazioniAPI => {
            quiz = new Quiz(informazioniAPI.results);
            quiz.render('quiz-container');
            })
            .catch(error => console.error("Errore nella richiesta:", error));
        </script>
    </body>

</html>