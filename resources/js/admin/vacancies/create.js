export function vacancyCreatePage() {
    function createVacancy() {
        document.getElementById('createVacancyForm').addEventListener('submit', (event) => {
            event.preventDefault();

            const formData = new FormData(event.target);

            fetch('/api/vacancies', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(Object.fromEntries(formData))
            })
            .then(response => {
                if(response.ok) {
                    window.location.href = '/admin/vacancies';
                } else {
                    const ErrorData = response.json();
                    throw ErrorData;
                }
            })
            .catch(error => {
                console.error('Ошибочка: ', error);
            });
        });
    }

    createVacancy();
}