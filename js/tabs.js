document.addEventListener("DOMContentLoaded", () => {
    // Ejemplo: Mostrar un mensaje cuando se cambia de pestaña
    const tabs = document.querySelectorAll('#libraryTabs button');
    tabs.forEach(tab => {
        tab.addEventListener('shown.bs.tab', event => {
            console.log(`Cambiaste a la pestaña: ${event.target.innerText}`);
        });
    });
});
