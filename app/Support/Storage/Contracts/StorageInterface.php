<?php

namespace Cart\Support\Storage\Contracts;

interface StorageInterface
{
	public function all();
	public function clear();
	public function get($index);
	public function unset($index);
	public function exists($index);
	public function set($index, $value);
}