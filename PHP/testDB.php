<?php

class Person { 
    public $age;
    }
    $harry = new Person();
    $harry -> age = 28;
    $harryString = serialize( $harry );
    echo "Harry is now serialized in the following string: '$harryString'<br/>";
    echo "Converting '$harryString'back to an object... <br/>";
    $obj = unserialize( $harryString ); 
    echo "Harry’s age is: ". $obj-> age ; 