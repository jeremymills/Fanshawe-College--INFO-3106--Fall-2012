<?php
/**
 * SplLoader
 *
 * An implementation for PHP's SPL autoloading functionality.
 * This implementation is specific to this framework, however, can easily be ported.
 *
 * @version 1.0
 */
final class SplLoader
{
    private $_loaded_items  = array();
    private $_include_paths = array();
    
    private $_dir_sep;
    private $_php_ext;
    private $_ns_sep;
    
    /**
     * __construct
     *
     * Creates a new instance of the SplLoader class. It is important to note that
     * during instantiation this instance is automatically registered as the
     * autoload callback using the spl_autoload_register.
     *
     * @access public
     * @param string Contains the directory separator. If not provided, DIRECTORY_SEPARATOR is used.
     * @param string Contains a generic file extension to use for including purposes of PHP files.
     * @param string Contains the namespace separator. If not provided, "\\" is used.
     * @param array Contains an array of default paths to check for including new files.
     * @return void
     */
    public function __construct($dir_sep = null, $php_ext = null, $ns_sep = null, array $include_paths = array())
    {
        $this->_dir_sep = null !== $dir_sep ? $dir_sep : DIRECTORY_SEPARATOR;
        $this->_php_ext = null !== $php_ext ? $php_ext : '.php';
        $this->_ns_sep  = null !== $ns_sep  ? $ns_sep  : '\\';
        
        $this->_include_paths = $include_paths;
        
        $this->register();
    }
    
    /**
     * register
     *
     * Registers this instance with the SPL autoloader.
     *
     * @access public
     * @param void
     * @return void
     */
    public function register()
    {
        spl_autoload_register(array($this, 'load'));
    }
    
    /**
     * unregister
     *
     * Unregisters this instance with the SPL autoloader.
     *
     * @access public
     * @param void
     * @return void
     */
    public function unregister()
    {
        spl_autoload_unregister(array($this, 'load'));
    }
    
    /**
     * load
     *
     * Callback method for the SPL autoloader. Used for autoloading
     * a specific class or interface given the fully qualified name.
     *
     * @access public
     * @param string Contains the fully qualified name of the item to load.
     * @return bool Returns true if loaded successfully or already loaded, otherwise returns false.
     */
    public function load($class)
    {   
        if( in_array($class, $this->_loaded_items) )
        {
            return true;
        }
        
        $fileuri    = null;
        $is_found   = true;
        
        /* Check if the qualified name contains the namespace separator. If so, we need to parse this ... */
        if( false !== strpos($class, $this->_ns_sep) )
        {
            $pieces     = explode($this->_ns_sep, $class);
            $className  = array_pop($pieces);
            
            $piecesSize = count($pieces);
            $piecesStr  = implode($this->_dir_sep, $pieces);
            
            foreach( $this->_include_paths as $lookup_path )
            {
                $path = $lookup_path . $this->_dir_sep . $piecesStr . $this->_dir_sep;
                
                if( !is_dir($path) )
                {
                    continue;
                }
                
                $fileuri = $path . $className . $this->_php_ext;
                if( $this->_loadItem($class, $fileuri) )
                {
                    return true;
                }
                else
                {
                    $fileuri = $path . $className . $this->_dir_sep . $className . $this->_php_ext;
                    if( $this->_loadItem($class, $fileuri) )
                    {
                        return true;
                    }
                }
            }
        }
        else
        {
            foreach( $this->_include_paths as $lookup_path )
            {
                $fileuri = $lookup_path . $this->_dir_sep . $class . $this->_php_ext;
                if( $this->_loadItem($class, $fileuri) )
                {
                    return true;
                }
                else
                {
                    $fileuri = $lookup_path . $this->_dir_sep . $class . $this->_dir_sep . $class . $this->_php_ext;
                    if( $this->_loadItem($class, $fileuri) )
                    {
                        return true;
                    }
                }
            }
        }
        
        return false;
    }
    
    /**
     * addIncludePaths
     *
     * Adds an array of paths to the internal list of
     * paths to test for loading items.
     *
     * @access public
     * @param array Contains an array of paths (absolute) to add
     * @return void
     */
    public function addIncludePaths(array $paths)
    {
        foreach( $paths as $path )
        {
            $this->addIncludePath($path);
        }
    }
    
    /**
     * addIncludePath
     *
     * Add a single path to the internal list of
     * paths to test for loading items.
     *
     * @access public
     * @param string Contains a single absolute include path to add
     * @return void
     */
    public function addIncludePath($path)
    {
        if( !in_array($path, $this->_include_paths) && is_dir($path) )
        {
            $path = rtrim($path, $this->_dir_sep);
            $this->_include_paths[] = $path;
        }
    }
    
    /**
     * removeIncludePath
     *
     * Removes the specified path from the internal
     * list of paths to test for loading items.
     *
     * @access public
     * @param string Contains the path to remove.
     * @return bool Returns true on success, otherwise false.
     */
    public function removeIncludePath($path)
    {
        if( in_array($path, $this->_include_paths) )
        {
            $path = rtrim($path, $this->_dir_sep);
            $flip = array_flip($this->_include_paths);
            unset($this->_include_paths[$flip[$this->_include_paths]]);
            
            return true;
        }
        
        return false;
    }
    
    /**
     * _loadItem
     *
     * Used for loading a specific item given the class name & file uri.
     *
     * @access private
     * @param string Contains the class name being loaded.
     * @param string Contains a valid file path to the file to load.
     * @return boolean Returns true on success, otherwise false.
     */
    private function _loadItem($class, $fileuri)
    {
        if( file_exists($fileuri) && is_file($fileuri) )
        {
            require_once $fileuri;
            $this->_loaded_items[] = $class;
            
            return true;
        }
        
        return false;
    }
}