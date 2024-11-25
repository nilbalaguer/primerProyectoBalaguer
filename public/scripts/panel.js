const botonmostrar = document.getElementById("buttonmostrarcomandes");
const divContenido = document.getElementById("divdecontenidoadmin");

//Botones para filtrar
const botonfiltrarusuario = document.getElementById("botonfiltrarusuario");
const botonfiltrarfecha = document.getElementById("botonfiltrarfecha");
const botonfiltrarprecio = document.getElementById("botonfiltrarprecio");

//Icono de carrega
const iconoCargaAdmin = document.getElementById("iconoCargaAdmin");

botonmostrar.addEventListener("click", () => {mostrarProductos("")});
botonfiltrarusuario.addEventListener("click", () => {mostrarProductos("id_cliente")});
botonfiltrarprecio.addEventListener("click", () => {mostrarProductos("precio")});
botonfiltrarfecha.addEventListener("click", () => {mostrarProductos("id_pedido")});

async function mostrarProductos(filtro) {
    iconoCargaAdmin.style.display = "block";
    divContenido.innerHTML = "";

    fetch(`/api/api.php?comandes=${filtro}`, { method: "GET" })
    .then(response => {
        iconoCargaAdmin.style.display = "none";
        if (!response.ok) {
            throw new Error("Error en la solicitud");
        }
        return response.json();
    })
    .then(data => {
        iconoCargaAdmin.style.display = "none";
        data.data.forEach(item => {
            // Acceder a las propiedades de cada elemento
            const id_comanda = item.id_comanda;
            const id_client = item.id_client;
            const descompte = item.descompte;
            const localitat = item.localitat;
            const codipostal = item.codipostal;
            const carrer = item.carrer;
            const nom = item.nom;
            const telefon = item.telefon;
            const preu = item.preu;

            console.log(`Id_comanda: ${id_comanda}, Id_client: ${id_client}, Descompte: ${descompte}, Localitat: ${localitat}, Codi Postal: ${codipostal} Carrer: ${carrer} Nom Client: ${nom} Telefon: ${telefon} Preu: ${preu}`);

            // Crear elementos para mostrar los datos en el DOM
            const parrafo = document.createElement("p");
            parrafo.className = "recuadreComandaAdmin";
            parrafo.textContent = `Id_comanda: ${id_comanda}, Id_client: ${id_client}, Descompte: ${descompte}, Localitat: ${localitat}, Codi Postal: ${codipostal} Carrer: ${carrer} Nom Client: ${nom} Telefon: ${telefon} Preu: ${preu}`;
            divContenido.appendChild(parrafo);
        });
    })
    .catch(error => {
        iconoCargaAdmin.style.display = "none";
        document.body.innerHTML += `<p>Error: ${error.message}</p>`;
        console.error("Error:", error);
    });
}