<?php

namespace App\Http\Controllers\Home;


use App\Models\User\User;
use Illuminate\Http\Request;
use App\Models\User\Favorite;
use App\Models\Market\Product;
use App\Http\Controllers\Controller;
use App\Models\Content\Writer;
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
				return redirect()->back()->with('swal-success', 'کتاب از لیست علاقه مندی ها حذف شد');
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
				return redirect()->back()->with('swal-success', 'کتاب به لیست علاقه مندی ها اضافه شد');
			}
		}
	}
	public function addWriter($writerId)
	{
		$user = Auth::user();

		if ($user) {
			$favoritWriter = Favorite::where("user_id", $user->id)
				->where("favoriteable_type", Writer::class)
				->where("favoriteable_id", $writerId)
				->first();

			if ($favoritWriter) {
				$favoritWriter->delete();
				return response()->json(['status' => 'removed', 'message' => 'نویسنده از لیست علاقه‌مندی‌ها حذف شد']);
			} else {
				Favorite::restoreOrCreate([
					"user_id" => $user->id,
					"favoriteable_type" => Writer::class,
					"favoriteable_id" => $writerId
				]);
				return response()->json(['status' => 'added', 'message' => 'نویسنده به لیست علاقه‌مندی‌ها اضافه شد']);
			}
		}

		return response()->json(['status' => 'unauthorized', 'message' => 'کاربر احراز هویت نشده است'], 401);
	}

	public function destroyFavoritWriter(Writer $writer)
	{
		$user = Auth::user();
		$favorit = Favorite::where('user_id', $user->id)->where("favoriteable_type", Writer::class)
			->where("favoriteable_id", $writer->id)->first();

		$favorit->delete();

		return redirect()->back()->with('swal-success', 'نویسنده با موفقیت حذف شد!');
	}
	public function destroyAllFavoritWriter(Request $request)
	{
		$user = Auth::user();
		$favorites = Favorite::where('user_id', $user->id)->where("favoriteable_type", Writer::class)
			->get();
		foreach ($favorites as $favorite) {
			$favorite->delete();
		}

		return redirect()->back()->with('swal-success', 'نویسنده ها با موفقیت حذف شدند!');
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
