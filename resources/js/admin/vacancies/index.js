export function initVacanciesPage() {
    let currentPage = 1;
    const container = document.getElementById('vacancies-container');
    const prevBtn = document.getElementById('prev-page');
    const nextBtn = document.getElementById('next-page');

    if(!container) return;

    function loadVacancies(page = 1) {
        fetch(`/api/vacancies?page=${page}`).then(response => response.json())
        .then(data => {
            if(data.success) {
                renderVacancies(data.vacancies);
                updatePagination(data.vacancies);
            } else {
                showError("Вакансии не найдены");
            }
        })
        .catch(error => {
            console.error("Ошибка загрузки: ", error);
            showError("Ошибка загрузки вакансий");
        });
    }

    function renderVacancies(vacancies) {
        container.replaceChildren();
        const template = document.getElementById('vacancy-template');

        vacancies.data.forEach(vacancy => {
            const clone = template.content.cloneNode(true);

            clone.querySelector('.js-title').textContent = vacancy.title;
            clone.querySelector('.js-description').textContent = vacancy.description;
            clone.querySelector('.js-location').textContent += vacancy.location;
            clone.querySelector('.js-salary').textContent += `${vacancy.salary} руб.`;

            clone.querySelector('.js-edit-link').href = `/admin/vacancies/edit/${vacancy.vacancy_id}`;
            clone.querySelector('.js-details-link').href = `/admin/vacancies/${vacancy.vacancy_id}`;
            clone.querySelector('.js-delete-form').action = `/admin/vacancies/${vacancy.vacancy_id}`;
            clone.querySelector('.js-delete-form').addEventListener('submit', (event) => {
                event.preventDefault();
                deleteVacancy(`/admin/vacancies/${vacancy.vacancy_id}`, vacancy.vacancy_id);
            });


            container.appendChild(clone);
        });
    }

    function deleteVacancy(url, vacancyId) {
        fetch(url, {
            method: 'DELETE',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ vacancy: vacancyId })
        })
        .then(response => {
            if(!response.ok) throw new Error('Ошибка удаления');
        })
        .then(() => {
            loadVacancies(currentPage);
        })
        .catch(error => {
            console.error('Ошибка при удалении: ', error);
        });
    }

    function updatePagination(vacancies) {
        prevBtn.disabled = vacancies.current_page === 1;
        nextBtn.disabled = vacancies.current_page === vacancies.last_page;
    }

    prevBtn.addEventListener('click', () => {
        if(currentPage > 1) {
            currentPage--;
            loadVacancies(currentPage);
        }
    });

    nextBtn.addEventListener('click', () => {
        currentPage++;
        loadVacancies(currentPage);
    });

    function showError(message) {
        container.innerHTML = `<p style="color: red">${message}</p>`;
    }

    loadVacancies(currentPage);
}
