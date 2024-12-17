class Producto {
    constructor(id, nom, descripcio, preu, imatge, categoria) {
        this.id = id;
        this.nom = nom;
        this.descripcio = descripcio;
        this.preu = preu;
        this.imatge = imatge;
        this.categoria = categoria;
    }

    mostrarProducto(clau) {
        const borrarlink = document.createElement("button");
        borrarlink.id = `borrarProducte${this.id}`;
        borrarlink.textContent = "Eliminar Producte";
        borrarlink.addEventListener("click", () => {eliminarProducte(this.id, clau); });

        const parrafo = document.createElement("tr");
        parrafo.className = "tablahistorial";
        parrafo.innerHTML = `<th>${this.id}</th><td>${this.nom}</td><td>${this.descripcio}</td><td>${this.preu}</td><td>${this.imatge}</td><td>${this.categoria}</td>`;

        parrafo.appendChild(borrarlink);

        return parrafo;
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
    inputimatge.type="file";
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
            const tabla = document.createElement("table");
            titul = document.createElement("tr");
            titul.innerHTML = "<th>Id</th><td>Nom</td><td>Descripcio</td><td>Preu</td><td>Imatge</td><td>Categoria</td><td>Borrar</td>";
            titul.className = "tablahistorial"
            tabla.appendChild(titul);

            data.data.forEach(item => {
                const producto = new Producto(
                    item.id,
                    item.nom,
                    item.descripcio,
                    item.preu,
                    item.imatge,
                    item.categoria
                );
            
                tabla.appendChild(producto.mostrarProducto(clau));
            });

            divContenido.appendChild(tabla);
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

    console.log(imatge);

    imatge = imatge.split("\\").pop();

    console.log(imatge);

    imatge = imatge.split(".")[0];

    console.log(imatge);

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