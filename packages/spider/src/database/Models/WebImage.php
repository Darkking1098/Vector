<?php

/**
 * Created by Reliese Model.
 */

namespace Vector\Spider\database\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class WebImage
 * 
 * @property int $id
 * @property string $image_slug
 * @property string $image_title
 * @property string $image_alt
 * @property string $image_caption
 * @property string $image_srcset
 *
 * @package database\Models
 */
class WebImage extends Model
{
	protected $table = 'web_images';
	public $timestamps = false;

	protected $fillable = [
		'image_slug',
		'image_title',
		'image_alt',
		'image_caption',
		'image_srcset'
	];
}
