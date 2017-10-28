<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use DB;
use View;

use App\Http\Requests\registerRequest;
use App\Http\Controllers\Controller;
use App\User;
use App\Cinema;

class IndexController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $cinemas = Cinema::orderBy('id','DESC')->limit(6)->get();

        return view('index.index')->with(['cinemas' => $cinemas]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login() {

        return view('index.login');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function registerUser(Request $request) {

        Session::flash('user', $request->user);
        Session::flash('email', $request->email);
        Session::flash('cine_name', $request->cine_name);

        if ($request->password === $request->password2) {

            if (! $this->requestValidation($request, User::initRegisterValidationParams())) {
                Session::flash('alert-msg', implode('<br>', $this->getRequestErrors()));
                Session::flash('alert-type', 'alert-danger');

                $route = route('index.index') . '#contact';

                return redirect($route);
            }

            try {

                DB::beginTransaction();

                $user = new User($request->all());
                $user->status = User::STATUS_ACTIVE;
                $user->level = User::LEVEL_USER;
                $user->password = bcrypt($request->password);
                $user->save();

                $cine = new Cinema();
                $cine->name = $request->cine_name;
                $cine->status = Cinema::STATUS_ACTIVE;
                $cine->image = Cinema::IMAGE_DEFAULT;
                $cine->user_id = $user->id;
                $cine->save();

                $cine->addDefaultStyles();

                DB::commit();

                Session::flash('alert-msg', 'Usuario registrado');
                Session::flash('alert-type', 'alert-success');
                return redirect()->route('index.login');

            } catch (\Exception $ex) {
                DB::rollback();
            }

            Session::flash('alert-msg', 'Error al registrar usuario');
            Session::flash('alert-type', 'alert-danger');
            $route = route('index.index') . '#contact';

            return redirect($route);
        }

        Session::flash('alert-msg', 'Las contraseñas deben ser iguales');
        Session::flash('alert-type', 'alert-danger');
        $route = route('index.index') . '#contact';

        return redirect($route);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function loginUser(Request $request) {

        if (! $this->requestValidation($request, User::initLoginValidationParams())) {
            Session::flash('alert-msg', implode('<br>', $this->getRequestErrors()));
            Session::flash('alert-type', 'alert-danger');
            return redirect()->route('index.login');
        }

        if (Auth::attempt(['user' => $request->user, 'password' => $request->password])){
            return redirect()->route('cine.user.index', ['user' => Auth::user()->user]);
        }

        Session::flash('alert-msg', 'Error al iniciar sesión');
        Session::flash('alert-type', 'alert-danger');
        $this->createSessionFromRequest($request);

        return redirect()->route('index.login');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout() {
        Auth::logout();
        return redirect()->route('index.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function passwordReset() {
        return view('index.password-reset');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function passwordResetStore(Request $request) {

        $user = User::where('user', $request->user)->where('email', $request->email)->get();

        if (count($user)) {

            Session::flash('alert-type', 'alert-success');
            Session::flash('alert-msg', 'Hemos enviado a su correo los detalles de reuperación');

            $token = csrf_token();

            $user[0]->password_temp = $token;
            $user[0]->save();

            $mailView = View::make('index.mail')->with('id', $user[0]->id)->with('tmp', $token);

            mail($request->email, 'Cine en Casa - Recuperación de contraseña', $mailView->render());

            return redirect()->route('index.password.reset');
        }

        Session::flash('alert-type', 'alert-danger');
        Session::flash('alert-msg', 'Los datos de recuperación son incorrectos');

        return redirect()->route('index.password.reset');
    }

    /**
     * @param $id
     * @param $token
     * @return mixed
     */
    public function passwordToken($id, $tmp) {
        return view('index.password-token')->with(['id' => $id, 'tmp' => $tmp]);
    }

    /**
     * @param Request $request
     * @param $id
     * @param $tmp
     * @return \Illuminate\Http\RedirectResponse
     */
    public function passwordTokenStore(Request $request, $id, $tmp) {

        $user = User::find($id);

        if (! $user) {
            Session::flash('alert-type', 'alert-danger');
            Session::flash('alert-msg', 'Error en recuperación de contraseña. Tal vez deba solicitar el código de recuperación nuevamente');

            return redirect()->route('index.password.reset.token', ['id' => $id, 'tmp' => $tmp]);
        }

        if ($user->password_temp !== $tmp) {
            Session::flash('alert-type', 'alert-danger');
            Session::flash('alert-msg', 'El código de recuperacion es invalido');

            return redirect()->route('index.password.reset.token', ['id' => $id, 'tmp' => $tmp]);
        }

        if ($request->password !== $request->password2) {
            Session::flash('alert-type', 'alert-danger');
            Session::flash('alert-msg', 'Las nuevas contraseñas no coinciden');

            return redirect()->route('index.password.reset.token', ['id' => $id, 'tmp' => $tmp]);
        }

        if (! $this->requestValidation($request, User::initChangePasswordValidationParams())) {
            Session::flash('alert-msg', implode('<br>', $this->getRequestErrors()));
            Session::flash('alert-type', 'alert-danger');

            return redirect()->route('index.password.reset.token', ['id' => $id, 'tmp' => $tmp]);
        }

        $user->password = bcrypt($request->password);
        $user->password_temp = null;
        $user->save();

        Session::flash('alert-msg', 'Contraseña actualizada correctamente');
        Session::flash('alert-type', 'alert-success');

        return redirect()->route('index.login');
    }
}
