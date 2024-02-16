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
 * @property int $slud_id
 * @property string $component_title
 * @property string $component_desc
 * @property string|null $component_html
 * @property string|null $component_css
 * @property string|null $component_js
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
		'slud_id' => 'int'
	];

	protected $fillable = [
		'slud_id',
		'component_title',
		'component_desc',
		'component_html',
		'component_css',
		'component_js'
	];

	public function web_page()
	{
		return $this->belongsTo(WebPage::class, 'slud_id');
	}

	public function varients()
	{
		return $this->hasMany(Varient::class);
	}
}
