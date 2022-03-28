<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'photos';

    protected $fillable = ['image','title', 'user_id'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
	
}
