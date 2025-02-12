<?php

namespace App\Http\Controllers;

use App\Models\OrderItems;
use App\Models\Orders;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $cart = Session::get('product', []); // Ako nema podataka, vrati prazan niz

        if (empty($cart)) { // Provera da li je korpa prazna
            return view('cart', ['combinedItems' => [], 'emptyCart' => true]);
        }

        $combined = [];

        foreach ($cart as $item) {
            $product = Products::firstWhere('id', $item['product_id']);

            if ($product) {
                $combined[] = [
                    'name' => $product->name,
                    'amount' => $item['amount'],
                    'price' => $product->price,
                    'total' => $product->price * $item['amount'],
                ];
            }
        }

        return view('cart', ['combinedItems' => $combined, 'emptyCart' => false]);
    }


    public function add(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:products,id',
            'amount' => 'required|integer|min:1',
        ]);

        $product = Products::where('id', $request->id)->first();

        if ($product->quantity < $request->amount) {
            return redirect()->back();
        }

        // Dohvati trenutnu korpu
        $cart = Session::get('product', []);

        // Proveri da li proizvod već postoji u korpi
        $found = false;
        foreach ($cart as &$item) {
            if ($item['product_id'] == $request->id) {
                $item['amount'] += $request->amount;
                $found = true;
                break;
            }
        }

        // Ako proizvod nije pronađen, dodaj ga u korpu
        if (!$found) {
            $cart[] = [
                'product_id' => $request->id,
                'amount' => $request->amount,
            ];
        }

        // Sačuvaj ažuriranu korpu u sesiji
        Session::put('product', $cart);

        return redirect()->route('cart.all');
    }


    public function finish(Request $request)
    {
        $cart = Session::get('product');
        $totalPrice = 0;

        // Ako postoji nova količina u zahtevu
        if ($request->has('amounts')) {
            $amounts = json_decode($request->input('amounts'), true);

            foreach ($cart as $index => $item) {
                // Ažuriraj količinu na osnovu novih podataka
                $item['amount'] = $amounts[$index] ?? $item['amount'];
                $cart[$index] = $item;
            }

            // Ažuriraj korpu u sesiji
            Session::put('product', $cart);
        }

        foreach ($cart as $item) {
            $product = Products::firstWhere(['id' => $item['product_id']]);

            // Ako količina prelazi raspoloživu količinu, preusmeri korisnika
            if ($item['amount'] > $product->quantity) {
                return redirect()->back();
            }

            $totalPrice += $product->price * $item['amount'];
        }

        // Kreiraj narudžbinu
        $order = Orders::create([
            'user_id' => Auth::id(),
            'price' => $totalPrice,
        ]);

        foreach ($cart as $item) {
            $product = Products::firstWhere(['id' => $item['product_id']]);
            $product->quantity -= $item['amount'];
            $product->save();

            // Spremi proizvode u OrderItems tabelu
            OrderItems::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'amount' => $item['amount'],
                'price' => $product->price * $item['amount'],
            ]);
        }

        // Očisti korpu iz sesije
        Session::forget('product');

        // Prebaci korisnika na stranicu sa zahvalnicom
        return view('thankYou');
    }



}
