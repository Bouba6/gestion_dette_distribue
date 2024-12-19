const form = document.getElementById('form');

form.addEventListener('submit', async (e) => {
    // Empêcher le comportement par défaut du formulaire (soumission du formulaire)
    e.preventDefault();
    const login = document.getElementById('login').value;
    const password = document.getElementById('password').value;
    const formData = new FormData();
    formData.append('login', login);
    formData.append('password', password);
    try {
        const response = await fetch('http://127.0.0.1:8000/login', {
            method: 'POST',
            body: formData
        });
        if (response.ok) {
            alert('Connexion reussie !');
            window.location.href = '/clientList';
        } else {
            const errorText = await response.text();
            console.error('Server Error Response:', errorText);
            alert('Erreur lors de la connexion: ' + errorText);
            window.location.href = '/register';
        }
    } catch (error) {
        console.error(error);
    }
});