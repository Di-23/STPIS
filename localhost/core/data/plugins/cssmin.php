<?php
    class CSSMin {
        private $original_css;
        private $compressed_css;

        /* Constructor for CSSMin class */
        public function __construct() {
            $this->original_css = "";
            $this->compressed_css = "";
        }
		
        /* Sets original css */
        public function setOriginalCSS($content) {
			$this->original_css = $content;
        }
		
		public static function minify($data)
		{
			$cssmin = new CSSMin();
			require_once "scss/scss.inc.php";
			$scss = new scssc();
			$cssmin->setOriginalCSS($scss->compile($data));
			$cssmin->compressCSS();
			return $cssmin->compressed_css;
		}

        /* Make simple compression with regexp. */
        public function compressCSS() {
            $patterns = array();
            $replacements = array();
            /* remove multiline comments */
            $patterns[] = '/\/\*.*?\*\//s';
            $replacements[] = '';
            /* remove tabs, spaces, newlines, etc. */
            $patterns[] = '/\r\n|\r|\n|\t|\s\s+/';
            $replacements[] = '';
            /* remove whitespace on both sides of colons :*/
            $patterns[] = '/\s?\:\s?/';
            $replacements[] = ':';
            /* remove whitespace on both sides of curly brackets {} */
            $patterns[] = '/\s?\{\s?/';
            $replacements[] = '{';
            $patterns[] = '/\s?\}\s?/';
            $replacements[] = '}';
            /* remove whitespace on both sides of commas , */
            $patterns[] = '/\s?\,\s?/';
            $replacements[] = ',';
            /* compress */
            $this->compressed_css = preg_replace($patterns, $replacements, $this->original_css);
        }
    }
?>