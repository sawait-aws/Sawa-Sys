document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("openbtn").addEventListener("click", toggleSidebar);

    function toggleSidebar() {
        var sidebar = document.getElementById("mySidebar");
        var main = document.getElementById("main");
        var topnav = document.getElementById("topnav");

        if (sidebar.style.left === "0px") {
            sidebar.style.left = "-250px";
            main.style.marginLeft = "0px";
            topnav.style.marginLeft = "0px";
        } else {
            sidebar.style.left = "0px";
            main.style.marginLeft = "250px";
            topnav.style.marginLeft = "250px";
        }
    }
});
