<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Event extends Model
{
    protected $fillable = [
        'name', 'description', 'address', 'image', 'ticket_price', 'ticket_remaining','published_at','date', 'slug'
    ];

    protected $casts = ['date' => 'datetime'];

    public static function boot()
    {
        parent::boot();
        static::creating(function($event){
            $event->slug = Str::slug($event->name);
        });
    }
    public function attachImage($image)
    {
        $filename = $image->store('public');
        $this->update(['image' => $filename]);
    }

    public function getDateAttribute($date)
    {
        return Carbon::parse($date)->format('d-M, Y');
    }
    
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function uploadImage($image)
    {
        
       
        $filename = $image->store('public');
        $this->update(['image' => $filename]);
     
    }
    public function deleteImage($imageName)
    {
        Storage::disk('public')->delete($imageName);
    }

    public  function edit($request)
    {
      
        $this->update($request->except('image'));
        if ($request->has('image')) {
           $this->deleteImage($this->image);
            $this->uploadImage($request->image);
        }
       
        
  
       
    }
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
    
    public function payments()
    {
        return $this->morphMany(Payment::class, 'product');
    }
}
