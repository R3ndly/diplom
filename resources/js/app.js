import './bootstrap';
import { initVacanciesPage } from './admin/vacancies/index.js';

if(document.getElementById('vacancies-container')) {
    initVacanciesPage();
}
