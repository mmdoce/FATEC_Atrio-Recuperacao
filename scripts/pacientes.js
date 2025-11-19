const grade = document.getElementById("grade-pac");

async function gradePacientes() {
    const arquivo = await fetch("assets/dados/pacientes.json");
    const pacientes = await arquivo.json();    
    for(let item of pacientes){       
        const div = document.createElement("div");
        div.classList.add("card", "quadrado");
        div.innerHTML = `
                <img 
                src="${item.foto}" 
                alt="Foto do paciente"
                class="pac-icon quad">
                <div>
                    <h3 class="espaco">${item.nome}</h3>
                    <p>${item.descricao}</p>
                    <p><strong>Idade: ${item.idade}</strong></p>
                    <h4 class="espaco">Pendente : Feito</h4>
                </div>
            `
            grade.appendChild(div);
    }
}

gradePacientes();