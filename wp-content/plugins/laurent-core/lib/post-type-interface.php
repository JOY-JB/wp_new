<?php

namespace LaurentCore\Lib;

/**
 * interface PostTypeInterface
 * @package LaurentCore\Lib;
 */
interface PostTypeInterface {
	/**
	 * @return string
	 */
	public function getBase();
	
	/**
	 * Registers custom post type with WordPress
	 */
	public function register();
}