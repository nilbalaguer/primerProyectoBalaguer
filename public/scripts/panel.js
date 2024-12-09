class comanda {
    constructor(id_comanda, id_client, descompte, localitat, codipostal, carrer, nom, telefon, preu) {
        this.id_comanda = id_comanda;
        this.id_client = id_client;
        this.descompte = descompte;
        this.localitat = localitat;
        this.codipostal = codipostal;
        this.carrer = carrer;
        this.nom = nom;
        this.telefon = telefon;
        this.preu = preu;
    }

    obtenerDetalles() {
        return `Id_comanda: ${this.id_comanda}, Id_client: ${this.id_client}, Descompte: ${this.descompte}, Localitat: ${this.localitat}, Codi Postal: ${this.codipostal}, Carrer: ${this.carrer}, Nom Client: ${this.nom}, Telefon: ${this.telefon}, Preu: ${this.preu}`;
    }
}




const botonmostrar = document.getElementById("buttonmostrarcomandes");
const divContenido = document.getElementById("divdecontenidoadmin");
const inputClau = document.getElementById("clauAdmin");
const botonhistorial = document.getElementById("buttonmostrarhistorial");
const botonmostrarproductes = document.getElementById("buttonmostrarproductes");
const botonmostrarusuaris = document.getElementById("buttonmostrarusuaris");

//Botones para filtrar
const botonfiltrarusuario = document.getElementById("botonfiltrarusuario");
const botonfiltrarfecha = document.getElementById("botonfiltrarfecha");
const botonfiltrarprecio = document.getElementById("botonfiltrarprecio");

//Icono de carrega
const iconoCargaAdmin = document.getElementById("iconoCargaAdmin");

//Mostra el historial de accions de la pagina web
botonhistorial.addEventListener("click", historial);

//Mostrar els productes de la web
botonmostrarproductes.addEventListener("click", () => {mostrarProducte("", inputClau.value)});

//Mostrar els usuaris
botonmostrarusuaris.addEventListener("click", () => {mostrarUsuari("", inputClau.value)});

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

    let listaprecios = {
        "EUR": 1,
    };

    const seleccionadorpais = document.createElement("select");
    seleccionadorpais.id = "selectorpais";
    seleccionadorpais.value = "EUR";

    const botoncargar = document.createElement("button");
    botoncargar.textContent = "Cargar Comandes";

    botoncargar.addEventListener("click", loadcomandas);

    divContenido.appendChild(botoncargar)

    try {
        fetch(`https://api.freecurrencyapi.com/v1/latest?apikey=fca_live_W1nZUy0xPrQvvJ5OHbIq1IuaLvgdczZq1CmHv5n5&currencies=AUD%2CBGN%2CBRL%2CCAD%2CCHF%2CCNY%2CCZK%2CDKK%2CEUR%2CGBP%2CHKD%2CHRK%2CHUF%2CIDR%2CILS%2CINR%2CISK%2CJPY%2CKRW%2CMXN%2CMYR%2CNOK%2CNZD%2CPHP%2CPLN%2CRON%2CRUB%2CSEK%2CSGD%2CTHB%2CTRY%2CUSD%2CZAR&base_currency=EUR`)
        .then(response => {
            if (!response.ok) {
                throw new Error("Error en la solicitud");
            }
            return response.json();
        })
        .then(data => {
            listaprecios = data.data;

            Object.keys(listaprecios).forEach(moneda => {
                const opcion = document.createElement("option");
                opcion.value = moneda;
                opcion.textContent = moneda; // Muestra el código de la moneda
                seleccionadorpais.appendChild(opcion);
            });

            console.log(listaprecios);
        })
        .catch(error => {
            iconoCargaAdmin.style.display = "none";
            document.body.innerHTML += `<p>Error: ${error.message}</p>`;
            console.error("Error:", error);
        });
    } catch (error) {
        console.log("No s'ha pogut carregar la api de conversio de monedes");
    }

    iconoCargaAdmin.style.display = "none";
    seleccionadorpais.value="EUR";

    divContenido.appendChild(seleccionadorpais);

    function loadcomandas() {
        iconoCargaAdmin.style.display = "block";
        divContenido.innerHTML = "";
    
    
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
                    let comandaInstancia = new comanda(
                        item.id_comanda,
                        item.id_client,
                        item.descompte,
                        item.localitat,
                        item.codipostal,
                        item.carrer,
                        item.nom,
                        item.telefon,
                        item.preu * listaprecios[seleccionadorpais.value]
                    );
                
                    const parrafo = document.createElement("p");
                    parrafo.className = "recuadreComandaAdmin";
                    parrafo.textContent = comandaInstancia.obtenerDetalles();
                
                    const borrarlink = document.createElement("button");
                    borrarlink.id = `borrarComanda${comandaInstancia.id_comanda}`;
                    borrarlink.textContent = "Eliminar Comanda";
                    borrarlink.addEventListener("click", () => {eliminarComanda(comandaInstancia.id_comanda, inputClau.value)});
                
                    parrafo.appendChild(borrarlink);
                
                    divContenido.appendChild(parrafo);
                });
                
            } catch (error) {
                const parrafo = document.createElement("h2");
                parrafo.textContent = "Error Clau Incorrecta"+error;
                divContenido.appendChild(parrafo);
            }
            
        })
        .catch(error => {
            iconoCargaAdmin.style.display = "none";
            document.body.innerHTML += `<p>Error: ${error.message}</p>`;
            console.error("Error:", error);
        });
    }
}

//Elimina una comanda de la BBDD
async function eliminarComanda(id_comanda, clau) {
    iconoCargaAdmin.style.display = "block";
    divContenido.innerHTML = "";

    fetch(`/api/api.php?eliminarComanda=${id_comanda}&clau=${clau}`, { method: "GET" })
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

    fetch(`/api/api.php?crearComanda&clau=${inputClau.value}&id_client=${id_client}&descompte=${descompte}&localitat=${localitat}&codipostal=${codipostal}&carrer=${carrer}&nom=${nom}&telefon=${telefon}&preu=${preu}`, { method: "GET" })
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

    fetch(`/api/api.php?modificarComanda&clau=${inputClau.value}&id_comanda=${id_comanda}&id_client=${id_client}&descompte=${descompte}&localitat=${localitat}&codipostal=${codipostal}&carrer=${carrer}&nom=${nom}&telefon=${telefon}&preu=${preu}`, { method: "GET" })
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
        try {
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

        } catch (error) {
            const fila = document.createElement("tr");

            const respuesta = document.createElement("th");
            respuesta.textContent = data;

            fila.appendChild(respuesta)

            tabla.appendChild(fila);
        }

        divContenido.appendChild(tabla);

    })
    .catch(error => {
        iconoCargaAdmin.style.display = "none";
        document.body.innerHTML += `<p>Error: ${error.message}</p>`;
        console.error("Error:", error);
    })
}