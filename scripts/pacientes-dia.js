const pacientesDia = document.getElementById("pac-dia");

async function pacDia() {
    const arquivo = await fetch("assets/dados/pacientes.json");
    const paciente = await arquivo.json();
    for(let item of paciente){
        const div = document.createElement("div");
        div.classList.add("card", "paciente");
        div.innerHTML = `
        <img 
        src="${item.foto}" 
        alt="Foto do paciente"
        class="pac-icon">
        <div>
            <h3>${item.nome}</h3>
            <p>${item.descricao}</p>
            <p><strong>Idade: ${item.idade}</strong></p>
            <h4>Pendente : Feito</h4>
        </div>
        `
        pacientesDia.appendChild(div);
    }
}

pacDia();