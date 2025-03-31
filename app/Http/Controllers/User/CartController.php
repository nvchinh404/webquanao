<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Lấy giỏ hàng (cho cả session và database)
    protected function getCart()
{
    if (Auth::check()) {
        return DB::table('carts') // Đổi thành tên bảng giỏ hàng của bạn
            ->where('user_id', Auth::id())
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->select('carts.*', 'products.*')
            ->get();
    }

    return collect(session('cart', []))->map(function ($item) {
        return (object) [
            'product_id' => $item['product_id'],
            'quantity' => $item['quantity'],
            'product' => DB::table('products')->where('id', $item['product_id'])->first()
        ];
    });
}

    // Hiển thị giỏ hàng
    public function index()
    {
        $cartItems = $this->getCart();
        
        $total = $cartItems->sum(function($item) {
            return $item->product->price * $item->quantity;
        });

        return view('user.cart.index', compact('cartItems', 'total'));
    }

    // Thêm sản phẩm vào giỏ hàng (cập nhật)
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'sometimes|integer|min:1'
        ]);

        $quantity = $request->quantity ?? 1;

        // Kiểm tra tồn kho
        if (!$this->checkStock($product, $quantity)) {
            return back()->with('error', 'Sản phẩm không đủ số lượng tồn kho');
        }

        if (Auth::check()) {
            $this->addToDatabaseCart($product->id, $quantity);
        } else {
            $this->addToSessionCart($product->id, $quantity);
        }

        return redirect()->route('user.cart.index')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng');
    }

    // Cập nhật số lượng (cập nhật)
    public function update(Request $request, $cartId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        if (Auth::check()) {
            $cartItem = Cart::findOrFail($cartId);
            if (!$this->checkStock($cartItem->product, $request->quantity)) {
                return back()->with('error', 'Sản phẩm không đủ số lượng tồn kho');
            }
            $cartItem->update(['quantity' => $request->quantity]);
        } else {
            $cart = session('cart', []);
            if (isset($cart[$cartId])) {
                $product = Product::find($cart[$cartId]['product_id']);
                if (!$this->checkStock($product, $request->quantity)) {
                    return back()->with('error', 'Sản phẩm không đủ số lượng tồn kho');
                }
                $cart[$cartId]['quantity'] = $request->quantity;
                session(['cart' => $cart]);
            }
        }

        return redirect()->back()->with('success', 'Giỏ hàng đã được cập nhật');
    }

    // Xóa sản phẩm (cập nhật)
    public function destroy($cartId)
    {
        if (Auth::check()) {
            Cart::destroy($cartId);
        } else {
            $cart = session('cart', []);
            unset($cart[$cartId]);
            session(['cart' => $cart]);
        }

        return redirect()->back()->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng');
    }

    // Helper: Thêm vào giỏ hàng database
    protected function addToDatabaseCart($productId, $quantity)
    {
        $cartItem = Cart::where([
            'user_id' => Auth::id(),
            'product_id' => $productId
        ])->first();

        if ($cartItem) {
            $cartItem->increment('quantity', $quantity);
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $productId,
                'quantity' => $quantity
            ]);
        }
    }

    // Helper: Thêm vào giỏ hàng session
    protected function addToSessionCart($productId, $quantity)
    {
        $cart = session('cart', []);
        $found = false;

        foreach ($cart as &$item) {
            if ($item['product_id'] == $productId) {
                $item['quantity'] += $quantity;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $cart[] = [
                'product_id' => $productId,
                'quantity' => $quantity,
                'id' => uniqid() // Tạo ID duy nhất cho session
            ];
        }

        session(['cart' => $cart]);
    }

    // Helper: Kiểm tra tồn kho
    protected function checkStock($product, $quantity)
    {
        if ($product->stock_quantity < $quantity) {
            return false;
        }
        return true;
    }
}