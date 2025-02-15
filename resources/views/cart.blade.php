@vite(['resources/css/cart.css'])

@extends('layout')

@section('page_name')
    Cart
@endsection

@section('content')

    @if(isset($emptyCart) && $emptyCart)
        <p class="cart_empty">Your cart is empty.</p>
    @else

            <form>
                @csrf
                <div class="cart_main">
                    @foreach($combinedItems as $index => $item)
                        <div class="cart_body">

                            <div class="cart_delete">
                                <a class="delete" data-index="{{ $index }}"><i class='bx bx-x'></i></a>
                            </div>

                            <div class="cart_image">
                                @if($item['image'])
                                    <img src="{{ asset('storage/' . $item['image']) }}"
                                         alt="product_image"
                                         style="height: 100px; width: 100px; object-fit: cover;">
                                @endif
                            </div>


                            <div class="cart_name">
                                <p class="cart_name">{{ $item['name'] }}</p>
                            </div>

                            <div class="cart_price">
                                <p><span class="price" data-index="{{ $index }}">{{ number_format($item['price'], 2) }}</span>&euro;</p>
                            </div>

                            <div class="cart_amount">
                                <button type="button" class="decrease" data-index="{{ $index }}">-</button>
                                <input type="number" name="group[{{ $index }}][amount]"
                                           value="{{ $item['amount'] }}"
                                           min="1"
                                           class="amount"
                                           data-index="{{ $index }}"
                                           step="1">
                                <button type="button" class="increase" data-index="{{ $index }}">+</button>
                            </div>

                            <div class="cart_total">
                                <p><span class="total" data-index="{{ $index }}">{{ number_format($item['total'], 2) }}</span>&euro;</p>
                            </div>

                        </div>
                    @endforeach
                </div>

                <div class="cart_order">
                    <h4>Total Price: <span id="total-cart-price">{{ number_format($totalCartPrice, 2) }}</span> &euro;</h4>
                    <a href="{{ route('cart.finish') }}" >Order now</a>
                </div>
            </form>

    @endif


    <script>
        document.addEventListener("DOMContentLoaded", function () {
            function updateTotalCartPrice() {
                let totalPrice = 0;
                document.querySelectorAll(".total").forEach(element => {
                    totalPrice += parseFloat(element.textContent);
                });
                document.getElementById("total-cart-price").textContent = totalPrice.toFixed(2);
            }

            document.querySelectorAll(".increase, .decrease").forEach(button => {
                button.addEventListener("click", function () {
                    let index = this.getAttribute("data-index");
                    let input = document.querySelector(`.amount[data-index='${index}']`);
                    let price = parseFloat(document.querySelector(`.price[data-index='${index}']`).textContent);
                    let total = document.querySelector(`.total[data-index='${index}']`);

                    let amount = parseInt(input.value);
                    if (this.classList.contains("increase")) {
                        amount++;
                    } else if (this.classList.contains("decrease") && amount > 1) {
                        amount--;
                    }

                    input.value = amount;
                    total.textContent = (amount * price).toFixed(2);

                    updateCart(index, amount, total);
                    updateTotalCartPrice();
                });
            });

            document.querySelectorAll(".amount").forEach(input => {
                input.addEventListener("keypress", function (event) {
                    if (event.key === "Enter") {
                        event.preventDefault();
                        let index = this.getAttribute("data-index");
                        let amount = parseInt(this.value);
                        let price = parseFloat(document.querySelector(`.price[data-index='${index}']`).textContent);
                        let total = document.querySelector(`.total[data-index='${index}']`);

                        total.textContent = (amount * price).toFixed(2);
                        updateCart(index, amount, total);
                        updateTotalCartPrice();
                    }
                });
            });

            function updateCart(index, amount, totalElement) {
                fetch("{{ route('cart.update.quantity') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify({ index: index, amount: amount })
                }).then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            totalElement.textContent = (amount * parseFloat(document.querySelector(`.price[data-index='${index}']`).textContent)).toFixed(2);
                            updateTotalCartPrice();
                        }
                    });
            }

            document.querySelectorAll(".delete").forEach(button => {
                button.addEventListener("click", function () {
                    let index = this.getAttribute("data-index");

                    fetch("{{ route('cart.remove') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                        },
                        body: JSON.stringify({ index: index })
                    }).then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                location.reload();
                            }
                        });
                });
            });
        });
    </script>

@endsection
