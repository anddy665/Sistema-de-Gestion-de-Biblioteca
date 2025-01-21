document.addEventListener("DOMContentLoaded", () => {
    const tabs = document.querySelectorAll('#libraryTabs button');
    tabs.forEach(tab => {
        tab.addEventListener('shown.bs.tab', event => {
            console.log(`you are on tab: ${event.target.innerText}`);
        });
    });
});
