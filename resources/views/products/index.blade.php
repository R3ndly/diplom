@extends('layouts.app')
@section('styles')
    @vite(['resources/css/products.css'])
@endsection
@section('title')Акксесуары для умного дома @endsection
@section('content')
<h1 class="text-center ">Аксессуары для умного дома</h1><br>

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <div id="myModal" class="modal" style="display:none;">
                <div class="modal-content products">
                    <span class="close" onclick="closeWindow()">&times;</span>
                    <h2>Информация о сотруднике</h2>
                <div id="productDetails" class="details-bd"></div>
            </div>
        </div>
    </div>
</div>

    <div class="filters-container">
        <form action="{{ route('products.filter') }}" method="GET" class="filters">
            <div class="form-group1 price-filter">
                <label>Цена:</label>
                <input type="number" name="min_price" id="min-price" min="0" max="10000" value="0" class="price-filter-input" step="1">
                <input type="number" name="max_price" id="max-price" min="0" max="10000" value="10000" step="1">
            </div>

            <div class="form-group1 brand-filter">
                <label for="brand">Бренд:</label>
                <select name="brand" id="brand">
                    <option value="">Все бренды</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand }}">{{ $brand }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group1 category-filter">
                <label for="category">Категория:</label>
                <select name="category" id="category">
                    <option value="">Все категории</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category }}">{{ $category }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group1 warranty-filter">
                <label for="warranty">Гарантия:</label>
                <select name="warranty" id="warranty">
                    <option value="">Все гарантии</option>
                    @foreach ($warranties as $warranty)
                        <option value="{{ $warranty }}">{{ $warranty }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group1 material-filter">
                <label for="material">Материал:</label>
                <select name="material" id="material">
                    <option value="">Все материалы</option>
                    @foreach ($materials as $material)
                        <option value="{{ $material }}">{{ $material }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group1 power-supply-filter">
                <label for="power_supply">Питание:</label>
                <select name="power_supply" id="power_supply">
                    <option value="">Все типы питания</option>
                    @foreach ($powerSupplies as $powerSupply)
                        <option value="{{ $powerSupply }}">{{ $powerSupply }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Отфильтровать</button>
        </form>
    </div>
    <div class="col-md-9 products-container">
        <div class="products">
            @foreach($products as $product)
                    <div class="card">
                        <div class="card-img-top">
                            <img src="{{ asset($product->product_image) }}">
                            <div class="card-body">
                                <h5 class="card-title">
                                    {{ Str::limit($product->title , 49) }}
                                    @if(strlen($product->title) > 190)
                                        <span>...</span>
                                    @endif
                                </h5>
                                <p class="card-text">{{ $product->price }} ₽</p>

                                <div class="action-buttons">
                                    <input type="button" class="pokazat" style="display: inline-block; margin-right: 6px;" onclick="showProductDetails({{ json_encode($product) }}, {{ json_encode(asset($product->product_image)) }})" />

                                    <form action="{{ route('cart.add', $product->product_id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        <button type="submit" class="Add-in-cart"></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            @endforeach
            <div class="paginate__menu">{{ $products->links() }}</div>
        </div>
    </div>

<script type="text/javascript">
function showProductDetails(product, productImage) {
    var detailsHtml = `
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

function closeWindow() {
    document.getElementById('myModal').style.display = "none";
}

function updateMinPrice() {
    const minPriceInput = document.getElementById('min-price');
    const minPriceLabel = document.getElementById('min-price-label');
    minPriceLabel.innerText = minPriceInput.value;

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

    const minPriceInput = document.getElementById('min-price');
    if (parseInt(maxPriceInput.value) < parseInt(minPriceInput.value)) {
        minPriceInput.value = maxPriceInput.value;
        document.getElementById('min-price-label').innerText = minPriceInput.value;
    }
}

function applyFilter() {
    const minPrice = document.getElementById('min-price').value;
    const maxPrice = document.getElementById('max-price').value;
}
</script>
@endsection