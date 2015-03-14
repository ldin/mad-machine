<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}
        protected function ru2Lat($string)
        {
            $source = array("А"=>"A","Б"=>"B","В"=>"V","Г"=>"G","Д"=>"D","Е"=>"E", "Ё"=>"YO" ,"Ж"=>"J","З"=>"Z","И"=>"I","Й"=>"Y","К"=>"K","Л"=>"L","М"=>"M","Н"=>"N",
                "О"=>"O","П"=>"P","Р"=>"R","С"=>"S","Т"=>"T", "У"=>"U","Ф"=>"F","Х"=>"H","Ц"=>"TS","Ч"=>"CH", "Ш"=>"SH","Щ"=>"SCH","Ъ"=>"","Ы"=>"YI","Ь"=>"",
                "Э"=>"E","Ю"=>"YU","Я"=>"YA","а"=>"a","б"=>"b", "в"=>"v","г"=>"g","д"=>"d","е"=>"e", "ё"=>"yo","ж"=>"j", "з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l",
                "м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r", "с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h", "ц"=>"ts","ч"=>"ch","ш"=>"sh","щ"=>"sch","ъ"=>"y",
                "ы"=>"yi","ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya");

            $string=explode(",", $string);

            $string = strtr($string[0], $source);   

                $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
                $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
                $clean = strtolower(trim($clean, '-'));
                $clean = preg_replace("/[\/_|+ -]+/", '-', $clean);

            return($clean);
        }
        
        protected function getMessage($message, $redirect = false) {
            return View::make('message', array(
                'message'   => $message,
                'redirect'  => $redirect,
            ));
        }
        
        protected function validateSlug($slug){
            if(!preg_match('|^[A-Z0-9]+$|i', $slug)){
                $slug = preg_replace('/[^a-z0-9-_]+/iu', '', $slug);
            }
        return $slug;
        }
                

}
