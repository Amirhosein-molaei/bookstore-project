<?php

namespace App\Models\Content;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory, SoftDeletes , Sluggable;

  protected $table ='tags';
  protected $guarded =[];

  public function sluggable(): array
  {
      return [
          'slug' => [
              'source' => 'name',
              'onUpdate' => true,
              'unique' => true,
              'separator' => '-',
          ]
      ];
  }
    public function getStatusAttribute($status)
    {
        return $status ? 'فعال' : 'غیرفعال' ;
    }
}
