<?php 
namespace App\Helper;
use Helpers;
use Log;
use Request;

    class myFunctions {
    	public static function sidebarSwitch() {
			$uri = Request::path();
			$tok = explode("/", $uri);
			if($tok[0] == "myApply")
				return config('GV.myapply');
			else if($tok[0] == "apply")
				if($tok[1] == "create" || $tok[1] == "edit")
					return config('GV.none');
				else
					return config('GV.myapply');
			else if($tok[0] == "infopublic" || $tok[0] == "info_public")
				return config('GV.infopublic');
			else
				return config('GV.main');
    	}
    }
?>