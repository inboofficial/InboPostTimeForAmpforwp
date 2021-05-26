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

/**
 * Class InboTemplate
 * @package IrInboExtension\classes
 * @author mohammad.ank@outlook.com
 */
class InboTemplate {
    //Path to template
    protected $template;
    //Variables 
    protected $vars = array();

    /*
     * Class Constructor
     */
    public function __construct($template){
        $this->template = $template;
    }

    /* __get() and __set() are run when writing data to inaccessible properties.
     * Get template variables
     */
    public function __get($key){
        return $this->vars[$key];
    }

    /*
     * Set template variables
     */
    public function __set($key, $value){
        $this->vars[$key] = $value;
    }

    /*
     * Convert Object To String
     */
    public function __toString(){
        extract($this->vars); // extract our template variables ex: $value
        // print_r($this->vars ) ;  testing
        // chdir(dirname($this->template));
        ob_start(); // store as internal buffer

        include $this->template;  // include the template into our file

        return ob_get_clean();
    }
}