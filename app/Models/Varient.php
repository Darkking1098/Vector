<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Varient
 * 
 * @property int $id
 * @property int $component_id
 * @property int|null $owner_id
 * @property string|null $varient_title
 * @property string|null $varient_desc
 * @property string|null $varient_html
 * @property string|null $varient_css
 * @property string|null $varient_js
 * @property string|null $varient_react
 * @property string|null $varient_next
 * @property string|null $varient_php
 * @property string|null $varient_laravel
 * @property string|null $varient_angular
 * @property string|null $varient_django
 * 
 * @property Component $component
 *
 * @package App\Models
 */
class Varient extends Model
{
	protected $table = 'varients';
	public $timestamps = false;

	protected $casts = [
		'component_id' => 'int',
		'owner_id' => 'int'
	];

	protected $fillable = [
		'component_id',
		'owner_id',
		'varient_title',
		'varient_desc',
		'varient_html',
		'varient_css',
		'varient_js',
		'varient_react',
		'varient_next',
		'varient_php',
		'varient_laravel',
		'varient_angular',
		'varient_django'
	];

	public function component()
	{
		return $this->belongsTo(Component::class);
	}
}
