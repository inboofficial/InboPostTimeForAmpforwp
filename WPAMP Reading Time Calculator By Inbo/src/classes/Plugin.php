<?php
/**
 * @package             PluginPackage
 * Inbo Post Time For ampforwp is free software:
 * you can redistribute it and/or modify it under the terms of the GNU General
 * Public License as published by the Free Software Foundation,
 * either version 2 of the License, or any later version.
 *
 * Inbo Post Time For ampforwp is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
 * or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * Inbo Post Time For ampforwp. If not, see <https://www.gnu.org/licenses/>.
 *
 */


namespace IrInboExtension\classes;

use ArrayAccess;
use IrInboExtension\services\ServiceInterface;

/**
 * Class Plugin
 * @package IrInboExtension\classes
 * @author mohammad.ank@outlook.com
 */
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
