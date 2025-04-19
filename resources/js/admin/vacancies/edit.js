export function vacancyEditPage() {
    const vacancyId = window.location.pathname.split('/').pop();

    function getVacancy() {
        fetch(`/api/vacancies/${vacancyId}`).then(response => response.json())
        .then(data => {
            document.getElementById('title').value = data.vacancy.title;
            document.getElementById('description').value = data.vacancy.description;
            document.getElementById('department').value = data.vacancy.department;
            document.getElementById('location').value = data.vacancy.location;
            document.getElementById('type').value = data.vacancy.type;
            document.getElementById('salary').value = data.vacancy.salary;
            document.getElementById('contact_email').value = data.vacancy.contact_email;
            document.getElementById('contact_phone').value = data.vacancy.contact_phone;
        });
    }

    function updateVacancy() {
        document.getElementById('editVacancyForm').addEventListener('submit', (event) => {
            event.preventDefault();

            const formData = {
                title: document.getElementById('title').value,
                description: document.getElementById('description').value,
                department: document.getElementById('department').value,
                location: document.getElementById('location').value,
                type: document.getElementById('type').value,
                salary: document.getElementById('salary').value,
                contact_email: document.getElementById('contact_email').value,
                contact_phone: document.getElementById('contact_phone').value,
            };

            fetch(`/api/vacancies/${vacancyId}`, {
                method: 'PUT',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(formData)
            })
            .then(response => {
                if(!response.ok) {
                    const ErrorData = response.json();
                    throw ErrorData;
                }
                window.location.href = '/admin/vacancies';
            })
            .catch (error  => {
            console.error('Ошибочка -> ', error);
            });
        });
    }

    getVacancy();
    updateVacancy();
}
