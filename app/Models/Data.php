<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'ship_to_name', 'customer_email', 'status'];

    public static function updateOrCreate(array $attributes, array $values = [])
    {
        // Пошук запису за атрибутами
        $instance = static::where($attributes)->first();

        // Якщо запис існує, оновити його значення
        if ($instance) {
            $instance->update($values);
            return $instance;
        }

        // Якщо запис не існує, створити новий
        return static::create(array_merge($attributes, $values));
    }

}
