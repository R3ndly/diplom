@extends('layouts.app')
@section('styles')
    @vite(['resources/css/products.css'])
@endsection
@section('title')Аксессуары для умного дома @endsection
@section('content')
<h1 class="text-center">Аксессуары для умного дома</h1><br>

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <div id="myModal" class="modal" style="display:none;">
                <div class="modal-content products">
                    <span class="close" onclick="closeWindow()">&times;</span>
                    <h2>Информация о товаре</h2>
                    <div id="productDetails" class="details-bd"></div>
                </div>
            </div>
        </div>

        <!-- Добавлена кнопка создания товара -->
        <div class="pull-right">
            <a class="btn btn-primary w-80" href="{{ route('admin.products.create') }}">Добавить аксессуар</a>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <!-- Блок фильтров (левая колонка) -->
        <div class="col-md-3 filters-container">
            <form id="filterForm" class="filters">
                <!-- Фильтры остаются без изменений -->
                <div class="form-group1 price-filter">
                    <label>Цена:</label>
                    <input type="number" name="min_price" id="min-price" min="0" max="10000" value="0" class="price-filter-input" step="1">
                    <input type="number" name="max_price" id="max-price" min="0" max="10000" value="10000" step="1">
                </div>

                <div class="form-group1 brand-filter">
                    <label for="brand">Бренд:</label>
                    <select name="brand" id="brand">
                        <option value="">Все бренды</option>
                        <!-- Бренды будут подгружены через JS -->
                    </select>
                </div>

                <div class="form-group1 category-filter">
                    <label for="category">Категория:</label>
                    <select name="category" id="category">
                        <option value="">Все категории</option>
                        <!-- Категории будут подгружены через JS -->
                    </select>
                </div>

                <div class="form-group1 warranty-filter">
                    <label for="warranty">Гарантия:</label>
                    <select name="warranty" id="warranty">
                        <option value="">Все гарантии</option>
                        <!-- Гарантии будут подгружены через JS -->
                    </select>
                </div>

                <div class="form-group1 material-filter">
                    <label for="material">Материал:</label>
                    <select name="material" id="material">
                        <option value="">Все материалы</option>
                        <!-- Материалы будут подгружены через JS -->
                    </select>
                </div>

                <div class="form-group1 power-supply-filter">
                    <label for="power_supply">Питание:</label>
                    <select name="power_supply" id="power_supply">
                        <option value="">Все типы питания</option>
                        <!-- Типы питания будут подгружены через JS -->
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Отфильтровать</button>
            </form>
        </div>

        <!-- Блок товаров (правая колонка) -->
        <div class="col-md-9 products-container">
            <div class="products" id="products-container">
                <!-- Товары будут подгружены через JS -->
            </div>
            <div class="paginate__menu products" id="pagination-links"></div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let currentPage = 1;
    const productsContainer = document.getElementById('products-container');
    const paginationContainer = document.getElementById('pagination-links');
    const filterForm = document.getElementById('filterForm');

    // Загрузка фильтров
    async function loadFilters() {
        try {
            const response = await fetch('/api/products/filters');
            const filters = await response.json();

            ['brand', 'category', 'warranty', 'material', 'power_supply'].forEach(id => {
                const select = document.getElementById(id);
                while (select.options.length > 1) select.remove(1);
            });

            populateSelect('brand', filters.brands);
            populateSelect('category', filters.categories);
            populateSelect('warranty', filters.warranties);
            populateSelect('material', filters.materials);
            populateSelect('power_supply', filters.powerSupplies);
        } catch (error) {
            console.error('Ошибка загрузки фильтров:', error);
        }
    }

    function populateSelect(id, items) {
        const select = document.getElementById(id);
        items.forEach(item => {
            const option = document.createElement('option');
            option.value = item;
            option.textContent = item;
            select.appendChild(option);
        });
    }

    // Загрузка товаров
    async function loadProducts(page = 1) {
        try {
            const formData = new FormData(filterForm);
            const params = new URLSearchParams(formData);
            params.append('page', page);

            const response = await fetch(`/api/products/filter?${params.toString()}`);
            const data = await response.json();

            renderProducts(data.products.data);
            renderPagination(data.products);
            currentPage = page;
        } catch (error) {
            console.error('Ошибка загрузки данных:', error);
            productsContainer.innerHTML = '<div class="error-message">Ошибка загрузки товаров</div>';
        }
    }

    function renderProducts(products) {
        productsContainer.innerHTML = products.map(product => `
            <div class="card">
                <div class="card-img-top">
                    <img src="${product.product_image.startsWith('http') ? product.product_image : '/' + product.product_image}">
                    <div class="card-body">
                        <h5 class="card-title">
                            ${product.title.length > 49 ? product.title.substring(0, 49) + '...' : product.title}
                            ${product.title.length > 190 ? '<span>...</span>' : ''}
                        </h5>
                        <p class="card-text">${product.price} ₽</p>

                        <div class="action-buttons">
                            <input type="button" class="pokazat" style="display: inline-block; margin-right: 6px;"
                                   onclick="showProductDetails(${JSON.stringify(product).replace(/"/g, '&quot;')}, '${product.product_image.startsWith('http') ? product.product_image : '/' + product.product_image}')" />

                            <!-- Добавлены кнопки администрирования -->
                            <form action="/api/product/${product.product_id}" method="POST" style="display: inline-block;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="ydalit"></button>
                            </form>

                            <a href="/admin/products/edit/${product.product_id}" class="izmenit"></a>

                            <button class="Add-in-cart" data-product-id="${product.product_id}"></button>
                        </div>
                    </div>
                </div>
            </div>
        `).join('');
    }

    // Добавление в корзину

