import './bootstrap';
import { vacanciesIndexPage } from './admin/vacancies/index.js';
import { vacancyShowPage } from './admin/vacancies/show.js';
import { vacancyCreatePage } from './admin/vacancies/create.js';
import { vacancyEditPage } from './admin/vacancies/edit.js';

if(document.getElementById('vacancies-container')) {
    vacanciesIndexPage();
}

if(document.getElementById('vacancy-container')) {
    vacancyShowPage();
}

if(document.getElementById('createVacancyForm')) {
    vacancyCreatePage();
}

if(document.getElementById('editVacancyForm')) {
    vacancyEditPage();
}
