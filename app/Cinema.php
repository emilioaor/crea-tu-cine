<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Style;

class Cinema extends Model
{
    const DIR_UPLOADS = 'imagesCinema';

    const STATUS_ACTIVE = 'Activo';

    const IMAGE_DEFAULT = 'images/cineencasa.jpg';

    protected $table = 'cinemas';

    protected $fillable = ['name','status','image','likes','user_id'];

    public function getUser() {
        return $this->belongsTo('App\User','user_id');
    }

    public function getMovies() {
        return $this->hasMany('App\Movie','cine_id');
    }

    public function getRelationsMovies() {
        return $this->hasMany('App\Relation','cine_id');
    }

    public function getStyles() {
        return $this->hasMany('App\Style', 'cine_id');
    }

    public function addDefaultStyles() {
        $style = new Style();
        $style->selector = '#main';//1
        $style->name = 'background_main';
        $style->label = 'Fondo cine';
        $style->property = 'background-color';
        $style->value = '#ffffff';
        $style->cine_id = $this->id;
        $style->save();

        $style = new Style();
        $style->selector = '#main #-panel li';//2
        $style->name = 'buton_top_background';
        $style->label = 'Color boton (Botonera)';
        $style->property = 'background-color';
        $style->value = '#ffffff';
        $style->cine_id = $this->id;
        $style->save();

        $style = new Style();
        $style->selector = '#main #-panel li a';//9
        $style->name = 'buton_top_text_color';
        $style->label = 'Color texto boton (Botonera)';
        $style->property = 'color';
        $style->value = '#2196f3';
        $style->cine_id = $this->id;
        $style->save();

        $style = new Style();
        $style->selector = '#main #-panel li';//10
        $style->name = 'buton_top_border_color';
        $style->label = 'Color borde boton (Botonera)';
        $style->property = 'border-color';
        $style->value = '#2196f3';
        $style->cine_id = $this->id;
        $style->save();

        $style = new Style();
        $style->selector = '#main .dynamic-link';//3
        $style->name = 'buton_top_color';
        $style->label = 'Enlaces';
        $style->property = 'color';
        $style->value = '#2196f3';
        $style->cine_id = $this->id;
        $style->save();

        $style = new Style();
        $style->selector = '#main #movieShow';//7
        $style->name = 'movie_text_color';
        $style->label = 'Color de texto';
        $style->property = 'color';
        $style->value = '#292b2c';
        $style->cine_id = $this->id;
        $style->save();

        $style = new Style();
        $style->selector = '#main .space-movie .movie .space-syn';//5
        $style->name = 'space_syn_color';
        $style->label = 'Fondo de sinopsis';
        $style->property = 'background-color';
        $style->value = '#222222';
        $style->cine_id = $this->id;
        $style->save();

        $style = new Style();
        $style->selector = '#main .space-movie .movie .space-syn';//6
        $style->name = 'space_syn_color_text';
        $style->label = 'Texto de sinopsis';
        $style->property = 'color';
        $style->value = '#ffffff';
        $style->cine_id = $this->id;
        $style->save();

        $style = new Style();
        $style->selector = '#main .btn-outline-primary';//4
        $style->name = 'buton_primary_color';
        $style->label = 'Color botones';
        $style->property = 'background-color';
        $style->value = '#2196f3';
        $style->cine_id = $this->id;
        $style->save();

        $style = new Style();
        $style->selector = '#main .btn-outline-primary';//8
        $style->name = 'buton_primary_text_color';
        $style->label = 'Texto botones';
        $style->property = 'color';
        $style->value = '#ffffff';
        $style->cine_id = $this->id;
        $style->save();

        $style = new Style();
        $style->selector = '#main .link-border';//8
        $style->name = 'border_movie';
        $style->label = 'Borde pelicula';
        $style->property = 'color';
        $style->value = '#2196f3';
        $style->cine_id = $this->id;
        $style->save();
    }

    public function restoreDefaultStyles() {

        $style = Style::where('selector','#main')->where('name','background_main')->where('cine_id',$this->id)->get()[0];
        $style->value = '#ffffff';
        $style->save();

        $style = Style::where('selector','#main #-panel li')->where('name','buton_top_background')->where('cine_id',$this->id)->get()[0];
        $style->value = '#ffffff';
        $style->save();

        $style = Style::where('selector','#main #-panel li a')->where('name','buton_top_text_color')->where('cine_id',$this->id)->get()[0];
        $style->value = '#2196f3';
        $style->save();

        $style = Style::where('selector','#main #-panel li')->where('name','buton_top_border_color')->where('cine_id',$this->id)->get()[0];
        $style->value = '#2196f3';
        $style->save();

        $style = Style::where('selector','#main .dynamic-link')->where('name','buton_top_color')->where('cine_id',$this->id)->get()[0];
        $style->value = '#2196f3';
        $style->save();

        $style = Style::where('selector','#main #movieShow')->where('name','movie_text_color')->where('cine_id',$this->id)->get()[0];
        $style->value = '#292b2c';
        $style->save();

        $style = Style::where('selector','#main .space-movie .movie .space-syn')->where('name','space_syn_color')->where('cine_id',$this->id)->get()[0];
        $style->value = '#222222';
        $style->save();

        $style = Style::where('selector','#main .space-movie .movie .space-syn')->where('name','space_syn_color_text')->where('cine_id',$this->id)->get()[0];
        $style->value = '#ffffff';
        $style->save();

        $style = Style::where('selector','#main .btn-outline-primary')->where('name','buton_primary_color')->where('cine_id',$this->id)->get()[0];
        $style->value = '#2196f3';
        $style->save();

        $style = Style::where('selector','#main .btn-outline-primary')->where('name','buton_primary_text_color')->where('cine_id',$this->id)->get()[0];
        $style->value = '#ffffff';
        $style->save();

        $style = Style::where('selector','#main .link-border')->where('name','border_movie')->where('cine_id',$this->id)->get()[0];
        $style->value = '#2196f3';
        $style->save();

    }

    public static function initRegisterValidationParams() {
        $params = [
            'title' => [
                'label' => 'Titulo',
                'required' => true,
                'max' => 80,
            ],
            'synopsis' => [
                'label' => 'Sinopsis',
                'required' => true,
                'max' => 255,
            ],
            'year' => [
                'label' => 'Año',
                'required' => true,
                'max' => 4,
                'custom' => [
                    '/^[0-9]+[0-9]*$/'
                ]
            ],
            'slug' => [
                'label' => 'Titulo url',
                'required' => true,
                'min' => 5,
                'max' => 80,
                'custom' => [
                    '/^[a-z]+[-a-z0-9]*[a-z]$/i'
                ]
            ],
            'trailer' => [
                'label' => 'Trailer',
                'custom' => [
                    '/^(http|https)\:\/\/[a-z0-9\.-]+\.[a-z]{2,4}/i'
                ]
            ],
        ];

        return $params;
    }
}
