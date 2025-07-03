import './style.css'

document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('leadForm') as HTMLFormElement | null;
  if (!form) return;

  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    const formData = new FormData(form);
    const params = new URLSearchParams();
    formData.forEach((value, key) => {
      if (typeof value === 'string') {
        params.append(key, value);
      }
    });

    try {
      const response = await fetch('http://www.readydubailicense.com/sendleadformemail.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: params.toString(),
      });

      const data = await response.json();
      if (data.status === 'success') {
        alert('Request submitted successfully!');
        form.reset();
      } else {
        alert(data.message || 'Submission failed');
      }
    } catch (err) {
      alert('Submission error');
    }
  });
});

