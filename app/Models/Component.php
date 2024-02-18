<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Component
 * 
 * @property int $id
 * @property int $slug_id
 * @property string $component_title
 * @property string $component_desc
 * @property string|null $component_html
 * @property string|null $component_css
 * @property string|null $component_js
 * @property string $component_class
 * 
 * @property WebPage $web_page
 * @property Collection|Varient[] $varients
 *
 * @package App\Models
 */
class Component extends Model
{
	protected $table = 'components';
	public $timestamps = false;

	protected $casts = [
		'slug_id' => 'int'
	];

	protected $fillable = [
		'slug_id',
		'component_title',
		'component_desc',
		'component_html',
		'component_css',
		'component_js',
		'component_class'
	];

	public function web_page()
	{
		return $this->belongsTo(WebPage::class, 'slug_id');
	}

	public function varients()
	{
		return $this->hasMany(Varient::class);
	}
}
