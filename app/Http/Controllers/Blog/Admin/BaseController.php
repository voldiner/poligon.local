<?php

namespace App\Http\Controllers\Blog\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Blog\BaseController as GuestBaseController;
/**
 *  базовый контроллер для всех контроллеров управления блогом
 *  в панели администратора.
 *
 *  Должен быть родителем всех сонтроллероа управления блогом
 */

abstract class BaseController extends GuestBaseController
{
    public function __construct()
    {

    }
}
