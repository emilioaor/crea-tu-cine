<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Session;

use App\User;
use App\Style;
use App\Cinema;
use App\Movie;

class ConfigController extends Controller
{
    /**
     * @param Request $request
     * @return $this
     */
    public function config(Request $request) {
        $user = User::where('user', $request->user)->get();
        $cinema = $user[0]->getCinemas[0];

        return view('cine.config')->with(['userUrl' => $user[0]->user, 'cinema' => $cinema]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateConfig(Request $request) {

        $user = User::where('user', $request->user)->get();
        $cinema = $user[0]->getCinemas[0];

        try {

            DB::beginTransaction();

            foreach ($request->styles as $name => $value) {
                $style = Style::where('name', $name)->where('cine_id', $cinema->id)->get()[0];
                $style->value = $value;
                $style->save();
            }

            DB::commit();

            Session::flash('alert-type','alert-success');
            Session::flash('alert-msg','Configuración actualizada');
            return redirect()->route('cine.user.config', ['user' => $user[0]->user]);

        } catch (\Exception $ex) {
            DB::rollback();
        }

        Session::flash('alert-type','alert-success');
        Session::flash('alert-msg','Error al actualizar configuración');
        return redirect()->route('cine.user.config', ['user' => $user[0]->user]);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restoreConfig(Request $request) {

        $user = User::where('user', $request->user)->get();
        $cinema = $user[0]->getCinemas[0];

        try {

            DB::beginTransaction();

            $cinema->restoreDefaultStyles();

            DB::commit();

            Session::flash('alert-type','alert-success');
            Session::flash('alert-msg','Configuración restaurada');
            return redirect()->route('cine.user.config', ['user' => $user[0]->user]);

        } catch (\Exception $ex) {
            DB::rollback();
        }

        Session::flash('alert-type','alert-success');
        Session::flash('alert-msg','Error al actualizar configuración');
        return redirect()->route('cine.user.config', ['user' => $user[0]->user]);
    }


    public function changeImage(Request $request) {

        DB::beginTransaction();
        $user = User::where('user', $request->user)->get();
        $cinema = Cinema::where('user_id', $user[0]->id)->get();

        if($request->image){

            try {

                $originalExtension = $request->image->getClientOriginalExtension();
                $originalName = $request->image->getClientOriginalName();

                if ($originalExtension != 'jpg' && $originalExtension != 'jpeg' && $originalExtension != 'png') {
                    Session::flash('alert-msg', 'La imagen debe ser formato jpg o png');
                    Session::flash('alert-type', 'alert-danger');
                    DB::rollback();
                    return redirect()->route('cine.user.config', ['user' => $user[0]->user]);
                }

                $now = new \DateTime();
                $fileName = $user[0]->user . $now->format('d-m-Y h:m:s') . '.' . $originalExtension;

                $cinema[0]->image = Movie::DIR_UPLOADS . '/' . $fileName;
                $cinema[0]->save();

                $path = public_path() . '/' . Movie::DIR_UPLOADS . '/';
                $size = filesize($path);
                $info = getimagesize($_FILES['image']['tmp_name']);

                if ($info[0] != $info[1]) {
                    Session::flash('alert-msg', 'La imágen no es cuadrada');
                    Session::flash('alert-type', 'alert-danger');
                    DB::rollback();
                    return redirect()->route('cine.user.config', ['user' => $user[0]->user]);
                }

                if ($size > (1024 * 1024)) {
                    Session::flash('alert-msg', 'La imagen no puede pesar mas de 1 MB');
                    Session::flash('alert-type', 'alert-danger');
                    DB::rollback();
                    return redirect()->route('cine.user.config', ['user' => $user[0]->user]);
                }

                if (!$request->image->move($path, $fileName)) {
                    Session::flash('alert-msg', 'Ocurrio un error al subir archivo');
                    Session::flash('alert-type', 'alert-danger');
                    DB::rollback();
                    return redirect()->route('cine.user.config', ['user' => $user[0]->user]);
                }

                Session::flash('alert-msg', 'Imagen cargada correctamente');
                Session::flash('alert-type', 'alert-success');
                DB::commit();

            } catch (\Exception $ex) {
                Session::flash('alert-msg', 'Ocurrio un error al subir archivo');
                Session::flash('alert-type', 'alert-danger');
                DB::rollback();
            }
        }

        return redirect()->route('cine.user.config', ['user' => $user[0]->user]);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePassword(Request $request) {

        $user = User::where('user', $request->user)->get();
        $cinema = $user[0]->getCinemas[0];

        if (! Hash::check($request->old_password, Auth::user()->password)) {

            Session::flash('alert-type', 'alert-danger');
            Session::flash('alert-msg', 'La contraseña actual es incorrecta');

            return redirect()->route('cine.user.config', ['user' => $user[0]->user]);

        } elseif ($request->password !== $request->password2) {

            Session::flash('alert-type', 'alert-danger');
            Session::flash('alert-msg', 'Las nuevas contraseñas no coinciden');

            return redirect()->route('cine.user.config', ['user' => $user[0]->user]);
        }

        if (! $this->requestValidation($request, User::initChangePasswordValidationParams())) {
            Session::flash('alert-msg', implode('<br>', $this->getRequestErrors()));
            Session::flash('alert-type', 'alert-danger');

            return redirect()->route('cine.user.config', ['user' => $user[0]->user]);
        }

        $user[0]->password = bcrypt($request->password);
        $user[0]->save();

        Session::flash('alert-msg', 'Contraseña actualizada correctamente');
        Session::flash('alert-type', 'alert-success');

        return redirect()->route('cine.user.config', ['user' => $user[0]->user]);
    }
}
