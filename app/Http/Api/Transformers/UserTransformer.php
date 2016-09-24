<?php
/**
 * Created by PhpStorm.
 * User: sheikhu
 * Date: 02/05/16
 * Time: 21:55
 */

namespace App\Http\Api\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        return [
            'id'    =>  (int) $user->id,
            'email' => $user->email,
            'name' => $user->name
        ];
    }
}