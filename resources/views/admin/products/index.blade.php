@extends('layouts.app')
@section('title')Акксесуары для умного дома @endsection
@section('content')
<h1 class="text-center ">Аксессуары для умного дома</h1><br>

<div class="container">
<div class="row">
<div class="col-lg-12 margin-tb">
    <div class="pull-left">

        <div id="myModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close" onclick="closeWindow()">&times;</span>
        <h2>Информация об аксесуаре:</h2>
        <div id="productDetails" class="details-bd"></div>
    </div>
</div>

    </div>

    <div class="pull-right">
        <a class="btn btn-primary" href="{{ route('admin.products.create') }}"> Добавить аксесуар</a>
    </div><br><br>
</div>
</div>

</div>
<form action="{{ route('admin.products.filter') }}" method="GET" class="mb-4">

    <div class="form-group1 price-filter">
        <label for="min-price">Минимальная цена: <span id="min-price-label">{{ isset($minPrice) ? $minPrice : 0 }}</span></label>
        <input type="range" name="min_price" id="min-price" min="0" max="10000" value="{{ isset($minPrice) ? $minPrice : 0 }}" step="1" oninput="updateMinPrice()">

        <label for="max-price">Максимальная цена: <span id="max-price-label">{{ isset($maxPrice) ? $maxPrice : 10000 }}</span></label>
        <input type="range" name="max_price" id="max-price" min="0" max="10000" value="{{ isset($maxPrice) ? $maxPrice : 10000 }}" step="1" oninput="updateMaxPrice()">
    </div>

    <button type="submit" class="btn btn-primary">Применить фильтр</button>
</form>


<div class="container">
    <div class="row-products">

        <div class="col-md-9">
            <h3>Продукты</h3>
            <div class="products">
                @foreach($products as $product)
                    <div class="col-md-4 mb-4 blok">
                        <div class="card">
                            <img src="{{ asset($product->product_image) }}" class="card-img-top" style="height: 308px; width: 308px;" alt="{{ $product->title }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->title }}</h5>
                                <p class="card-text">{{ $product->price }} ₽</p>

                                <div class="action-buttons">
                                    <input type="button" class="pokazat" style="display: inline-block; margin-right: 6px;" onclick="showProductDetails({{ json_encode($product) }})" />

                                    <form action="{{ route('admin.products.destroy', $product->product_id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="ydalit"></button>
                                    </form>

                                    <form action="{{ route('admin.products.edit', $product->product_id) }}" method="GET" style="display: inline-block;">
                                        <button type="submit" class="izmenit"></button>
                                    </form>

                                    <form action="{{ route('cart.add', $product->product_id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        <button type="submit" class="Add-in-cart"></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
function showProductDetails(product) {
    var detailsHtml = `
     <div class="window-info" style="position: relative; padding-right: 95px;">
        <div style="margin-right: 160px;">
            <div><strong>Название:</strong> ${product.title}</div>
            <div><strong>Цена:</strong> ${product.price} ₽</div>
            <div><strong>Бренд:</strong> ${product.brand}</div>
            <div><strong>Доставка:</strong> ${product.delivery}</div>
            <div><strong>Категория:</strong> ${product.category}</div>
            <div><strong>Гарантия:</strong> ${product.warranty}</div>
            <div><strong>Материал:</strong> ${product.material}</div>
            <div><strong>Питание от:</strong> ${product.power_supply}</div>
        </div>
        <img src="${product.product_image}" alt="${product.title}" style="position: absolute; right: 0; top: 0; width: 240px; height: auto;" />
     </div>
    `;

    // Заполнение модального окна данными о работнике
    document.getElementById('productDetails').innerHTML = detailsHtml;

    // Показываем модальное окно
    document.getElementById('myModal').style.display = "block";
}

function closeWindow() {
    // Скрываем модальное окно
    document.getElementById('myModal').style.display = "none";
}

function updateMinPrice() {
    const minPriceInput = document.getElementById('min-price');
    const minPriceLabel = document.getElementById('min-price-label');
    minPriceLabel.innerText = minPriceInput.value;

    // Убедитесь, что минимальная цена не превышает максимальную
    const maxPriceInput = document.getElementById('max-price');
    if (parseInt(minPriceInput.value) > parseInt(maxPriceInput.value)) {
        maxPriceInput.value = minPriceInput.value;
        document.getElementById('max-price-label').innerText = maxPriceInput.value;
    }
}

function updateMaxPrice() {
    const maxPriceInput = document.getElementById('max-price');
    const maxPriceLabel = document.getElementById('max-price-label');
    maxPriceLabel.innerText = maxPriceInput.value;

    // Убедитесь, что максимальная цена не меньше минимальной
    const minPriceInput = document.getElementById('min-price');
    if (parseInt(maxPriceInput.value) < parseInt(minPriceInput.value)) {
        minPriceInput.value = maxPriceInput.value;
        document.getElementById('min-price-label').innerText = minPriceInput.value;
    }
}

function applyFilter() {
    const minPrice = document.getElementById('min-price').value;
    const maxPrice = document.getElementById('max-price').value;

    // Здесь вы можете добавить код для применения фильтрации товаров
    console.log(`Применение фильтра: от ${minPrice} до ${maxPrice}`);
}

</script>


@endsection