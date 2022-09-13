<?php

class Container {
	public static function getBanco(){
		return new Banco('localhost', '<nome do banco>', '<user>', '<senha user banco>');
	}
}
