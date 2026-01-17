<script>
    // Crea una classe per rappresentare una domanda
class Question {
    constructor(informazioniAPI) {
        this.domanda = informazioniAPI.domanda;
        this.rispostaCorretta = informazioniAPI.rispostaCorretta;
        this.risposteNonCorrette = informazioniAPI.risposteNonCorrette;
        this.difficolta = informazioniAPI.difficolta;
        this.categoria = informazioniAPI.categoria;
        this.tutteRisposte = this.mescolaoOmande();
    }
    
    // Metodo per mescolare le risposte
    mescolaoOmande() {
        const answers = [this.rispostaCorretta, ...this.risposteNonCorrette];
        return answers.sort(() => Math.random() - 0.5);
    }
    
    // Metodo per verificare se la risposta è corretta
    isCorrect(answer) {
        return answer === this.rispostaCorretta;
    }
    
    // Metodo per renderizzare la domanda
    render(index) {
        let html = `
            <div class="question-card" style="border: 1px solid #ccc; padding: 15px; margin: 10px 0;">
                <h3>Domanda ${index + 1} (${this.difficolta})</h3>
                <p><strong>${this.question}</strong></p>
                <div class="answers">
        `;
        
        this.tutteRisposte.forEach(answer => {
            html += `
                <label style="display: block; margin: 8px 0;">
                    <input type="radio" name="question${index}" value="${answer}">
                    ${answer}
                </label>
            `;
        });
        
        html += `</div></div>`;
        return html;
    }
}

// Classe per il Quiz
class Quiz {
    constructor(questions) {
        this.questions = questions.map(q => new Question(q));
        this.answers = [];
    }
    
    // Metodo per ottenere il punteggio
    getScore() {
        let score = 0;
        this.questions.forEach((q, i) => {
            if (this.answers[i] && q.isCorrect(this.answers[i])) {
                score++;
            }
        });
        return score;
    }
    
    // Metodo per renderizzare tutto il quiz
    render(containerId) {
        const container = document.getElementById(containerId);
        container.innerHTML = '';
        
        this.questions.forEach((q, i) => {
            container.innerHTML += q.render(i);
        });
        
        container.innerHTML += `
            <button onclick="quiz.submitQuiz()" style="margin-top: 20px; padding: 10px 20px; font-size: 16px;">
                Invia Risposte
            </button>
        `;
    }
    
    submitQuiz() {
        const inputs = document.querySelectorAll('input[type="radio"]:checked');
        this.answers = [];
        
        inputs.forEach((input, index) => {
            this.answers[parseInt(input.name.replace('question', ''))] = input.value;
        });
        
        alert(`Hai ottenuto ${this.getScore()}/${this.questions.length} risposte corrette!`);
    }
}


</script>