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