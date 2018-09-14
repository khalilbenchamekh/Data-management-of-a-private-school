<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UmdComment
 */
class UmdComment extends Model
{
    protected $table = 'umd_comments';

	protected $primaryKey = 'ID';

    public $timestamps = false;

    protected $fillable = [
        'comment_ID',
        'comment_post_ID',
        'comment_author',
        'comment_author_email',
        'comment_date',
        'comment_content',
        'comment_approved'
    ];

    protected $guarded = [];

	public function UmdPost(){
		return $this->belongsTo('App\Models\UmdPost', 'comment_post_ID', 'ID');
	}
}
