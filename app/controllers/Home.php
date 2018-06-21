<?php
/**
 * Created by PhpStorm.
 * User: dechadou-pc
 * Date: 20/6/2018
 * Time: 4:20 PM
 */

namespace App\Controllers;

use App\Helpers\Validator;
use App\Repository\User;
use Src\Controller;
use Src\View;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validation;
use Symfony\Component\HttpFoundation\RedirectResponse;

class Home extends Controller
{
    /**
     * @param bool $errors
     * @param bool $search
     * @throws \Exception
     */
    public function index($errors = false, $search = false)
    {
        $users = User::all();
        View::set("users", $users);
        View::set('search', $search);
        View::set("title", "MORSUM - MVC CC - Home");
        View::set('errors', $errors);
        View::render("home/index");
    }

    /**
     * @param int $id
     * @throws \Exception
     */
    public function view($id)
    {
        $users = User::find($id);
        if (!$users) {
            throw new \Exception('Invalid user');
        }

        $response = new JsonResponse($users[0], 200);
        $response->send();
    }

    /**
     * @internal param $data
     */
    public function update()
    {
        $request = Request::createFromGlobals();

        User::update([
            ':id' => $request->get('id'),
            ':name' => $request->get('name'),
            ':lastname' => $request->get('lastname'),
            ':address' => $request->get('address'),
            ':email' => $request->get('email'),
            ':phone' => $request->get('phone')
        ]);

        return true;
    }

    /**
     * @internal param Request $request
     * @internal param $name
     * @throws \Exception
     */
    public function store()
    {
        $request = Request::createFromGlobals();
        $validator = new Validator($request);
        $validation = $validator->validate();
        if($validation)
        {
            return $this->index($validation);
        }

        User::store([
            ':name' => $request->get('name'),
            ':lastName' => $request->get('lastName'),
            ':address' => $request->get('address'),
            ':email' => $request->get('email'),
            ':phone' => $request->get('phone')
        ]);

        $response = new RedirectResponse('index', 201);
        $response->send();
    }

    /**
     *
     */
    public function destroy()
    {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $request = Request::createFromGlobals();
            $id = $request->get('user_id');
            User::destroy($id);

            $response = new Response('User deleted', Response::HTTP_OK);
            $response->send();
        }

        $response = new Response('Not an ajax request', Response::HTTP_BAD_REQUEST);
        $response->send();

    }

    /**
     * @param null $term
     * @throws \Exception
     */
    public function search($term = null)
    {
        if (!$term) {
            $response = new RedirectResponse('index');
            $response->send();
        }

        $result = User::search($term);

        $this->index(false, $result);
    }
}
