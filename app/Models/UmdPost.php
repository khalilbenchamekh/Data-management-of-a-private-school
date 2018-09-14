<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UmdPost
 */
class UmdPost extends Model
{
    protected $table = 'umd_posts';

	protected $primaryKey = 'ID';

    public $timestamps = false;

    protected $fillable = [
        'post_content',
        'post_title',
        'post_status',
		'post_attachment'
    ];

    protected $guarded = [];

	public function User(){
		return $this->belongsTo('App\User', 'post_author');
	}

	public function UmdTermRelationship(){
		return $this->belongsTo('App\Models\UmdTermRelationship', 'ID', 'object_id');
	}

	public function UmdComments(){
		return $this->hasMany('App\Models\UmdComment', 'comment_post_ID');
	}

	public function UmdTermTaxonomy(){
		return $this->belongsToMany('App\Models\UmdTermTaxonomy', 'umd_term_relationships', 'object_id', 'term_taxonomy_id');
	}

	public function UmdSelectedVideo(){
		
	}


}