async function addToCart(productId) {
        try {
            const response = await fetch('/api/cart/add/' + productId, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });

            const data = await response.json();

            if (response.ok) {
                alert('Товар добавлен в корзину');
                showCartNotification(data.message || 'Товар добавлен в корзину');
                if (data.cart_count) {
                    updateCartCount(data.cart_count);
                }
            } else {
                throw new Error(data.message || 'Ошибка при добавлении в корзину');
            }
        } catch (error) {
            console.error('Ошибка:', error);
            showCartNotification(error.message || 'Не удалось добавить товар в корзину', true);
        }
    }


    // Удаление товара
   async function deleteProduct(productId) {
    if (!confirm('Вы уверены, что хотите удалить этот товар?')) return false;

    try {
        const response = await fetch(`/api/products/${productId}`, {
            method: 'DELETE',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        });

        const data = await response.json();

        if (response.ok) {
            // Удаляем карточку товара из DOM
            const productCard = document.querySelector(`.card [data-product-id="${productId}"]`)?.closest('.card');
            if (productCard) {
                productCard.style.opacity = '0';
                setTimeout(() => productCard.remove(), 300);
            }

            showCartNotification('Товар успешно удалён');
        } else {
            throw new Error(data.message || 'Ошибка при удалении');
        }
    } catch (error) {
        console.error('Ошибка:', error);
        showCartNotification(error.message || 'Не удалось удалить товар', true);
    }
}

// Новый обработчик для кнопок удаления
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('ydalit')) {
        e.preventDefault();
        const form = e.target.closest('form');
        const productId = form.action.split('/').pop();
        deleteProduct(productId);
    }


});
    // Уведомления
    function showCartNotification(message, isError = false) {
        const notification = document.createElement('div');
        notification.className = `cart-notification ${isError ? 'error' : 'success'}`;
        notification.textContent = message;
        document.body.appendChild(notification);

        setTimeout(() => {
            notification.classList.add('fade-out');
            setTimeout(() => notification.remove(), 500);
        }, 3000);
    }

    // Обновление счетчика корзины
    function updateCartCount(count) {
        const cartCounter = document.getElementById('cart-counter');
        if (cartCounter) {
            cartCounter.textContent = count;
            cartCounter.classList.add('pulse');
            setTimeout(() => cartCounter.classList.remove('pulse'), 500);
        }
    }

    // Обработчик кликов по кнопкам корзины
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('Add-in-cart')) {
            e.preventDefault();
            const productId = e.target.dataset.productId;
            addToCart(productId);
        }
    });

    function renderPagination(pagination) {
        let links = '';

        if(pagination.prev_page_url) {
            links += `<a href="#" onclick="loadPage(${pagination.current_page - 1}); return false;" class="page-link btn">&laquo; Назад</a> `;
        }

        if(pagination.next_page_url) {
            links += `<a href="#" onclick="loadPage(${pagination.current_page + 1}); return false;" class="page-link btn">Вперед &raquo;</a>`;
        }

        paginationContainer.innerHTML = links;
    }

    // Глобальные функции
    window.loadPage = function(page) {
        loadProducts(page);
        return false;
    }

    window.showProductDetails = function(product, productImage) {
        const detailsHtml = `
        <div class="window-info">
            <div><strong>Название:</strong> ${product.title}</div>
            <div><strong>Цена:</strong> ${product.price} ₽</div>
            <div><strong>Бренд:</strong> ${product.brand}</div>
            <div><strong>Доставка:</strong> ${product.delivery}</div>
            <div><strong>Категория:</strong> ${product.category}</div>
            <div><strong>Гарантия:</strong> ${product.warranty}</div>
            <div><strong>Материал:</strong> ${product.material}</div>
            <div><strong>Питание от:</strong> ${product.power_supply}</div>
            <img src="${productImage}" style="right: 0; top: 0; width: 240px; height: auto;" />
        </div>
        `;

        document.getElementById('productDetails').innerHTML = detailsHtml;
        document.getElementById('myModal').style.display = "block";
    }

    window.closeWindow = function() {
        document.getElementById('myModal').style.display = "none";
    }

    // Обработчики событий
    filterForm.addEventListener('submit', function(e) {
        e.preventDefault();
        currentPage = 1;
        loadProducts(currentPage);
    });

    // Инициализация
    loadFilters();
    loadProducts(currentPage);
});
</script>
@endsection
