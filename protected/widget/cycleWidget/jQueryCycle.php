<?php

/**
 * Description of BrandProductsWidget
 *
 */
class jQueryCycle extends CWidget {
	
	public $images;
	public $fx;
	public $sync;
	public $delay;


	public function run() {
        $this->render('viewjQueryCycle', [
			'images'=>$this->images,
			'fx'=>$this->fx,
			'sync'=>$this->sync,
			'delay'=>$this->delay
        ]);
    }

}
