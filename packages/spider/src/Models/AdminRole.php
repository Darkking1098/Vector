<?php

/**
 * Created by Reliese Model.
 */

namespace Vector\Spider\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AdminRole
 * 
 * @property int $id
 * @property string $role_title
 * @property string|null $role_desc
 * @property string|null $role_image
 * @property string|null $role_permissions
 * @property int|null $role_sensitive
 * @property int $role_status
 * 
 * @property Collection|Employee[] $employees
 *
 * @package Vector\Spider\Models
 */
class AdminRole extends Model
{
	protected $table = 'admin_roles';
	public $timestamps = false;

	protected $casts = [
		'role_sensitive' => 'int',
		'role_status' => 'int'
	];

	protected $fillable = [
		'role_title',
		'role_desc',
		'role_image',
		'role_permissions',
		'role_sensitive',
		'role_status'
	];

	public function employees()
	{
		return $this->hasMany(Employee::class);
	}
}
