<?php
/**
 * Demo\Views
 */
namespace Demo\Views
{
    /**
     * @ignore
     */
    defined('IN_DEMO') or exit;
    
    /**
     * Template
     */
    class Template extends \Mills\View
    {
        /**
         * @var \Mills\View
         */
        private $_content = null;
        
        private $_navigation = array();
        
        /**
         * __construct
         *
         * Creates an instance of the Template view.
         *
         * @access pubic
         * @param void
         * @return void
         */
        public function __construct(array $data = array())
        {
            parent::__construct(ROOT_PATH . 'templates' . DIRECTORY_SEPARATOR . 'template.tmpl.php', $data);
            
            $this->initNavigation();
        }
        
        /**
         * content
         *
         * Accessor/mutator method for the content child view.
         *
         * @access public
         * @param \Mills\View Contains the child view to render as the main content page.
         * @return mixed
         */
        public function content(\Mills\View $view = null)
        {
            if( null === $view ) {
                return $this->_content;
            }
            
            $this->_content = $view;
            return $this;
        }
        
        final public function navigation()
        {
            return $this->_navigation;
        }
        
        public function &navigationItem($key, array $info = null)
        {
            if( null === $info )
            {
                return isset($this->_navigation[$key]) ? $this->_navigation[$key] : false;
            }
            
            $this->_navigation[$key] += $info;
            return $this;
        }
        
        /**
         * @see \Mills\View::beforeRender
         */
        protected function beforeRender()
        {
            $this->set('content', $this->_content);
            $this->set('navigation', $this->_navigation);
            
            parent::beforeRender();
        }
        
        protected function initNavigation()
        {
            $this->_navigation = array(
                'getting-started' => array(
                    '#title' => 'Getting Started',
                    '#href'  => 'index.php'
                ),
                
                'form-element' => array(
                    '#title' => 'Form Element',
                    '#href'  => 'formelement.php'
                ),
                
                'text-inputs' => array(
                    '#title' => 'Text Inputs',
                    '#href'  => 'textinput.php'
                ),
                
                'select-inputs' => array(
                    '#title' => 'Select Inputs',
                    '#href'  => 'selectinput.php'
                ),
                
                'radio-checkbox-inputs' => array(
                    '#title' => 'Radio and Checkbox Inputs',
                    '#href'  => 'radio.php'
                ),
                
                'html5-elements' => array(
                    '#title' => 'HTML5 Elements',
                    '#href'  => '#'
                )
            );
        }
    }
}