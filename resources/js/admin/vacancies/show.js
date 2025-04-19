export function vacancyShowPage() {
    const container = document.getElementById('vacancy-container');
    const vacancyId = window.location.pathname.split('/').pop();

    if(!container) return;

    function loadVacancy() {
        fetch(`/api/vacancies/${vacancyId}`).then(response => response.json())
        .then(vacancy => {
            if(vacancy.success) {
                const template = document.getElementById('vacancy-template');
                const clone = template.content.cloneNode(true);

                clone.querySelector('.vacancy-title').textContent = vacancy.vacancy.title;
                clone.querySelector('.vacancy-department').textContent += vacancy.vacancy.department;
                clone.querySelector('.vacancy-description').textContent = vacancy.vacancy.description;
                clone.querySelector('.vacancy-location-type').textContent += `${ vacancy.vacancy.location }, ${ vacancy.vacancy.type }`;
                clone.querySelector('.vacancy-salary').textContent += `${ vacancy.vacancy.salary } руб.`;
                clone.querySelector('.vacancy-contact_email').textContent += vacancy.vacancy.contact_email;
                clone.querySelector('.vacancy-contact_phone').textContent += vacancy.vacancy.contact_phone;
                clone.querySelector('.vacancy-publication').textContent += vacancy.vacancy.published_at;

                container.appendChild(clone);
            } else {
                container.innerHTML = '<p style="color:red;">Вакансия не найдена!</p>';
            }
        })
        .catch(error => {
            console.error('Error', error);
            container.innerHTML = '<p style="color:red;">Ошибка загрузки вакансии</p>';
        });
    }

    loadVacancy();
}
