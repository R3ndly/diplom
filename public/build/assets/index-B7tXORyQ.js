function f(){let o=1;const r=document.getElementById("vacancies-container"),i=document.getElementById("prev-page"),s=document.getElementById("next-page");if(!r)return;function a(t=1){fetch(`/api/vacancies?page=${t}`).then(n=>n.json()).then(n=>{n.success?(d(n.vacancies),p(n.vacancies),sessionStorage.setItem("currentVacancyPage",t)):l("Вакансии не найдены")}).catch(n=>{console.error("Ошибка загрузки: ",n),l("Ошибка загрузки вакансий")})}function d(t){r.replaceChildren();const n=document.getElementById("vacancy-template");t.data.forEach(e=>{const c=n.content.cloneNode(!0);c.querySelector(".js-title").textContent=e.title,c.querySelector(".js-description").textContent=e.description,c.querySelector(".js-location").textContent+=e.location,c.querySelector(".js-salary").textContent+=`${e.salary} руб.`,c.querySelector(".js-edit-link").href=`/admin/vacancies/edit/${e.vacancy_id}`,c.querySelector(".js-details-link").href=`/admin/vacancies/${e.vacancy_id}`,c.querySelector(".js-delete-form").action=`/admin/vacancies/${e.vacancy_id}`,c.querySelector(".js-delete-form").addEventListener("submit",m=>{m.preventDefault(),u(`/api/vacancies/${e.vacancy_id}`,e.vacancy_id)}),r.appendChild(c)})}function u(t,n){fetch(t,{method:"DELETE",headers:{Accept:"application/json","Content-Type":"application/json","X-CSRF-TOKEN":document.querySelector('meta[name="csrf-token"]').content},body:JSON.stringify({vacancy:n})}).then(e=>{if(!e.ok)throw new Error("Ошибка удаления")}).then(()=>{a(o)}).catch(e=>{console.error("Ошибка при удалении: ",e)})}function p(t){i.disabled=t.current_page===1,s.disabled=t.current_page===t.last_page}i.addEventListener("click",()=>{o>1&&(o--,a(o))}),s.addEventListener("click",()=>{o++,a(o)});function l(t){r.innerHTML=`<p style="color: red">${t}</p>`}a(o)}export{f as v};
