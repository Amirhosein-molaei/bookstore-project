<?php

namespace App\Http\Controllers\Home;


use App\Models\User\User;
use Illuminate\Http\Request;
use App\Models\User\Favorite;
use App\Models\Market\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
	public function addProduct(Product $product)
	{
		$user = Auth::user();
		if ($user) {
			$favoritBook = Favorite::where("user_id", $user->id)->where("favoriteable_type", Product::class)->where("favoriteable_id", $product->id)->first();
			if ($favoritBook) {
				$favoritBook->delete();
				return redirect()->back()->with('error', 'کتاب از لیست علاقه مندی ها حذف شد');
			} else {
				Favorite::restoreOrCreate([
					"user_id" => $user->id,
					"favoriteable_type" => Product::class,
					"favoriteable_id" => $product->id
				], [
					"user_id" => $user->id,
					"favoriteable_type" => Product::class,
					"favoriteable_id" => $product->id
				]);
				return redirect()->back()->with('success', 'کتاب به لیست علاقه مندی ها اضافه شد');
			}
		}
	}

	public function removeFavoriteProduct(Product $product)
	{
		$user = User::find(Auth::id());
		$user->favoriteProducts()->detach($product->id);
		
		return redirect()->back()->with('success', 'محصول مورد نظر از لیست علاقمندی ها حذف شد.');
	}
	
	public function removeAllFavoriteProducts()
	{
		$user = User::find(Auth::id());
		$user->favoriteProducts()->detach();

		return redirect()->back()->with('success', 'لیست علاقمندی ها خالی شد.');
	}
}
