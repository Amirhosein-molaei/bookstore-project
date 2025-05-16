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
				return redirect()->back()->with('success', 'کتاب به لیست علاقه مندی ها اضافه شد');
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
				return redirect()->back()->with('success', 'نویسنده از لیست علاقمندی ها حذف شد');

			} else {

				Favorite::restoreOrCreate([
					"user_id" => $user->id,
					"favoriteable_type" => Writer::class,
					"favoriteable_id" => $writerId
				]);
				return redirect()->back()->with('success', 'نویسنده به لیست علاقمندی ها اضافه شد');
			}
		}

		return back()->with('error', 'احراز هویت انجام نشده است. لطفا ابتدا وارد شوید');
	}

	public function destroyFavoritWriter(Writer $writer)
	{
		$user = Auth::user();
		$favorite = Favorite::where('user_id', $user->id)->where("favoriteable_type", Writer::class)
			->where("favoriteable_id", $writer->id)->first();

		$favorite->delete();
		

		return redirect()->back()->with('success', 'نویسنده از لیست علاقمندی های شما حذف شد!');
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

		return redirect()->back()->with('success', 'کتاب مورد نظر از لیست علاقمندی ها حذف شد.');
	}

	public function removeAllFavoriteProducts()
	{
		$user = User::find(Auth::id());
		$user->favoriteProducts()->detach();

		return redirect()->back()->with('success', 'لیست علاقمندی ها خالی شد.');
	}
}
