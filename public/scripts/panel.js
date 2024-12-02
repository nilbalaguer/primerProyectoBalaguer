const botonmostrar = document.getElementById("buttonmostrarcomandes");
const divContenido = document.getElementById("divdecontenidoadmin");
const inputClau = document.getElementById("clauAdmin");
const botonhistorial = document.getElementById("buttonmostrarhistorial");

//Botones para filtrar
const botonfiltrarusuario = document.getElementById("botonfiltrarusuario");
const botonfiltrarfecha = document.getElementById("botonfiltrarfecha");
const botonfiltrarprecio = document.getElementById("botonfiltrarprecio");

//Icono de carrega
const iconoCargaAdmin = document.getElementById("iconoCargaAdmin");

//Mostra el historial de accions de la pagina web
botonhistorial.addEventListener("click", historial);

//Botons de comandes
botonmostrar.addEventListener("click", () => {mostrarComandas("")});
botonfiltrarusuario.addEventListener("click", () => {mostrarComandas("id_cliente")});
botonfiltrarprecio.addEventListener("click", () => {mostrarComandas("precio")});
botonfiltrarfecha.addEventListener("click", () => {mostrarComandas("id_pedido")});

//Mostra les comandes de la BBDD
async function mostrarComandas(filtro) {
    iconoCargaAdmin.style.display = "block";
    divContenido.innerHTML = "";

    //Botons per crear i modificar comandes
    const botoncrearcomanda = document.createElement("button");
    const botonmodificarcomanda = document.createElement("button");

    const inputcomanda = document.createElement("input");
    inputcomanda.placeholder = "id_comanda";

    const inputclient = document.createElement("input");
    inputclient.placeholder = "id_client";

    const inputdescompte = document.createElement("input");
    inputdescompte.placeholder = "descompte";

    const inputlocalitat = document.createElement("input");
    inputlocalitat.placeholder = "localitat";

    const inputcodipostal = document.createElement("input");
    inputcodipostal.placeholder = "Codi Postal";

    const inputcarrer = document.createElement("input");
    inputcarrer.placeholder = "Carrer";

    const inputnom = document.createElement("input");
    inputnom.placeholder = "Nom Client";

    const inputtelefon = document.createElement("input");
    inputtelefon.placeholder = "Telefon";

    const inputpreu = document.createElement("input");
    inputpreu.placeholder = "Preu Final";

    botoncrearcomanda.textContent = "Crear";
    botoncrearcomanda.addEventListener("click", () => {crearComanda(inputclient.value, inputdescompte.value, inputlocalitat.value, inputcodipostal.value, inputcarrer.value, inputnom.value, inputtelefon.value, inputpreu.value)});

    botonmodificarcomanda.textContent = "Modificar";
    botonmodificarcomanda.addEventListener("click", () => {modificarComanda(inputcomanda.value, inputclient.value, inputdescompte.value, inputlocalitat.value, inputcodipostal.value, inputcarrer.value, inputnom.value, inputtelefon.value, inputpreu.value)});

    divContenido.appendChild(inputcomanda);
    divContenido.appendChild(inputclient);
    divContenido.appendChild(inputdescompte);
    divContenido.appendChild(inputlocalitat);
    divContenido.appendChild(inputcodipostal);
    divContenido.appendChild(inputcarrer);
    divContenido.appendChild(inputnom);
    divContenido.appendChild(inputtelefon);
    divContenido.appendChild(inputpreu);

    divContenido.appendChild(botoncrearcomanda);
    divContenido.appendChild(botonmodificarcomanda);

    fetch(`/api/api.php?comandes=${filtro}&clau=${inputClau.value}`, { method: "GET" })
    .then(response => {
        iconoCargaAdmin.style.display = "none";
        if (!response.ok) {
            throw new Error("Error en la solicitud");
        }
        return response.json();
    })
    .then(data => {
        iconoCargaAdmin.style.display = "none";
        try {
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
                const borrarlink = document.createElement("button");
                borrarlink.id = `borrarComanda${id_comanda}`;
                borrarlink.textContent = "Eliminar Comanda";
                borrarlink.addEventListener("click", () => {eliminarComanda(id_comanda, inputClau.value)});
                parrafo.appendChild(borrarlink);
                divContenido.appendChild(parrafo);
            });
        } catch (error) {
            const parrafo = document.createElement("h2");
            parrafo.textContent = "Error Clau Incorrecta";
            divContenido.appendChild(parrafo);
        }
        
    })
    .catch(error => {
        iconoCargaAdmin.style.display = "none";
        document.body.innerHTML += `<p>Error: ${error.message}</p>`;
        console.error("Error:", error);
    });
}

