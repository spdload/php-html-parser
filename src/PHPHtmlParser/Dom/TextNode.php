<?php
namespace PHPHtmlParser\Dom;

use PHPHtmlParser\Dom;

class TextNode extends Node {
	
	/**
	 * This is a text node.
	 *
	 * @var Tag
	 */
	protected $tag;

	/**
	 * This is the text in this node.
	 *
	 * @var string
	 */
	protected $text;

	/**
	 * This is the converted version of the text.
	 *
	 * @var string
	 */
	protected $convertedText = null;

	/**
	 * Sets the text for this node.
	 *
	 * @param string $text
	 */
	public function __construct($text)
	{
		// remove double spaces
		$text = preg_replace('/\s+/', ' ', $text);

		$this->text = $text;
		$this->tag	= new Tag('text');
		parent::__construct();
	}

	/**
	 * Returns the text of this node.
	 *
	 * @return string
	 */
	public function text()
	{
		// convert charset
		if ( ! is_null($this->encode))
		{
			if ( ! is_null($this->convertedText))
			{
				// we already know the converted value
				return $this->convertedText;
			}
			$text = $this->encode->convert($this->text);
			
			// remember the conversion
			$this->convertedText = $text;

			return $text;
		}
		else
		{
			return $this->text;
		}
	}

	/**
	 * Call this when something in the node tree has changed. Like a child has been added
	 * or a parent has been changed.
	 */
	protected function clear()
	{
		$this->convertedText = null;
	}
}
