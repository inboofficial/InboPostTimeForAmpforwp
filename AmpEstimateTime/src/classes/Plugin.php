<?php
/**
 * @package             PluginPackage
 * @author              mohammad ali nassiri
 * @copyright           please_do_not_copy
 */


namespace IrInboExtension\classes;

use ArrayAccess;
use IrInboExtension\services\ServiceInterface;
use ReflectionClass;

class Plugin implements ArrayAccess {
    protected $contents;

    public function __construct() {
        $this->contents = array();
    }

    public function offsetSet( $offset, $value ) {
        $this->contents[$offset] = $value;
    }

    public function offsetExists($offset) {
        return isset( $this->contents[$offset] );
    }

    public function offsetUnset($offset) {
        unset( $this->contents[$offset] );
    }

    public function offsetGet($offset) {
        if( is_callable($this->contents[$offset]) ){
            return call_user_func( $this->contents[$offset], $this );
        }
        return isset( $this->contents[$offset] ) ? $this->contents[$offset] : null;
    }

    public function run(){
        foreach( $this->contents as $key => $content ){ // Loop on contents
            if( is_callable($content) ){
                $content = $this[$key];
            }
            if( is_object( $content ) ){
                if( $content instanceof ServiceInterface){
                    $content->run(); // Call run method on object
                }
            }
        }
    }
}
