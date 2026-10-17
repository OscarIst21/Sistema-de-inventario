// login.js
// Interacciones visuales: mostrar/ocultar contraseña y manejar submit (no real auth).
document.addEventListener('DOMContentLoaded', function () {
  const toggleBtn = document.getElementById('togglePassword');
  const passwordInput = document.getElementById('password');
  const eyeIcon = document.getElementById('eyeIcon');
  const form = document.getElementById('loginForm');

  // Toggle password visibility
  toggleBtn.addEventListener('click', function () {
    const isHidden = passwordInput.type === 'password';
    if (isHidden) {
      passwordInput.type = 'text';
      toggleBtn.setAttribute('aria-pressed', 'true');
      toggleBtn.setAttribute('aria-label', 'Ocultar contraseña');
      // Replace eye icon with eye-off (simple path swap)
      eyeIcon.innerHTML = '<path d="M2 12s4-7 10-7c1.9 0 3.7.44 5.3 1.2" stroke="#2B6B2E" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" /><path d="M22 12s-4 7-10 7c-1.9 0-3.7-.44-5.3-1.2" stroke="#2B6B2E" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" /><path d="M3 3l18 18" stroke="#2B6B2E" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>';
    } else {
      passwordInput.type = 'password';
      toggleBtn.setAttribute('aria-pressed', 'false');
      toggleBtn.setAttribute('aria-label', 'Mostrar contraseña');
      eyeIcon.innerHTML = '<path d="M2 12s4-7 10-7 10 7 10 7-4 7-10 7S2 12 2 12z" stroke="#2B6B2E" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="12" r="2.4" fill="#2B6B2E"/>';
    }
    // Give focus back to input for better UX
    passwordInput.focus();
  });

  // NAVEGACIÓN DE DESARROLLO (temporal):
  // El formulario redirige a dashboard.php mediante su atributo action.
  // No se verifica credenciales. Cuando se conecte el backend, cambiar
  // action por el endpoint de autenticación y eliminar esta observación.
  // No se interrumpe el envío: la redirección ocurre de forma natural.

  // Progressive enhancement: enable keyboard activation for toggle
  toggleBtn.addEventListener('keyup', function (e) {
    if (e.key === 'Enter' || e.key === ' ') toggleBtn.click();
  });
});
