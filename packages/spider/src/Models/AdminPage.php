<?php

/**
 * Created by Reliese Model.
 */

namespace Vector\Spider\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AdminPage
 * 
 * @property int $id
 * @property int $page_group_id
 * @property string $page_title
 * @property string $page_url
 * @property int $page_can_display
 * @property int $page_status
 * 
 * @property AdminPageGroup $admin_page_group
 *
 * @package Vector\Spider\Models
 */
class AdminPage extends Model
{
	protected $table = 'admin_pages';
	public $timestamps = false;

	protected $casts = [
		'page_group_id' => 'int',
		'page_can_display' => 'int',
		'page_status' => 'int'
	];

	protected $fillable = [
		'page_group_id',
		'page_title',
		'page_url',
		'page_can_display',
		'page_status'
	];

	public function admin_page_group()
	{
		return $this->belongsTo(AdminPageGroup::class, 'page_group_id');
	}
}
