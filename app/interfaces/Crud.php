<?php
/**
 * Created by PhpStorm.
 * User: dechadou-pc
 * Date: 20/6/2018
 * Time: 3:24 PM
 */

namespace App\Interfaces;

interface Crud
{
    public static function all();
    public static function find($id);
    public static function store($data);
    public static function update($data);
    public static function destroy($id);
    public static function prepare($sql, $binding);
    public static function search($term);
}
