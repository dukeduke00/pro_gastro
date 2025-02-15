@extends('layout')

@section('page_name')
    Cart
@endsection

@section('content')

    @if(isset($emptyCart) && $emptyCart)
        <p class="text-center">Your cart is empty.</p>
    @else
        <div class="container-fluid p-5">
            <form id="cart-form">
                @csrf
                <table class="table table-striped table-bordered text-center">
                    <thead>
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Total</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($combinedItems as $index => $item)
                        <tr>
                            <td style="width: 120px;">
                                @if($item['image'])
                                    <img src="{{ asset('storage/' . $item['image']) }}"
                                         alt="product_image"
                                         class="img-fluid"
                                         style="height: 100px; width: 100px; object-fit: cover;">
                                @endif
                            </td>
                            <td>{{ $item['name'] }}</td>
                            <td><span class="price" data-index="{{ $index }}">{{ number_format($item['price'], 2) }}</span> &euro;</td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center">
                                    <button type="button" class="decrease btn btn-sm btn-outline-primary" data-index="{{ $index }}">-</button>
                                    <input type="number" name="group[{{ $index }}][amount]"
                                           value="{{ $item['amount'] }}"
                                           min="1"
                                           class="form-control amount mx-2 text-center"
                                           data-index="{{ $index }}"
                                           style="width: 60px;"
                                           step="1">
                                    <button type="button" class="increase btn btn-sm btn-outline-primary" data-index="{{ $index }}">+</button>
                                </div>
                            </td>
                            <td><span class="total" data-index="{{ $index }}">{{ number_format($item['total'], 2) }}</span> &euro;</td>
                            <td>
                                <button type="button" class="delete btn btn-sm btn-danger" data-index="{{ $index }}">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="mt-4 text-center">
                    <h4>Total Price: <span id="total-cart-price">{{ number_format($totalCartPrice, 2) }}</span> &euro;</h4>
                    <a href="{{ route('cart.finish') }}" class="btn btn-lg btn-success mt-2 px-4">Order now</a>
                </div>
            </form>
        </div>
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
