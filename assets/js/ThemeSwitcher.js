// Elements
const body = document.body;
const themeSwitcher = document.querySelector("#themeSwitcher");
const themeSwitcherIcon = document.querySelector("#themeSwitcher i");

// Initialize the theme
let theme = localStorage.getItem("theme") ?? "light";
body.classList.add(theme);
if (theme === "light") {
    themeSwitcherIcon.classList.remove("fa-sun");
    themeSwitcherIcon.classList.add("fa-moon");
} else {
    themeSwitcherIcon.classList.remove("fa-moon");
    themeSwitcherIcon.classList.add("fa-sun");
}

// Event
if (themeSwitcher) {
    themeSwitcher.onclick = (event) => {
        event.stopPropagation();

        if (body.classList.contains("light")) {
            body.classList.replace("light", "dark");
            themeSwitcherIcon.classList.replace("fa-moon", "fa-sun");
            localStorage.setItem("theme", "dark");
        } else {
            body.classList.replace("dark", "light");
            themeSwitcherIcon.classList.replace("fa-sun", "fa-moon");
            localStorage.setItem("theme", "light");
        }
    };
}