<?php

/**
 * Created by Reliese Model.
 */

namespace Vector\Spider\database\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Employee
 * 
 * @property int $id
 * @property int|null $admin_role_id
 * @property int|null $team_id
 * @property string $emp_username
 * @property string $emp_name
 * @property string $emp_desc
 * @property string $emp_profile_img
 * @property string $emp_banner_img
 * @property string $emp_password
 * @property int $can_join_teams
 * @property int $emp_status
 * 
 * @property AdminRole|null $admin_role
 * @property EmployeeTeam|null $employee_team
 * @property Collection|Blog[] $blogs
 * @property Collection|EmployeeTeam[] $employee_teams
 *
 * @package database\Models
 */
class Employee extends Model
{
	protected $table = 'employees';
	public $timestamps = false;

	protected $casts = [
		'admin_role_id' => 'int',
		'team_id' => 'int',
		'can_join_teams' => 'int',
		'emp_status' => 'int'
	];

	protected $hidden = [
		'emp_password'
	];

	protected $fillable = [
		'admin_role_id',
		'team_id',
		'emp_username',
		'emp_name',
		'emp_desc',
		'emp_profile_img',
		'emp_banner_img',
		'emp_password',
		'can_join_teams',
		'emp_status'
	];

	public function admin_role()
	{
		return $this->belongsTo(AdminRole::class);
	}

	public function employee_team()
	{
		return $this->belongsTo(EmployeeTeam::class, 'team_id');
	}

	public function blogs()
	{
		return $this->hasMany(Blog::class, 'writer_id');
	}

	public function employee_teams()
	{
		return $this->hasMany(EmployeeTeam::class, 'team_leader');
	}
}
