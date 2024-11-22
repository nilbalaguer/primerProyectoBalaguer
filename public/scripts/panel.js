const botonmostrar = document.getElementById("buttonmostrarcomandes");
const divContenido = document.getElementById("divdecontenidoadmin");

botonmostrar.addEventListener("click", mostrarProductos);

async function mostrarProductos() {
    fetch(`/api/api.php?comandes`, { method: "GET" })
    .then(response => {
        if (!response.ok) {
            throw new Error("Error en la solicitud");
        }
        return response.json();
    })
    .then(data => {
        console.log(data); // Mostrará { guapa: "nuria" }
        const parrafo = document.createElement("p");
        parrafo.textContent = `Respuesta: ${JSON.stringify(data)}`;
        divContenido.appendChild(parrafo);
    })
    .catch(error => {
        console.error("Error:", error);
        document.body.innerHTML += `<p>Error: ${error.message}</p>`;
    });
}