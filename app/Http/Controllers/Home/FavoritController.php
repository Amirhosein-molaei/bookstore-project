<?php

namespace App\Http\Controllers\Home;


use Illuminate\Http\Request;
use App\Models\User\Favorite;
use App\Models\Market\Product;
use App\Http\Controllers\Controller;

class FavoritController extends Controller
{
   public function addProduct(Product $product)
   {
      $user = auth()->user();
      if ($user) {
         $favoritBook = Favorite::where("user_id", $user->id)->where("favoriteable_type", Product::class)->where("favoriteable_id", $product->id)->first();
         if ($favoritBook) {
            $favoritBook->delete();
            return redirect()->back()->with('swal-error', '     کتاب از لیست علاقه مندی ها حذف شد');
         } else {
            Favorite::create([
               "user_id" => $user->id,
               "favoriteable_type" => Product::class,
               "favoriteable_id" => $product->id
            ]);
            return redirect()->back()->with('swal-success', '     کتاب با موفقیت به لیست علاقه مندی ها اضافه شد');

         }
      }
   }
 
}
