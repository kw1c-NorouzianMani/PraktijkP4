// Voor eventueel interactieve scripts
console.log("Script geladen");
window.addEventListener("DOMContentLoaded", () => {
    const flash = document.getElementById("flash");
    if (flash) {
        setTimeout(() => {
            flash.style.opacity = "0";
            setTimeout(() => flash.remove(), 500);
        }, 3000);
    }
});
function togglePassword() {
    const field = document.getElementById('password');
    field.type = field.type === 'password' ? 'text' : 'password';
}
// Navbar transparant op scroll
window.addEventListener('scroll', () => {
    const header = document.querySelector('.main-header');
    if (window.scrollY > 10) {
        header.classList.add('scrolled');
    } else {
        header.classList.remove('scrolled');
    }
});

// Oogknop wachtwoord tonen/verbergen
function togglePassword() {
    const field = document.getElementById('password');
    const icon = document.querySelector('.toggle-password');
    if (field.type === 'password') {
        field.type = 'text';
        icon.textContent = '🙈';
    } else {
        field.type = 'password';
        icon.textContent = '👁️';
    }
}
