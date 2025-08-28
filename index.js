    
    function togglePassword(inputId, icon) {
        const input = document.getElementById(inputId);
        const isVisible = input.type === "text";
        input.type = isVisible ? "password" : "text";
        icon.classList.toggle("fa-eye");
        icon.classList.toggle("fa-eye-slash");
    }
    