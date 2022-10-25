<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;

class Page extends Model
{
    use HasFactory;

    protected $fillable = ['title','slug','parent_id','content'];

    protected $appends = ['page_slug'];

    public function setTitleAttribute($title)
    {
        $this->attributes['title'] = $title;
        $this->attributes['slug'] = Helper::pageSlug($title);
    }

    public function scopeDefaultPage($query)
    {
        return $query->where('parent_id',0);
    }


    public function scopeNotDefaultPage($query)
    {
        return $query->where('parent_id','!=',0);
    }



    public function pages()
    {
        return $this->hasMany(Page::class, 'parent_id');
    }

    public function parent(){
        return $this->belongsTo(Page::class,'parent_id');
    }

    public function getPageSlugAttribute(){
        return Helper::fullslug($this->parent_id,$this->slug);
    }

}