//Elimina una comanda de la BBDD
async function eliminarComanda(id_comanda, clau) {
    iconoCargaAdmin.style.display = "block";
    divContenido.innerHTML = "";

    fetch(`/api/api.php?eliminar=${id_comanda}&clau=${clau}`, { method: "GET" })
    .then(response => {
        iconoCargaAdmin.style.display = "none";
        if (!response.ok) {
            throw new Error("Error en la solicitud");
        }
        return response.json();
    })
    .then(data => {
        iconoCargaAdmin.style.display = "none";

        console.log(data);
        const parrafo = document.createElement("h2");
        parrafo.textContent = data;
        divContenido.appendChild(parrafo);

    })
    .catch(error => {
        iconoCargaAdmin.style.display = "none";
        document.body.innerHTML += `<p>Error: ${error.message}</p>`;
        console.error("Error:", error);
    })
}

//Inserta una comanda a la BBDD
async function crearComanda(id_client, descompte, localitat, codipostal, carrer, nom, telefon, preu) {
    iconoCargaAdmin.style.display = "block";
    divContenido.innerHTML = "";

    fetch(`/api/api.php?crear&clau=${inputClau.value}&id_client=${id_client}&descompte=${descompte}&localitat=${localitat}&codipostal=${codipostal}&carrer=${carrer}&nom=${nom}&telefon=${telefon}&preu=${preu}`, { method: "GET" })
    .then(response => {
        iconoCargaAdmin.style.display = "none";
        if (!response.ok) {
            throw new Error("Error en la solicitud");
        }
        return response.json();
    })
    .then(data => {
        iconoCargaAdmin.style.display = "none";

        console.log(data);
        const parrafo = document.createElement("h2");
        parrafo.textContent = data;
        divContenido.appendChild(parrafo);

    })
    .catch(error => {
        iconoCargaAdmin.style.display = "none";
        document.body.innerHTML += `<p>Error: ${error.message}</p>`;
        console.error("Error:", error);
    })
}

//Modifica una comanda de la BBDD
async function modificarComanda(id_comanda, id_client, descompte, localitat, codipostal, carrer, nom, telefon, preu) {
    iconoCargaAdmin.style.display = "block";
    divContenido.innerHTML = "";

    console.log(id_comanda, id_client, descompte, localitat, codipostal, carrer, nom, telefon, preu);

    fetch(`/api/api.php?modificar&clau=${inputClau.value}&id_comanda=${id_comanda}&id_client=${id_client}&descompte=${descompte}&localitat=${localitat}&codipostal=${codipostal}&carrer=${carrer}&nom=${nom}&telefon=${telefon}&preu=${preu}`, { method: "GET" })
    .then(response => {
        iconoCargaAdmin.style.display = "none";
        if (!response.ok) {
            throw new Error("Error en la solicitud");
        }
        return response.json();
    })
    .then(data => {
        iconoCargaAdmin.style.display = "none";

        console.log(data);
        const parrafo = document.createElement("h2");
        parrafo.textContent = data;
        divContenido.appendChild(parrafo);

    })
    .catch(error => {
        iconoCargaAdmin.style.display = "none";
        document.body.innerHTML += `<p>Error: ${error.message}</p>`;
        console.error("Error:", error);
    })
}

async function historial() {
    iconoCargaAdmin.style.display = "block";
    divContenido.innerHTML = "";

    fetch(`/api/api.php?historial&clau=${inputClau.value}`, { method: "GET" })
    .then(response => {
        iconoCargaAdmin.style.display = "none";
        if (!response.ok) {
            throw new Error("Error en la solicitud");
        }
        return response.json();
    })
    .then(data => {
        iconoCargaAdmin.style.display = "none";

        console.log(data);

        const tabla = document.createElement("table");
        tabla.className = "tablahistorial";
        divContenido.appendChild(tabla);

        //Titols de la taula
        const fila = document.createElement("tr");
        const id_registre = document.createElement("th");
        id_registre.textContent = "ID_REGISTRE";
        const id_client = document.createElement("th");
        id_client.textContent = "ID_CLIENT";
        const horaidia = document.createElement("th");
        horaidia.textContent = "DATA";
        const accio = document.createElement("th");
        accio.textContent = "ACCIO";
        fila.appendChild(id_registre);
        fila.appendChild(id_client);
        fila.appendChild(horaidia);
        fila.appendChild(accio);
        tabla.appendChild(fila);

        data.data.forEach(item => {
            const fila = document.createElement("tr");

            // Mostrar una taula amb els elements
            const id_registre = document.createElement("th");
            id_registre.textContent = item.id_registro;
            const id_client = document.createElement("td");
            id_client.textContent = item.id_client;
            const horaidia = document.createElement("td");
            horaidia.textContent = item.data;
            const accio = document.createElement("td");
            accio.textContent = item.accio;

            fila.appendChild(id_registre);
            fila.appendChild(id_client);
            fila.appendChild(horaidia);
            fila.appendChild(accio);

            tabla.appendChild(fila);
        });

        divContenido.appendChild(tabla);

    })
    .catch(error => {
        iconoCargaAdmin.style.display = "none";
        document.body.innerHTML += `<p>Error: ${error.message}</p>`;
        console.error("Error:", error);
    })
}