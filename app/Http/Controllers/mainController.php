<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use App\Models\Book;
use App\Models\Customer;
use App\Models\Order;



function getResponse($data, $code) {
    if ($code == 200) {
        $response = [
            'data' => [
                'status' => 'success',
                $data[0] => $data[1]
            ]
        ];
    } else {
        $response = [
            'error' => [
                'code' => $code,
                $data[0] => $data[1]
            ]
        ];
    }

    return response() -> json($response, $code, ['Content-Type' => 'application/json'], JSON_UNESCAPED_UNICODE);
}


class mainController extends Controller
{

    // login & logout

    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|exists:Customers',
            'password' => 'required|string'
        ]);

        if ($validator -> fails()) return getResponse(['errors', $validator -> errors()], 400);

        $checkPassword = count(Customer::where($request -> all()) -> get());

        if (!$checkPassword) return getResponse(['message', 'invalid login or password'], 401);

        
        $token = Str::random(38);
        
        $user = Customer::where($request -> all()) -> first();
        $user -> bearerToken = $token;
        $user -> save();

        return getResponse(['bearer_token', $token], 200);
    }

    public function logout(Request $request) {
        $user = Customer::where('bearerToken', $request -> bearerToken()) -> first();
        $user -> bearerToken = null;
        $user -> save();

        return getResponse(['message', 'Successfully logout'], 200);
    }


    // books

    public function getBooks() {
        return getResponse(['data', Book::all()], 200);
    }

    public function createBook(Request $request) {
        $validator = Validator::make($request -> all(), [
            'title' => 'required|string',
            'author' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|integer',
            'in_stock' => 'required|integer'
        ]);

        if ($validator -> fails()) return getResponse(['errors', $validator -> errors()], 400);

        $newBook = Book::create($request -> all());

        return getResponse(['data', $newBook], 200);
    }

    public function getBookInfo($bookID) {
        $book = Book::where('id', $bookID) -> first();
        
        if (!$book) return getResponse(['message', 'invalid book id'], 400);

        return getResponse(['data', $book], 200);
    }

    public function updateBookInfo(Request $request, $bookID) {
        $validate = [
            'title' => 'string',
            'author' => 'string',
            'description' => 'string',
            'price' => 'integer',
            'in_stock' => 'integer'
        ];

        if (!count($request -> all()) || !count(array_intersect_key($request -> all(), $validate))) return getResponse(['message', 'There is no changes'], 400);

        $validator = Validator::make($request -> all(), $validate);

        if ($validator -> fails()) return getResponse(['errors', $validator -> errors()], 400);

        $book = Book::where('id', $bookID) -> first();

        if (!$book) return getResponse(['message', 'invalid book id'], 400);

        $book -> fill($request -> all());
        $book -> save();

        return getResponse(['data', $book], 200);
    }

    public function deleteBook($bookID) {
        $book = Book::where('id', $bookID) -> first();
        
        if (!$book) return getResponse(['message', 'invalid book id'], 400);

        $book -> delete();

        return getResponse(['message', 'Book deleted successfully'], 200);
    }


    // customers

    public function getCustomers() {
        return getResponse(['data', Customer::all()], 200);
    }

    public function createCustomer(Request $request) {
        if (array_key_exists('bearerToken', $request -> all())) {
            return getResponse(['message', 'bearerToken is not fillable'], 400);
        }

        $validator = Validator::make($request -> all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string',
            'phone' => 'required|string'
        ]);

        if ($validator -> fails()) return getResponse(['errors', $validator -> errors()], 400);

        $newCustomer = Customer::create($request -> all());

        return getResponse(['data', $newCustomer], 200);
    }

    public function getCustomerInfo($customerID) {
        $customer = Customer::where('id', $customerID) -> first();
        
        if (!$customer) return getResponse(['message', 'invalid customer id'], 400);

        return getResponse(['data', $customer], 200);
    }

    public function updateCustomerInfo(Request $request, $customerID) {
        $validate = [
            'first_name' => 'string',
            'last_name' => 'string',
            'email' => 'string',
            'password' => 'string',
            'phone' => 'string'
        ];

        if (!count($request -> all()) || !count(array_intersect_key($request -> all(), $validate))) return getResponse(['message', 'There is no changes'], 400);

        $validator = Validator::make($request -> all(), $validate);

        if ($validator -> fails()) return getResponse(['errors', $validator -> errors()], 400);

        $customer = Customer::where('id', $customerID) -> first();

        if (!$customer) return getResponse(['message', 'invalid customer id'], 400);

        $customer -> fill($request -> all());
        $customer -> save();

        return getResponse(['data', $customer], 200);
    }

    public function deleteCustomer($customerID) {
        $customer = Customer::where('id', $customerID) -> first();
        
        if (!$customer) return getResponse(['message', 'invalid customer id'], 400);

        $customer -> delete();

        return getResponse(['message', 'Customer deleted successfully'], 200);
    }


    // orders

    public function getOrders() {
        return getResponse(['data', Order::all()], 200);
    }

    public function createOrder(Request $request) {
        $validator = Validator::make($request -> all(), [
            'customer_id' => 'required|integer|exists:Customers,id',
            'book_id' => 'required|integer|exists:Books,id',
            'quantity' => 'required|integer',
            'status' => 'required|string'
        ]);

        if (!$validator -> fails()) {
            $available = Book::where('id', $request -> book_id) -> first() -> in_stock;

            if ($request -> quantity > $available) {
                return getResponse(['errors', ['quantity' => 'Requested more than is available']], 400);
            }
        }

        if ($validator -> fails()) return getResponse(['errors', $validator -> errors()], 400);

        $newOrder = Order::create($request -> all());

        return getResponse(['data', $newOrder], 200);
    }

    public function getOrderInfo($orderID) {
        $order = Order::where('id', $orderID) -> first();
        
        if (!$order) return getResponse(['message', 'invalid order id'], 400);

        return getResponse(['data', $order], 200);
    }

    public function updateOrderInfo(Request $request, $orderID) {
        $order = Order::where('id', $orderID) -> first();

        if (!$order) return getResponse(['message', 'invalid order id'], 400);

        $validate = [
            'customer_id' => 'integer|exists:Customers,id',
            'book_id' => 'integer|exists:Books,id',
            'quantity' => 'integer',
            'status' => 'string'
        ];

        if (!count($request -> all()) || !count(array_intersect_key($request -> all(), $validate))) return getResponse(['message', 'There is no changes'], 400);

        $validator = Validator::make($request -> all(), $validate);

        if (!$validator -> fails() && array_key_exists('quantity', $request -> all())) {
            $bookID = array_key_exists('book_id', $request -> all()) ? $request -> book_id : $order -> book_id;
            $available = Book::where('id', $bookID) -> first() -> in_stock;

            if ($request -> quantity > $available) {
                return getResponse(['errors', ['quantity' => 'Requested more than is available']], 400);
            }
        }

        if ($validator -> fails()) return getResponse(['errors', $validator -> errors()], 400);

        $order -> fill($request -> all());
        $order -> save();

        return getResponse(['data', $order], 200);
    }

    public function deleteOrder($orderID) {
        $order = Order::where('id', $orderID) -> first();
        
        if (!$order) return getResponse(['message', 'invalid order id'], 400);

        $order -> delete();

        return getResponse(['message', 'Order deleted successfully'], 200);
    }
}
