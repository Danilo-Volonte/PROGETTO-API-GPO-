<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mostra cose sui gatti sempre diverso</title>

</head>
<body>
    <p id = "fattoGatti"></p>
    <input type = "button" id="chiamaAPI" value="GENERA FATTO CASUALE"> </input>


    <script>
        document.getElementById("chiamaAPI").addEventListener("click", richiestaAPI); //aggiungiamo evento al bottone (onclick non va e inoltre è troppo vecchio)

        async function richiestaAPI()
        {
            let fatto = document.getElementById("fattoGatti");
            let risposta = await fetch("https://catfact.ninja/fact");
            console.log(risposta);
            if(risposta.ok == true) //controlla se la risposta è avvneuta con successo 
            {
                //faccio in modo che il jason sia una classe 
                //deserializzo body per renderlo un oggetto JASON
                let frase = await risposta.json();
                let testo = frase.fact;
                console.log(testo);
                //facciamo un'altra rishiesta per tradurre in italiano
                let rispostaTraduzione = await fetch(`https://api.mymemory.translated.net/get?q=${testo}&langpair=en|it`); //da non fare troppe volte 
                if(rispostaTraduzione.ok == true)
                {
                    let testoTradotto = await rispostaTraduzione.json();
                    fatto.textContent = testoTradotto.reponseData.translatedText;
                }
                else { fatto.textContent = "ERRORE NELLA RICHIESTA TRADUZIONE";}
            }
            else{ fatto.textContent = "ERRORE NELLA RISCHIESTA PRIMA DELLA TRADUZIONE";}
        }
    </script>
</body>
</html>