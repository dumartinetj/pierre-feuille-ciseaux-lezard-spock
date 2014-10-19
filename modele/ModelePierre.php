<?php

class static ModelePierre extends ModeleFigure {

	protected static $image = "LIEN_VERS_LIMAGE";
	protected static $son "LIEN_VERS_LE_SON";;
	private static final $forces = array(ModeleCiseaux, ModeleLezard); // je ne suis pas sur du tout de la syntaxe de l'array
    private static final $faiblesses = array(ModeleFeuille, ModeleSpock); // je ne suis pas sur du tout de la syntaxe de l'array

	public quiSuisJe() {
		return "Pierre";
	}
	
}

?>