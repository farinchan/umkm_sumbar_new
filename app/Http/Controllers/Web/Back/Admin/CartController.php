<?php

namespace App\Http\Controllers\Web\Back\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->q;
        $data = [
            'menu_title' => 'Manajemen',
            'title' => 'Keranjang Pengguna',
            'list_cart' => User::with('userCart')
                ->where('name', 'like', "%$q%")
                ->whereHas('userCart', function ($query) {
                    $query->whereNotNull('id');
                })
                ->paginate(10),
        ];

        // dd($data);
        return view('back.cart.index', $data);
    }
}
