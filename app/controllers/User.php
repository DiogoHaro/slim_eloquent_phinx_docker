<?
namespace app\controllers;

use app\classes\Flash;
use app\classes\Validate;
use app\models\User as ModelsUser;

class User extends Base
{
    public function __construct()
    {
        $this->user = new ModelsUser;
        $this->validate = new Validate;
    }

    public function create($request, $response, $args)
    {
        return $this->getTwig()->render($response, $this->setView('site/user_create'), [
            'title' => 'User Create',
            'messages' => Flash::all()
        ]);
    }

    public function edit($request, $response, $args)
    {
        $id = filter_var($args['id'], FILTER_SANITIZE_NUMBER_INT);

        $user = $this->user::find($id);
        if(!$user) {
            Flash::set('message', 'User does not exist', 'danger');
            return $response->withHeader('location', '/')->withStatus(200);
        }

        return $this->getTwig()->render($response, $this->setView('site/user_edit'), [
            'title'    => 'User Edit',
            'user'     => $user,
            'messages' => Flash::all()
        ]);
    }

    public function changePassword($request, $response, $args) 
    {
        $id = filter_var($args['id'], FILTER_SANITIZE_NUMBER_INT);

        return $this->getTwig()->render($response, $this->setView('site/user_edit_password'), [
            'title'    => 'Edit Password',
            'user'     => $this->user::find($id),
            'messages' => Flash::all()
        ]);
    }

    public function newPassword($request, $response, $args)
    {
        $id = filter_var($args['id'], FILTER_SANITIZE_NUMBER_INT);
        $user = $this->user::find($id);
        $errors = $this->validate->required(['password'])->getErrors();
        if(!$errors) {
            $user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            if($user->save()) {
                return $response->withHeader('location', "/user/edit/$id")->withStatus(200);
            }
            Flash::set('message', 'failed to change');
        }
        Flash::flashes($errors);
        return $response->withHeader('location', "/user/edit/password/$id")->withStatus(200);
    }

    public function store($request, $response, $args)
    {
        $errors = $this->validate->required(['name', 'age', 'email', 'password'])->alreadyUse($this->user, 'email', $_POST['email'])->getErrors();

        if($errors) {
            Flash::flashes($errors);
        }
        else {
            Flash::set('message', $this->user->create(['name'     => $_POST['name']
                                                      ,'age'      => $_POST['age']
                                                      ,'email'    => $_POST['email']
                                                      ,'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)])  ? 'registered successfully' : 'failed to register');
        }

        return $response->withHeader('location', '/user/create')->withStatus(200);
    }

    public function update($request, $response, $args)
    {
        $id = filter_var($args['id'], FILTER_SANITIZE_NUMBER_INT);
        $user = $this->user::find($id);
        $this->validate->required(['name', 'age', 'email']);
        if($user->email != $_POST['email']) {
            $this->validate->alreadyUse($this->user, 'email', $_POST['email']);
        }
        $errors =  $this->validate->getErrors();
        if(!$errors) {
            $user->name  = $_POST['name'];
            $user->email = $_POST['email'];
            $user->age   = $_POST['age'];
            if($user->save()) {
                return $response->withHeader('location', "/")->withStatus(200);
            }
            Flash::set('message', 'failed to change');
        }
        Flash::flashes($errors);
        return $response->withHeader('location', "/user/edit/$id")->withStatus(200);
    }

    public function destroy($request, $response, $args)
    {
        $id = filter_var($args['id'], FILTER_SANITIZE_NUMBER_INT);
        $this->user::find($id)->delete();
        return $response->withHeader('location', '/')->withStatus(200);
    }
}