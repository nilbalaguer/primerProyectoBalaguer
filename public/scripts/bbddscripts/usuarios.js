async function mostrarUsuari(filtro, clau) {
    iconoCargaAdmin.style.display = "block";
    divContenido.innerHTML = "";

    //Botons per crear i modificar comandes
    const botoncrear = document.createElement("button");
    const botonmodificar = document.createElement("button");

    const inputid = document.createElement("input");
    inputid.placeholder = "id_usuari";

    const inputnom = document.createElement("input");
    inputnom.placeholder = "nom";

    const inputusuari = document.createElement("input");
    inputusuari.placeholder = "usuari";

    const inputcontrasenya = document.createElement("input");
    inputcontrasenya.placeholder = "contrasenya";

    botoncrear.textContent = "Crear";
    botoncrear.addEventListener("click", () => {crearUsuari(inputnom.value, inputusuari.value, inputcontrasenya.value, clau)});

    botonmodificar.textContent = "Modificar";
    botonmodificar.addEventListener("click", () => {modificarUsuari(inputid.value, inputnom.value, inputusuari.value, inputcontrasenya.value, clau)});

    divContenido.appendChild(inputid);
    divContenido.appendChild(inputnom);
    divContenido.appendChild(inputusuari);
    divContenido.appendChild(inputcontrasenya);

    divContenido.appendChild(botoncrear);
    divContenido.appendChild(botonmodificar);

    fetch(`/api/api.php?usuaris=${filtro}&clau=${clau}`, { method: "GET" })
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
                const id = item.id;
                const nom = item.nom;
                const usuari = item.usuari;
                const contrasenya = item.contrasenya;

                //id, nom, descripcio, preu, imatge, categoria
    
                console.log(`ID: ${id} Nom: ${nom} Usuari: ${usuari} Contrasenya: ${contrasenya}`);
    
                // Crear elementos para mostrar los datos en el DOM
                const parrafo = document.createElement("p");
                parrafo.className = "recuadreComandaAdmin";
                parrafo.textContent = `ID: ${id} Nom: ${nom} Usuari: ${usuari} Contrasenya: ${contrasenya}`;
                const borrarlink = document.createElement("button");
                borrarlink.id = `borrarUsuari${id}`;
                borrarlink.textContent = "Eliminar Usuari";
                borrarlink.addEventListener("click", () => {eliminarUsuari(id, clau)});
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
async function eliminarUsuari(id, clau) {
    iconoCargaAdmin.style.display = "block";
    divContenido.innerHTML = "";

    fetch(`/api/api.php?eliminarUsuari=${id}&clau=${clau}`, { method: "GET" })
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
async function crearUsuari(nom, usuari, contrasenya, clau) {
    iconoCargaAdmin.style.display = "block";
    divContenido.innerHTML = "";

    fetch(`/api/api.php?crearUsuari&clau=${clau}&nom=${nom}&usuari=${usuari}&contrasenya=${contrasenya}`, { method: "GET" })
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
async function modificarUsuari(id, nom, usuari, contrasenya, clau) {
    iconoCargaAdmin.style.display = "block";
    divContenido.innerHTML = "";

    fetch(`/api/api.php?modificarUsuari&clau=${clau}&id=${id}nom=${nom}&usuari=${usuari}&contrasenya=${contrasenya}`, { method: "GET" })
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