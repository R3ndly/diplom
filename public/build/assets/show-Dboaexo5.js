function r(){const n=document.getElementById("vacancy-container"),c=window.location.pathname.split("/").pop();if(!n)return;function o(){fetch(`/api/vacancies/${c}`).then(t=>t.json()).then(t=>{if(t.success){const e=document.getElementById("vacancy-template").content.cloneNode(!0);e.querySelector(".vacancy-title").textContent=t.vacancy.title,e.querySelector(".vacancy-department").textContent+=t.vacancy.department,e.querySelector(".vacancy-description").textContent=t.vacancy.description,e.querySelector(".vacancy-location-type").textContent+=`${t.vacancy.location}, ${t.vacancy.type}`,e.querySelector(".vacancy-salary").textContent+=`${t.vacancy.salary} руб.`,e.querySelector(".vacancy-contact_email").textContent+=t.vacancy.contact_email,e.querySelector(".vacancy-contact_phone").textContent+=t.vacancy.contact_phone,e.querySelector(".vacancy-publication").textContent+=t.vacancy.published_at,n.appendChild(e)}else n.innerHTML='<p style="color:red;">Вакансия не найдена!</p>'}).catch(t=>{console.error("Error",t),n.innerHTML='<p style="color:red;">Ошибка загрузки вакансии</p>'})}o()}export{r as v};
