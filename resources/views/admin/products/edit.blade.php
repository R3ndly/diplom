
@extends('layouts.app')
@section('title')Редактировать данные товара @endsection

@section('content')
<div class="row text-center">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Редактирование записи</h2>
        </div>
    </div>
</div>

<div class="container container__create-form">
    <form id="editProductForm" enctype="multipart/form-data">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Название:</strong>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Название">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Цена:</strong>
                    <input type="text" name="price" id="price" class="form-control" placeholder="Цена">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Бренд:</strong>
                    <input type="text" name="brand" id="brand" class="form-control" placeholder="Бренд">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Доставка:</strong>
                    <input type="date" name="delivery" id="delivery" class="form-control" placeholder="Доставка">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Категория:</strong>
                    <input type="text" name="category" id="category" class="form-control" placeholder="Категория">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Гарантия:</strong>
                    <input type="text" name="warranty" id="warranty" class="form-control" placeholder="Гарантия">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Материал:</strong>
                    <input type="text" name="material" id="material" class="form-control" placeholder="Материал">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Питание от:</strong>
                    <input type="text" name="power_supply" id="power_supply" class="form-control" placeholder="Питание от">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Фото:</strong>
                    <input type="file" name="product_image" id="product_image" class="form-control" placeholder="Фото">
                    <div id="currentImage" style="margin-top:10px;"></div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center button-group">
                <button type="submit" class="btn btn-primary">Редактировать</button>
                <a class="btn btn-primary" href="{{route('admin.products.index')}}">Назад</a>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const productId = window.location.pathname.split('/').pop();

    fetch(`/api/products/${productId}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('title').value = data.product.title;
            document.getElementById('price').value = data.product.price;
            document.getElementById('brand').value = data.product.brand;
            document.getElementById('delivery').value = data.product.delivery;
            document.getElementById('category').value = data.product.category;
            document.getElementById('warranty').value = data.product.warranty;
            document.getElementById('material').value = data.product.material;
            document.getElementById('power_supply').value = data.product.power_supply;
        });

    // Обработка отправки формы
    document.getElementById('editProductForm').addEventListener('submit', async function(event) {
        event.preventDefault();

        const form = event.target;
        const formData = new FormData(form);

        formData.append('_method', 'PUT');

        try {
            const response = await fetch(`/api/products/${productId}`, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                },
                body: formData
            });

            if (!response.ok) {
                const errorData = await response.json();
                let message = 'Ошибка при обновлении товара';
                if (errorData.errors) {
                    message += ': ' + Object.values(errorData.errors).flat().join(', ');
                }
                alert(message);
                return;
            }
            // Успешно
            window.location.href = '{{ route("admin.products.index") }}';
        } catch (error) {
            alert('Произошла ошибка при отправке формы');
            console.error(error);
        }
    });
});
</script>
@endsection

