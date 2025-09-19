alert("👋 Welcome to HERNANDEZ website! Enjoy your stay 😊");

/* 🌙 Dark Mode Toggle */
function toggleTheme() {
    document.body.classList.toggle("dark");
    localStorage.setItem("theme", document.body.classList.contains("dark") ? "dark" : "light");
}

