<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
    'columns'=>array
    (
        'id',
		'name',
		'city',
		'zip',
		'state',
		'country',
        array(            // display 'author.username' using an expression
            'name'=>'email',
			'type'=>'raw',
            'value'=>'$data->getEmail($data->id)',
        ),
    ),
));