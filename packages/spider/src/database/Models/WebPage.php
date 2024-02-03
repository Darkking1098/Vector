<?php

/**
 * Created by Reliese Model.
 */

namespace Vector\Spider\database\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class WebPage
 * 
 * @property int $id
 * @property string $webpage_slug
 * @property string $webpage_title
 * @property string $webpage_desc
 * @property string $webpage_keywords
 * @property string $webpage_canonical
 * @property string $webpage_other_meta
 * @property int|null $load_count
 * 
 * @property Collection|Blog[] $blogs
 *
 * @package database\Models
 */
class WebPage extends Model
{
	protected $table = 'web_pages';
	public $timestamps = false;

	protected $casts = [
		'load_count' => 'int'
	];

	protected $fillable = [
		'webpage_slug',
		'webpage_title',
		'webpage_desc',
		'webpage_keywords',
		'webpage_canonical',
		'webpage_other_meta',
		'load_count'
	];

	public function blogs()
	{
		return $this->hasMany(Blog::class, 'webpage_id');
	}
}
