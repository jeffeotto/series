<?php
namespace App;

use App\Temporada;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Serie extends Model
{
    public $timestamps = false;
    protected $fillable = ['nome','thumbnail'];


    public function getThumbnailUrlAttribute()
    {
        if ($this->thumbnail) {
            return Storage::url($this->thumbnail);
        }
       return Storage::url('serie/no-thumb.jpg');
    }
    
    public function temporadas()
    {
        return $this->hasMany(Temporada::class);
    }
}