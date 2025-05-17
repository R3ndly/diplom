@extends('layouts.app')
@section('styles')
    @vite(['resources/css/cart.css'])
@endsection
@section('title') Ваша корзина товаров @endsection
@section('content')

<div class="container">
    <div class="d-flex justify-content-between align-items-center oformit">
        <h2 class="js-cart">Корзина на</h2>

            <a href="/orders/create" class="mb-0 btn btn-primary">Оформить доставку</a>
    </div>
</div>

<div class="container">
    <div class="blok"></div>
        <template id="template_block_product">
            <div class="block_product">
                <div class="cart_img">
                    <img src="#" class="image__product">
                </div>
                <div class="cart_specifications">
                    <div class="cart_title">
                        <h3 class="js-title"></h3>
                    </div>
                    <div class="cart_description">
                        <div>
                            <p class="js-quantity">Количество:</p>
                            <p class="js-total_price">Стоимость: </p>
                            <p class="js-warranty">Гарантия на </p>
                        </div>
                        <div>
                            <p class="js-brand">Производитель: </p>
                            <p class="js-material">Материал:</p>
                            <p class="js-power_supply">Питание от</p>
                        </div>
                    </div>
                </div>
                <div class="action_buttons">
                    <form action="#">
                        <button type="submit" class="ydalit"></button>
                    </form>
                </div>
            </div>
        </template>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const cartContainer = document.querySelector('.blok');
    const productTemplate = document.getElementById('template_block_product');

    const loadCart = async () => {
        try {
            const response = await fetch('/api/cart', {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                credentials: 'include'
            });

            if (response.ok) {
                const result = await response.json();

                if (result.success) {
                    cartContainer.innerHTML = '';
                    const productInfoElement = document.querySelector('.js-cart');
                    const total = result.data.reduce((sum, item) => sum + item.total_price, 0);
                    productInfoElement.innerHTML = `Корзина на ${total} руб.`;

                    result.data.forEach(item => {
                    const clone = productTemplate.content.cloneNode(true);


                    clone.querySelector('.image__product').src = item.product_image;
                    clone.querySelector('.js-title').textContent = item.title;
                    clone.querySelector('.js-quantity').textContent = `Количество: ${item.quantity}`;
                    clone.querySelector('.js-total_price').textContent = `Стоимость: ${item.total_price} ₽`;
                    clone.querySelector('.js-warranty').textContent = `Гарантия: ${item.warranty}`;
                    clone.querySelector('.js-brand').textContent = `Производитель: ${item.brand}`;
                    clone.querySelector('.js-material').textContent = `Материал: ${item.material}`;
                    clone.querySelector('.js-power_supply').textContent = `Питание: ${item.power_supply}`;

                    clone.querySelector('.ydalit').addEventListener('click', async (e) => {
                        e.preventDefault();
                        try {
                                const response = await fetch(`/api/cart/${item.cart_id}`, {
                                    method: 'DELETE',
                                    headers: {
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                        'X-Requested-With': 'XMLHttpRequest'
                                    },
                                    credentials: 'include'
                                });
                                if (response.ok) {
                                    loadCart();
                                } else {
                                    console.error('Ошибка HTTP: ', response.status);
                                }
                        } catch (error) {
                            console.error('Ошибка удаления:', error);
                        }
                    });
                    cartContainer.appendChild(clone);
                    });
                }
            }
        } catch (error) {
            console.error('Ошибка:', error);
        }
    }
    loadCart();
});
</script>
@endsection
