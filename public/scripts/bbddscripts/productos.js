class Producto {
    constructor(id, nom, descripcio, preu, imatge, categoria) {
        this.id = id;
        this.nom = nom;
        this.descripcio = descripcio;
        this.preu = preu;
        this.imatge = imatge;
        this.categoria = categoria;
    }

    mostrarProducto() {
        const parrafo = document.createElement("p");
        parrafo.className = "recuadreComandaAdmin";
        parrafo.textContent = `ID: ${this.id} Nom: ${this.nom} Descripcio: ${this.descripcio} Preu: ${this.preu} Imatge: ${this.imatge} Categoria: ${this.categoria}`;

        const borrarlink = document.createElement("button");
        borrarlink.id = `borrarProducte${this.id}`;
        borrarlink.textContent = "Eliminar Producte";
        borrarlink.addEventListener("click", () => { this.eliminarProducto(this.id); });
        
        parrafo.appendChild(borrarlink);
        divContenido.appendChild(parrafo);
    }
}

async function mostrarProducte(filtro, clau) {
    iconoCargaAdmin.style.display = "block";
    divContenido.innerHTML = "";

    //Botons per crear i modificar comandes
    const botoncrear = document.createElement("button");
    const botonmodificar = document.createElement("button");

    const inputid = document.createElement("input");
    inputid.placeholder = "id_producte";

    const inputnom = document.createElement("input");
    inputnom.placeholder = "nom_producte";

    const inputdescripcio = document.createElement("input");
    inputdescripcio.placeholder = "descripcio";

    const inputpreu = document.createElement("input");
    inputpreu.placeholder = "preu";

    const inputimatge = document.createElement("input");
    inputimatge.placeholder = "imatge";

    const inputcategoria = document.createElement("input");
    inputcategoria.placeholder = "categoria";

    botoncrear.textContent = "Crear";
    botoncrear.addEventListener("click", () => {crearProducte(inputnom.value, inputdescripcio.value, inputpreu.value, inputimatge.value, inputcategoria.value, clau)});

    botonmodificar.textContent = "Modificar";
    botonmodificar.addEventListener("click", () => {modificarProducte(inputid.value, inputnom.value, inputdescripcio.value, inputpreu.value, inputimatge.value, inputcategoria.value, clau)});

    divContenido.appendChild(inputid);
    divContenido.appendChild(inputnom);
    divContenido.appendChild(inputdescripcio);
    divContenido.appendChild(inputpreu);
    divContenido.appendChild(inputimatge);
    divContenido.appendChild(inputcategoria);

    divContenido.appendChild(botoncrear);
    divContenido.appendChild(botonmodificar);

    fetch(`/api/api.php?productes=${filtro}&clau=${clau}`, { method: "GET" })
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
                const producto = new Producto(
                    item.id,
                    item.nom,
                    item.descripcio,
                    item.preu,
                    item.imatge,
                    item.categoria
                );
            
                producto.mostrarProducto();
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
async function eliminarProducte(id, clau) {
    iconoCargaAdmin.style.display = "block";
    divContenido.innerHTML = "";

    fetch(`/api/api.php?eliminarProducte=${id}&clau=${clau}`, { method: "GET" })
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
async function crearProducte(nom, descripcio, preu, imatge, categoria, clau) {
    iconoCargaAdmin.style.display = "block";
    divContenido.innerHTML = "";

    fetch(`/api/api.php?crearProducte&clau=${clau}&nom=${nom}&descripcio=${descripcio}&preu=${preu}&imatge=${imatge}&categoria=${categoria}`, { method: "GET" })
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
async function modificarProducte(id, nom, descripcio, preu, imatge, categoria, clau) {
    iconoCargaAdmin.style.display = "block";
    divContenido.innerHTML = "";

    fetch(`/api/api.php?modificarProducte&clau=${clau}&id=${id}&nom=${nom}&descripcio=${descripcio}&preu=${preu}&imatge=${imatge}&categoria=${categoria}`, { method: "GET" })
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