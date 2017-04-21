<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/21/2017
 * Time: 5:52 PM
 */

namespace App\Http\Requests;


interface SanitizePostRequestInterface
{
    public function sanitize();
}