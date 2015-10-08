<?php namespace VisionAlgolia;

/**
 * @package Vision_Algolia
 * @version 1.0
 */
/*
Plugin Name: Vision Algolia Indexer
Description: This plugin indexes all the content across the multisite network to Algolia to make global search possible
Author: Ryan Murray
Version: 1.0
*/

use VisionAlgolia\AlgoliaIndex\AlgoliaIndex;

require 'vendor/autoload.php';


new AlgoliaIndex();