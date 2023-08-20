<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    /* Todo内容確認 */
    protected $fillable = [
        'category_id',
        'content'
    ];
    public function category()
    {
        /* belongsToは、外部キーで関連付けられているテーブルのレコードを取り出すメソッド */
        return $this->belongsTo(Category::class);
    }
    /* 検索機能 */
    public function scopeCategorySearch($query, $category_id)
    {
        if (!empty($category_id)) {
            $query->where('category_id', $category_id);
        }
    }

    public function scopeKeywordSearch($query, $keyword)
    {
        if (!empty($keyword)) {
            $query->where('content', 'like', '%' . $keyword . '%');
        }
    }

}
